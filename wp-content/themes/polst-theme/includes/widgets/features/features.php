<?php
/*
Widget Name: POLST features
Description: Custom features Widget with 3 elements
Author: Sprawsm
Author URI: https://sprawsm.com
*/

// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');

class featuresWidget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'polst-features-widget',
            __('POLST Features Widget', 'polst-widgets-bundle'),
            array(
                'description' => __('Custom features widget - circles with icons and titles and optional links', 'polst-widgets-bundle'),
                'panels_groups' => array('polst-widgets'),
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize_form() {
        return array(
            'features' => array(
                'type' => 'repeater',
                'label' => __( 'Features' , 'polst-widgets-bundle' ),
                'item_name'  => __( 'Feature', 'polst-widgets-bundle' ),
                'scroll_count' => 10,
                'item_label' => array(
                    'selector'     => "[id*='title']",
                    'update_event' => 'change',
                    'value_method' => 'val'
                ),
                'fields' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __( 'Title', 'polst-widgets-bundle' )
                    ),
                    'image' => array(
                        'type' => 'media',
                        'label' => __( 'Feature image' , 'polst-widgets-bundle' ),
                        'choose' => __( 'Chose image' , 'polst-widgets-bundle' ),
                        'update' => __( 'Set image' , 'polst-widgets-bundle' ),
                        'library' => 'image',
                        'fallback' => true,
                        'item_name'  => __( 'Feature image', 'polst-widgets-bundle' ),
                    ),
                    'url' => array(
                        'type' => 'link',
                        'label' => __( 'Link to content', 'polst-widgets-bundle' )
                    ),
                )
            ),
            'display_circle' => array(
                'type' => 'checkbox',
                'label' => __( 'Display circle behind the image', 'widget-form-fields-text-domain' ),
                'default' => true
            ),
            'color' => array(
                'type' => 'color',
                'label' => __( 'Choose circle color (default: #353439)', 'widget-form-fields-text-domain' ),
                'default' => '#353439'
            ),
        );

    }

    function get_template_name($instance) {
        return 'features';
    }

    // function get_style_name($instance) {
        // return 'features';
    // }

    function initialize() {

        $this->register_frontend_styles(
            array(
                array( 
                    'poslt-features-style', 
                    get_stylesheet_directory_uri() . '/includes/widgets/features/css/features.css',
                    array(),
                    '1.0'
                )
            )
        );
    }
}

siteorigin_widget_register('polst-features-widget', __FILE__, 'featuresWidget');
