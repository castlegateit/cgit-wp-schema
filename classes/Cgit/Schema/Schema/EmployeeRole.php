<?php

namespace Cgit\Schema\Schema;

class EmployeeRole extends Schema
{
    /**
     * Schema type
     *
     * @var string
     */
    protected $type = 'EmployeeRole';

    /**
     * Initialization
     *
     * @return void
     */
    public function init()
    {
        $this->updateTextFields();
        $this->updateImageFields();
    }

    /**
     * Update text fields
     *
     * @return void
     */
    private function updateTextFields()
    {
        global $post;

        $this->set('name', $post->post_title);
        $this->set('description', apply_filters('the_content',
            $post->post_content));
        $this->set('roleName', get_field('employee_role'));
    }

    /**
     * Update image fields
     *
     * @return void
     */
    private function updateImageFields()
    {
        $url = get_the_post_thumbnail_url(null, 'full');

        if ($url) {
            $schema = new ImageObject;
            $schema->set('url', $url);
            $this->set('image', $schema->export());
        }
    }
}
