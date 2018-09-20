<?php
/*
Plugin Name: POLST Widgets Bundle
Description: Custom Widget for POLST WP Theme
Version: 0.1
Author: Sprawsm
Author URI: http://sprawsm.com
Text Domain: polst-widgets-bundle
*/

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Register a custom widgets folder
function set_widgets_folder($folders) {
    $folders[] =  plugin_dir_path(__FILE__).'widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'set_widgets_folder');

// Add new tab for POLST widgets
function add_widgets_tab($tabs) {
    $tabs[] = array(
        'title' => __('POLST Widgets', 'polst-widgets-bundle'),
        'filter' => array(
            'groups' => array('polst-widgets')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'add_widgets_tab', 20);
