# Castlegate IT WP Schema

Schema is a WordPress plugin that embeds [Schema.org](http://schema.org/) structured data into a website as [JSON linked data](https://json-ld.org/). It requires [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/).

## Organization

The plugin provides an ACF options page called Organization with fields for various company or organization details that will be used to assemble the [Organization](http://schema.org/Organization) schema data. All the fields are optional and some will fall back to default values based on the site configuration. For example, if you do not enter an organization name, the site name will be used instead. This schema will be embedded on every page of the website.

### Custom fields

You can add custom fields to the Organization options page with the `cgit_schema_options_page_custom_field_args` filter. You will also need to use the `cgit_schema_{$schema_name}_schema` filter to include the field data in the resulting schema. For example:

~~~ php
add_filter('cgit_schema_options_page_custom_field_args', function ($fields) {
    $fields['fields'][] = [
        'key' => 'foo',
        'name' => 'foo',
        'label' => 'foo',
        'type' => 'text',
    ];

    return $fields;
});

add_filter('cgit_schema_Organization_schema', function ($schema) {
    $schema['foo'] = get_field('foo', 'option');

    return $schema;
});
~~~

### Google Maps API

The Google Maps location field on the Organization options page requires an API key. You can find out how to add the API key in the [Advanced Custom Fields documentation](https://www.advancedcustomfields.com/blog/google-maps-api-settings/).

## Article

Blog posts will also include the [Article](http://schema.org/Article) schema. This is assembled entirely from the default WordPress blog post data and, therefore, does not require any custom fields.

## Post types

The plugin provides two additional post types that can contain structured data: Job Vacancy and Team Member. They are disabled by default and can be activated using the `cgit_schema_post_types` filter:

~~~ php
add_filter('cgit_schema_post_types', function ($types) {
    $types['job-vacancy']['active'] = true;
    $types['team-member']['active'] = true;

    return $types;
});
~~~

Each post type includes the necessary ACF custom fields to generate valid structured data.

### Custom fields

You can add custom fields to the post types with the `cgit_schema_{$post_type}_custom_field_args` filter. You will also need to use the `cgit_schema_{$schema_name}_schema` filter to include the field data in the resulting schema. For example:

~~~ php
add_filter('cgit_schema_job-vacancy_custom_field_args', function ($fields) {
    $fields['fields'][] = [
        'key' => 'foo',
        'name' => 'foo',
        'label' => 'foo',
        'type' => 'text',
    ];

    return $fields;
});

add_filter('cgit_schema_JobPosting_schema', function ($schema) {
    $schema['foo'] = get_field('foo');

    return $schema;
});
~~~

### Custom post types and schemas

You can also add entirely custom post types with corresponding structured data using the `cgit_schema_post_types` filter:

~~~ php
add_filter('cgit_schema_post_types', function ($types) {
    $types['foo'] = [
        'class' => 'FooPostTypeClassName',
        'schema' => 'FooSchemaClassName',
        'active' => true,
    ];

    return $types;
});
~~~

The `class` class should be extended from `\Castlegate\Schema\PostType\PostType` and defines the post type and its fields. The `schema` class should be extended from `\Castlegate\Schema\Schema\Schema` and generates the strucutred data that is output on the page.

## Validation

[Google's guidelines](https://developers.google.com/search/docs/guides/mark-up-content) specify a subset of the [Schema.org](http://schema.org) specification with certain fields required. It is recommended that you use Google's [Structured Data Testing Tool](https://search.google.com/structured-data/testing-tool) to make sure that the data embedded on your site can be read and indexed by Google.

## Filters

*   `cgit_schema_post_types` can be used to edit the list of custom post types, including the class used to define the post type and custom fields, the class used to embed the appropriate schema, and whether the post type is currently active or not. If the post type class and schema class do not include a namespace, the default plugin namespace will be used. This allows additional post types and schemas to be added by other plugins.

*   `cgit_schema_options_pages` includes the list of classes used to generate ACF options pages. By default, this only includes the Organization options page.

*   `cgit_schema_options_page_args` filters the options page options.

*   `cgit_schema_options_page_custom_field_args` filters the ACF custom post type definitions for options pages.

*   `cgit_schema_{$post_type}_post_type_args` filters the post type definition options.

*   `cgit_schema_{$post_type}_custom_field_args` filters the post type ACF custom fields definitions.

*   `cgit_schema_{$schema_name}_schema` filters the data for each schema embedded on the page.

*   `cgit_schema_editor_classes` filters the list of schema classes used by the `Editor` class to generate structured data.

*   `cgit_schema_schemas` filters the final, complete structured data just before it is embedded on the page.

## License

Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
