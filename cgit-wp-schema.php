<?php

/**
 * Plugin Name:  Castlegate IT WP Schema
 * Plugin URI:   https://github.com/castlegateit/cgit-wp-schema
 * Description:  Basic schema.org integration.
 * Version:      1.2.0
 * Requires PHP: 8.2
 * Author:       Castlegate IT
 * Author URI:   https://www.castlegateit.co.uk/
 * License:      MIT
 * Update URI:   https://github.com/castlegateit/cgit-wp-schema
 */

use Castlegate\Schema\Plugin;

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_WP_SCHEMA_VERSION', '1.2.0');
define('CGIT_WP_SCHEMA_PLUGIN_FILE', __FILE__);
define('CGIT_WP_SCHEMA_PLUGIN_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';

Plugin::init();
