<?php

namespace Cgit\Schema\Schema;

class Article extends Schema
{
    /**
     * Schema type
     *
     * @var string
     */
    protected $type = 'Article';

    /**
     * Initialization
     *
     * @return void
     */
    public function init()
    {
        $this->updateTextFields();
        $this->updatePublisherFields();
        $this->updateImageFields();
    }

    /**
     * Update text fields
     *
     * @return void
     */
    private function updateTextFields()
    {
        $title = get_the_title();
        $name = get_bloginfo('name');
        $author = get_the_author() ?: $name;
        $url = get_permalink();

        $this->set('headline', $title);
        $this->set('datePublished', get_the_date(DATE_ISO8601));
        $this->set('dateModified', get_the_modified_date(DATE_ISO8601));
        $this->set('author', $author);
        $this->set('mainEntityOfPage', $url);

        $this->set('name', $title);
        $this->set('url', $url);
    }

    /**
     * Update publisher fields
     *
     * @return void
     */
    private function updatePublisherFields()
    {
        $logo = get_field('organization_logo', 'option');

        $publisher = [
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
        ];

        if ($logo) {
            $schema = new ImageObject;
            $schema->set('url', $logo['url']);
            $publisher['logo'] = $schema->export();
        }

        $this->set('publisher', $publisher);
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
