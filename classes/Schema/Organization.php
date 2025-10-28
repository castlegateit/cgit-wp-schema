<?php

namespace Castlegate\Schema\Schema;

class Organization extends Schema
{
    /**
     * Schema type
     *
     * @var string
     */
    protected $type = 'Organization';

    /**
     * ACF custom field data source
     *
     * @var string
     */
    protected $source = 'option';

    /**
     * Initialization
     *
     * @return void
     */
    public function init()
    {
        $this->updateType();
        $this->updateRequiredTextFields();
        $this->updateEmailFields();
        $this->updateTextFields();
        $this->updateImageFields();
        $this->updateMapFields();
        $this->updateHoursFields();
        $this->updateSocialFields();
    }

    /**
     * Update schema type
     *
     * The options page lets you select different types of organization, all of
     * which are valid schema.org types.
     *
     * @return void
     */
    private function updateType()
    {
        $type = get_field('organization_type', $this->source);

        if ($type) {
            $this->type = $type;
        }
    }

    /**
     * Update required text fields
     *
     * The organization should at least have a name and a URL. If these have not
     * been set on the options page, they can be loaded from WordPress.
     *
     * @return void
     */
    private function updateRequiredTextFields()
    {
        $name = get_field('organization_name', $this->source);

        if (!$name) {
            $name = get_bloginfo('name');
        }

        $this->set('name', $name);
        $this->set('url', get_bloginfo('url'));
    }

    /**
     * Update email fields
     *
     * @return void
     */
    private function updateEmailFields()
    {
        $email_confirm = get_field('organization_email_confirmation', $this->source);
        $email = get_field('organization_email', $this->source);

        if (!$email_confirm) {
            $email = '';
        }

        $this->set('email', $email);
    }

    /**
     * Update text fields
     *
     * @return void
     */
    private function updateTextFields()
    {
        $fields = [
            'description' => 'description',
            'address' => 'address',
            'tel' => 'telephone',
            'fax' => 'faxNumber',
        ];

        foreach ($fields as $field => $key) {
            $value = get_field('organization_' . $field, $this->source);

            if (!$value) {
                continue;
            }

            // Where we're going, we don't need line breaks
            $break = '/,?[\n\r]+/';

            if (preg_match($break, $value)) {
                $value = implode(', ', preg_split($break, $value));
            }

            $this->set($key, $value);
        }
    }

    /**
     * Update image fields
     *
     * @return void
     */
    private function updateImageFields()
    {
        $fields = [
            'image' => 'image',
            'logo' => 'logo',
        ];

        foreach ($fields as $field => $key) {
            $image = get_field('organization_' . $field, $this->source);

            if (!$image) {
                continue;
            }

            $image_url = null;
            $schema = new ImageObject;

            if (is_numeric($image) && (int) $image > 0) {
                $image_url = wp_get_attachment_url((int)$image);
            } elseif (is_array($image) && array_key_exists('url', $image)) {
                $image_url = $image['url'];
            }

            if (!$image_url || filter_var($image_url, FILTER_VALIDATE_URL) === false) {
                continue;
            }

            $schema->set('url', $image_url);
            $this->set($key, $schema->export());
        }
    }

    /**
     * Update map fields
     *
     * @return void
     */
    private function updateMapFields()
    {
        $location = get_field('organization_location', $this->source);

        if (!$location) {
            return;
        }

        $schema = new GeoCoordinates;

        $schema->set('latitude', $location['lat']);
        $schema->set('longitude', $location['lng']);

        $this->set('geo', $schema->export());
    }

    /**
     * Update opening hours fields
     *
     * @return void
     */
    private function updateHoursFields()
    {
        $items = get_field('organization_hours', $this->source);
        $schemas = [];

        if (!$items) {
            return;
        }

        foreach ($items as $item) {
            $schema = new OpeningHoursSpecification;

            $schema->set('dayOfWeek', $item['days']);
            $schema->set('opens', $item['opens']);
            $schema->set('closes', $item['closes']);

            $schemas[] = $schema->export();
        }

        $this->set('openingHoursSpecification', $schemas);
    }

    /**
     * Update social network URL fields
     *
     * @return void
     */
    private function updateSocialFields()
    {
        $networks = [
            'facebook',
            'google',
            'instagram',
            'linkedin',
            'twitter',
            'youtube',
        ];

        $urls = [];

        foreach ($networks as $network) {
            $url = get_field('organization_' . $network . '_url',
                $this->source);

            if ($url) {
                $urls[] = $url;
            }
        }

        if ($urls) {
            $this->set('sameAs', $urls);
        }
    }
}
