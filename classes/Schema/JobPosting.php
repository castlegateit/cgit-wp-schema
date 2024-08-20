<?php

namespace Castlegate\Schema\Schema;

class JobPosting extends Schema
{
    /**
     * Schema type
     *
     * @var string
     */
    protected $type = 'JobPosting';

    /**
     * Initialization
     *
     * @return void
     */
    public function init()
    {
        $this->updateTextFields();
        $this->updateSalaryFields();
        $this->updateDateFields();
        $this->updateLocationFields();
    }

    /**
     * Update text fields
     *
     * @return void
     */
    private function updateTextFields()
    {
        global $post;

        $type = get_field('job_employment_type');
        $id = get_field('job_id');

        $this->set('title', get_the_title());
        $this->set('description', apply_filters('the_content',
            $post->post_content));
        $this->set('hiringOrganization', get_bloginfo('name'));

        if ($type) {
            $this->set('employmentType', $type);
        }

        if ($id) {
            $this->set('identifier', $id);
        }
    }

    /**
     * Update salary fields
     *
     * @return void
     */
    private function updateSalaryFields()
    {
        $salary = get_field('job_salary');
        $max_salary = get_field('job_max_salary');
        $currency = get_field('job_salary_currency') ?: 'GBP';
        $unit = get_field('job_salary_unit') ?: 'YEAR';

        if (!$salary) {
            return;
        }

        $values = new QuantitativeValue;
        $values->set('unitText', $unit);
        $values->set('value', $salary);

        if ($max_salary && $salary != $max_salary) {
            $values->set('minValue', $salary);
            $values->set('maxValue', $max_salary);
        }

        $schema = new MonetaryAmount;
        $schema->set('currency', $currency);
        $schema->set('value', $values->export());

        $this->set('baseSalary', $schema->export());
    }

    /**
     * Update date fields
     *
     * @return void
     */
    private function updateDateFields()
    {
        $closing_date = get_field('job_closing_date');

        $this->set('datePosted', get_the_date('Y-m-d'));

        if ($closing_date) {
            $this->set('validThrough', $closing_date);
        }
    }

    /**
     * Update location fields
     *
     * @return void
     */
    private function updateLocationFields()
    {
        $place_schema = new Place;
        $address_schema = new PostalAddress;
        $has_location = false;
        $keys = [
            'streetAddress' => 'job_street_address',
            'addressLocality' => 'job_address_locality',
            'addressRegion' => 'job_address_region',
            'postalCode' => 'job_postal_code',
            'addressCountry' => 'job_address_country',
        ];

        foreach ($keys as $key => $field) {
            $value = get_field($field);

            if ($value) {
                $address_schema->set($key, $value);
            }
        }

        // No location? Assume UK because Google
        if (!$has_location) {
            $address_schema->set('addressCountry', 'UK');
        }

        $place_schema->set('address', $address_schema->export());
        $this->set('jobLocation', $place_schema->export());
    }
}
