<?php

namespace Castlegate\Schema\PostType;

class TeamMember extends PostType
{
    /**
     * Post type parameters
     *
     * @var array
     */
    protected $typeArgs = [
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'public' => true,
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
            'page-attributes',
        ],
    ];

    /**
     * Custom field parameters
     *
     * @var array
     */
    protected $fieldArgs = [
        'fields' => [
            [
                'key' => 'cgit_wp_schema_employee_role',
                'name' => 'employee_role',
                'label' => 'Employee role',
                'type' => 'text',
            ],
        ],
    ];

    /**
     * Initialization
     *
     * @return void
     */
    protected function init()
    {
        $this->labels('Team Member');
    }
}
