<?php

namespace Cgit\Schema;

class Editor
{
    /**
     * Plugin instance
     *
     * @var Plugin
     */
    private $plugin;

    /**
     * Schema classes
     *
     * Each of these classes will be instantiated and the resulting schemas
     * inserted into the document head.
     *
     * @var array
     */
    private $classes = [
        'Organization',
    ];

    /**
     * Schema data
     *
     * An array of schema data exported from the schema classes that will be
     * converted into JSON and inserted into the document head.
     *
     * @var array
     */
    private $schemas = [];

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($plugin)
    {
        $this->plugin = $plugin;

        add_action('wp', [$this, 'update']);
        add_action('wp_head', [$this, 'insert']);
    }

    /**
     * Update the list of schemas
     *
     * Check the current post or query type and adjust the list of schema
     * classes accordingly. Then export the schema data and assemble the final
     * array of schemas.
     *
     * @return void
     */
    public function update()
    {
        if (is_singular('post')) {
            $this->classes[] = 'Article';
        }

        foreach ($this->plugin->postTypes as $key => $value) {
            if (is_singular($key)) {
                $this->classes[] = $value['schema'];
            }
        }

        $this->classes = apply_filters('cgit_schema_editor_classes',
            $this->classes);

        $this->export();
    }

    /**
     * Export the schema data
     *
     * @return void
     */
    public function export()
    {
        foreach ($this->classes as $class) {
            if (strpos($class, '\\') === false) {
                $class = '\\Cgit\\Schema\\Schema\\' . $class;
            }

            $this->schemas[] = (new $class)->export();
        }

        $this->schemas = apply_filters('cgit_schema_schemas', $this->schemas);
    }

    /**
     * Insert the schema data into the document
     *
     * @return void
     */
    public function insert()
    {
        $json = json_encode([
            '@context' => 'http://schema.org',
            '@graph' => $this->schemas,
        ], JSON_UNESCAPED_SLASHES);

        echo PHP_EOL . '<script type="application/ld+json">' . $json
            . '</script>' . PHP_EOL . PHP_EOL;
    }
}
