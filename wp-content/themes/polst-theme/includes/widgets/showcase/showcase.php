<?php
/*
Widget Name: POLST Showcase
Description: Custom Showcase Widget with 3 elements
Author: Sprawsm
Author URI: https://sprawsm.com
*/

// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');

class ShowcaseWidget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'polst-showcase-widget',
            __('POLST Showcase Widget', 'polst-widgets-bundle'),
            array(
                'description' => __('Custom showcase widget', 'polst-widgets-bundle'),
                'panels_groups' => array('polst-widgets'),
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize_form() {
        
        return array(
            'first_item_section' => array(
                'type' => 'section',
                'label' => __( 'First item ' , 'polst-widgets-bundle' ),
                'hide' => true,
                'fields' => array(
                    'showcase_title1' => array(
                        'type' => 'text',
                        'label' => __( 'First item title' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'First item title', 'polst-widgets-bundle' ),
                    ),
                    'showcase_media1' => array(
                        'type' => 'media',
                        'label' => __( 'First item image' , 'polst-widgets-bundle' ),
                        'choose' => __( 'Chose image' , 'polst-widgets-bundle' ),
                        'update' => __( 'Set image' , 'polst-widgets-bundle' ),
                        'library' => 'image',
                        'fallback' => true,
                        'item_name'  => __( 'First item image', 'polst-widgets-bundle' ),
                    ),
                    'showcase_link1' => array(
                        'type' => 'link',
                        'label' => __( 'First item link' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'First item link', 'polst-widgets-bundle' ),
                    ),
                )
            ),
            'second_item_section' => array(
                'type' => 'section',
                'label' => __( 'Second item ' , 'polst-widgets-bundle' ),
                'hide' => true,
                'fields' => array(
                    'showcase_title2' => array(
                        'type' => 'text',
                        'label' => __( 'Second item title' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'Second item title', 'polst-widgets-bundle' ),
                    ),
                    'showcase_media2' => array(
                        'type' => 'media',
                        'label' => __( 'Second item image' , 'polst-widgets-bundle' ),
                        'choose' => __( 'Chose image' , 'polst-widgets-bundle' ),
                        'update' => __( 'Set image' , 'polst-widgets-bundle' ),
                        'library' => 'image',
                        'fallback' => true,
                        'item_name'  => __( 'Second item image', 'polst-widgets-bundle' ),
                    ),
                    'showcase_link2' => array(
                        'type' => 'link',
                        'label' => __( 'Second item link' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'Second item link', 'polst-widgets-bundle' ),
                    ),
                )
            ),
            'third_item_section' => array(
                'type' => 'section',
                'label' => __( 'Third item ' , 'polst-widgets-bundle' ),
                'hide' => true,
                'fields' => array(
                    'showcase_title3' => array(
                        'type' => 'text',
                        'label' => __( 'Third item title' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'Third item title', 'polst-widgets-bundle' ),
                    ),
                    'showcase_media3' => array(
                        'type' => 'media',
                        'label' => __( 'Third item image' , 'polst-widgets-bundle' ),
                        'choose' => __( 'Chose image' , 'polst-widgets-bundle' ),
                        'update' => __( 'Set image' , 'polst-widgets-bundle' ),
                        'library' => 'image',
                        'fallback' => true,
                        'item_name'  => __( 'Third item image', 'polst-widgets-bundle' ),
                    ),
                    'showcase_link3' => array(
                        'type' => 'link',
                        'label' => __( 'Third item link' , 'polst-widgets-bundle' ),
                        'item_name'  => __( 'Third item link', 'polst-widgets-bundle' ),
                    ),
                )
            )
        );

    }

    function get_template_name($instance) {
        return 'showcase';
    }

    // function get_style_name($instance) {
        // return 'showcase';
    // }

    function initialize() {
        // $this->register_frontend_scripts( array(
        //     array(
        //         'polst-showcase-widget-scripts',
        //         get_stylesheet_directory_uri() . '/includes/widgets/showcase/js/showcase.js',
        //         array( 'jquery' )
        //     )
        // ) );

        // $this->register_frontend_styles(
        //     array(
        //         array( 
        //             'poslt-showcase-style', 
        //             get_stylesheet_directory_uri() . '/includes/widgets/showcase/css/showcase.css',
        //             array(),
        //             '1.0'
        //         )
        //     )
        // );
    }
}

siteorigin_widget_register('polst-showcase-widget', __FILE__, 'ShowcaseWidget');
