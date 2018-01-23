<?php

namespace Cgit\Schema\PostType;

abstract class PostType
{
    /**
     * Post type name
     *
     * @var string
     */
    protected $name;

    /**
     * Post type parameters
     *
     * @var array
     */
    protected $typeArgs;

    /**
     * Custom field parameters
     *
     * @var array
     */
    protected $fieldArgs;

    /**
     * Constructor
     *
     * Register the custom post type and its associated ACF custom fields, but
     * only if parameters have been set.
     *
     * @return void
     */
    final public function __construct($name = null)
    {
        if (!is_null($name)) {
            $this->name = $name;
        }

        $this->init();
        $this->generateFieldArgs();

        $this->typeArgs = apply_filters('cgit_schema_' . $this->name
            . '_post_type_args', $this->typeArgs);
        $this->fieldArgs = apply_filters('cgit_schema_' . $this->name
            . '_custom_field_args', $this->fieldArgs);

        add_action('init', [$this, 'registerPostType']);
        add_action('acf/init', [$this, 'registerCustomFields']);
    }

    /**
     * Initialization
     *
     * Additional, optional initialization stuff to be performed before the post
     * type and fields are registered.
     *
     * @return void
     */
    protected function init()
    {
        // extend me
    }

    /**
     * Generate field parameters
     *
     * @return void
     */
    final private function generateFieldArgs()
    {
        $this->fieldArgs['title'] = $this->typeArgs['labels']['singular_name'];
        $this->fieldArgs['location'] = [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $this->name,
                ],
            ],
        ];
    }

    /**
     * Register post type
     *
     * @return void
     */
    final public function registerPostType()
    {
        if (!$this->name || !$this->typeArgs) {
            return;
        }

        register_post_type($this->name, $this->typeArgs);
    }

    /**
     * Register custom fields
     *
     * @return void
     */
    final public function registerCustomFields()
    {
        if (!$this->fieldArgs) {
            return;
        }

        acf_add_local_field_group($this->fieldArgs);
    }

    /**
     * Set post type labels
     *
     * @param string $single
     * @param string $plural
     * @return void
     */
    protected function labels($single, $plural = null)
    {
        if (is_null($plural)) {
            $plural = $single . 's';
        }

        $single_l = strtolower($single);
        $plural_l = strtolower($plural);

        $this->typeArgs['label'] = $plural;

        $this->typeArgs['labels'] = [
            'name' => $plural,
            'singular_name' => $single,
            'add_new' => 'Add New',
            'add_new_item' => 'Add New ' . $single,
            'edit_item' => 'Edit ' . $single,
            'new_item' => 'New ' . $single,
            'view_item' => 'View ' . $single,
            'view_items' => 'View ' . $plural,
            'search_items' => 'Search ' . $plural,
            'not_found' => 'No ' . $plural_l . ' found',
            'not_found_in_trash' => 'No ' . $plural_l . ' found in Trash',
            'parent_item_colon' => 'Parent ' . $single_l . ':',
            'all_items' => 'All ' . $plural,
            'archives' => $single . ' Archives',
            'attributes' => $single . ' Attributes',
            'insert_into_item' => 'Insert into ' . $single_l,
            'uploaded_to_this_item' => 'Uploaded to this ' . $single_l,
        ];
    }
}
