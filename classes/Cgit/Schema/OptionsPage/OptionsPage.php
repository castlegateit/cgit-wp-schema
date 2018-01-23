<?php

namespace Cgit\Schema\OptionsPage;

abstract class OptionsPage
{
    /**
     * Options page name
     *
     * @var string
     */
    protected $title;

    /**
     * Options page parameters
     *
     * @var array
     */
    protected $pageArgs;

    /**
     * Custom field parameters
     *
     * @var array
     */
    protected $fieldArgs;

    /**
     * Constructor
     *
     * Register the ACF options page and its associated custom fields, but only
     * if parameters have been set.
     *
     * @return void
     */
    final public function __construct()
    {
        $this->init();
        $this->generatePageArgs();
        $this->generateFieldArgs();

        $this->pageArgs = apply_filters('cgit_schema_options_page_args',
            $this->pageArgs);
        $this->fieldArgs = apply_filters(
            'cgit_schema_options_page_custom_field_args', $this->fieldArgs);

        add_action('acf/init', [$this, 'registerOptionsPage']);
        add_action('acf/init', [$this, 'registerCustomFields']);
    }

    /**
     * Initialization
     *
     * Additional, optional initialization stuff to be performed before the
     * options page and fields are registered.
     *
     * @return void
     */
    protected function init()
    {
        // extend me
    }

    /**
     * Generate options page parameters
     *
     * @return void
     */
    private function generatePageArgs()
    {
        $name = strtolower(get_class($this));

        // Remove namespace from class name for use in page name
        if (strpos($name, '\\') !== false) {
            $parts = explode('\\', $name);
            $name = $parts[count($parts) - 1];
        }

        $this->pageArgs = [
            'page_title' => $this->title,
            'menu_slug' => 'cgit-wp-schema-options-' . $name,
            'capability' => 'edit_others_posts',
        ];
    }

    /**
     * Generate field parameters based on page parameters
     *
     * @return void
     */
    private function generateFieldArgs()
    {
        $this->fieldArgs['title'] = $this->title;
        $this->fieldArgs['location'] = [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => $this->pageArgs['menu_slug'],
                ],
            ],
        ];
    }

    /**
     * Register post type
     *
     * @return void
     */
    final public function registerOptionsPage()
    {
        if (!$this->title || !$this->pageArgs) {
            return;
        }

        acf_add_options_page($this->pageArgs);
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
}
