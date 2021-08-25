<?php

namespace Cgit\Schema;

class Plugin
{
    /**
     * Post types and schemas
     *
     * @var array
     */
    public $postTypes = [
        'job-vacancy' => [
            'class' => 'JobVacancy',
            'schema' => 'JobPosting',
            'active' => false,
        ],

        'team-member' => [
            'class' => 'TeamMember',
            'schema' => 'EmployeeRole',
            'active' => false,
        ],
    ];

    /**
     * Options pages by class name
     *
     * @var array
     */
    private $optionsPages = [
        'Organization',
    ];

    /**
     * Constructor
     *
     * Register the organization details options page and the custom post types
     * with their associated custom fields. Modify the document head to include
     * the relevant schema(s).
     *
     * @return void
     */
    public function __construct()
    {
        add_action('acf/init', [$this, 'init']);
        add_action('admin_notices', [$this, 'showDependencyNotice']);
    }

    /**
     * Initialization
     *
     * Schema requires Advanced Custom Fields Pro, so this should only be run
     * when ACF is active.
     *
     * @return void
     */
    public function init(): void
    {
        $this->postTypes = apply_filters('cgit_schema_post_types', $this->postTypes);
        $this->optionsPages = apply_filters('cgit_schema_options_pages', $this->optionsPages);

        // Register post types, options pages, and fields
        $this->registerPostTypes();
        $this->registerOptionsPages();

        // Edit document head to include linked data
        $editor = new Editor($this);
    }

    /**
     * Check for dependencies and show warning message
     *
     * @return void
     */
    public function showDependencyNotice(): void
    {
        if (class_exists('\\ACF')) {
            return;
        }

        echo '<div class="notice notice-error"><p><b>Error:</b> Schema plugin requires
            <a href="https://www.advancedcustomfields.com/pro/">Advanced Custom Fields Pro</a>.</p></div>';
    }

    /**
     * Register post types
     *
     * Each post type and its associated custom fields should be defined by a
     * class in the PostType namespace.
     *
     * @return void
     */
    private function registerPostTypes()
    {
        foreach ($this->postTypes as $key => $value) {
            if (!isset($value['active']) || !$value['active']) {
                continue;
            }

            $namespace = '\\Cgit\\Schema\\PostType';
            $class = $this->sanitizeClassName($value['class'], $namespace);
            $instance = new $class($key);
        }
    }

    /**
     * Register options pages
     *
     * Each options page and its associated custom fields should be defined by a
     * class in the OptionsPage namespace.
     *
     * @return void
     */
    private function registerOptionsPages()
    {
        foreach ($this->optionsPages as $class) {
            $namespace = '\\Cgit\\Schema\\OptionsPage';
            $class = $this->sanitizeClassName($class, $namespace);
            $instance = new $class;
        }
    }

    /**
     * Sanitize class name
     *
     * If a class name has been provided without a namespace, add a default
     * namespace to the class name.
     *
     * @return void
     */
    private function sanitizeClassName($class, $namespace = null)
    {
        if (strpos($class, '\\') !== false) {
            return $class;
        }

        if (is_null($namespace)) {
            $namespace = '\\Cgit\\Schema';
        }

        return rtrim($namespace, '\\') . '\\' . $class;
    }
}
