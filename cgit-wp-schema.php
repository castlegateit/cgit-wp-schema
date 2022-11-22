<?php

/*

Plugin Name: Castlegate IT WP Schema
Plugin URI: https://github.com/castlegateit/cgit-wp-schema
Description: Basic schema.org integration
Version: 1.1.0
Author: Castlegate IT
Author URI: https://www.castlegateit.co.uk/

Copyright (c) 2018 Castlegate IT. All rights reserved.

*/

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_SCHEMA_PLUGIN', __FILE__);

require_once __DIR__ . '/classes/autoload.php';

$plugin = new \Cgit\Schema\Plugin;

do_action('cgit_schema_plugin', $plugin);
do_action('cgit_schema_loaded');
