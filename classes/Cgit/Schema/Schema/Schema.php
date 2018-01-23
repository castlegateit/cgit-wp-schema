<?php

namespace Cgit\Schema\Schema;

abstract class Schema
{
    /**
     * Schema type
     *
     * Pick a schema: http://schema.org/docs/full.html
     *
     * @var string
     */
    protected $type = 'Thing';

    /**
     * Schema data
     *
     * @var array
     */
    protected $schema = [];

    /**
     * Constructor
     *
     * @return void
     */
    final public function __construct()
    {
        $this->init();

        $this->schema = apply_filters('cgit_schema_' . $this->type . '_schema',
            $this->schema);
    }

    /**
     * Initialization
     *
     * @return void
     */
    public function init()
    {
        // extend me
    }

    /**
     * Set schema value
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    final public function set($key, $value)
    {
        $this->schema[$key] = $value;
    }

    /**
     * Remove schema value
     *
     * @param string $key
     * @return void
     */
    final public function unset($key)
    {
        unset($this->schema[$key]);
    }

    /**
     * Export schema
     *
     * Export the schema data with the correct schema type as an array or as
     * JSON suitable for use in linked data.
     *
     * @param boolean $json
     * @return mixed
     */
    final public function export($json = false)
    {
        $schema = array_merge(['@type' => $this->type], $this->schema);

        if ($json) {
            return json_encode($schema);
        }

        return $schema;
    }
}
