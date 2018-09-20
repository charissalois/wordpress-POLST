<?php
/*
Widget Name: POLST Accordion
Description: Custom Accordion Widget
Author: Sprawsm
Author URI: https://sprawsm.com
*/

// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');

class AccordionWidget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'polst-accordion-widget',
            __('POLST Accordion Widget', 'polst-widgets-bundle'),
            array(
                'description' => __('Custom accordion widget', 'polst-widgets-bundle'),
                'panels_groups' => array('polst-widgets'),
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize_form() {
        return array(
            'accordion' => array(
                'type' => 'repeater',
                'label' => __( 'Accordion' , 'polst-widgets-bundle' ),
                'item_name'  => __( 'Accordion Item', 'polst-widgets-bundle' ),
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
                    'content' => array(
                        'type' => 'tinymce',
                        'label' => __( 'Content', 'polst-widgets-bundle' ),
                        'rows' => 10,
                        'default_editor' => 'html'
                    ),
                )
            ),
        );
    }

    function get_template_name($instance) {
        return 'accordion';
    }

    // function get_style_name($instance) {
        // return 'accordion';
    // }

    function initialize() {
        $this->register_frontend_scripts( array(
            array(
                'polst-accordion-widget-scripts',
                get_stylesheet_directory_uri() . '/includes/widgets/accordion/js/accordion.js',
                array( 'jquery' )
            )
        ) );

        $this->register_frontend_styles(
            array(
                array( 
                    'poslt-accordion-style', 
                    get_stylesheet_directory_uri() . '/includes/widgets/accordion/css/accordion.css',
                    array(),
                    '1.0'
                )
            )
        );
    }
}

siteorigin_widget_register('polst-accordion-widget', __FILE__, 'AccordionWidget');
