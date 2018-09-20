<?php
/*
Widget Name: POLST pdf
Description: Custom pdf Widget with 3 elements
Author: Sprawsm
Author URI: https://sprawsm.com
*/

// Block direct requests
if ( !defined('ABSPATH') )
    die('-1');

class PdfWidget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'polst-pdf-widget',
            __('POLST Download Widget', 'polst-widgets-bundle'),
            array(
                'description' => __('Custom download widget', 'polst-widgets-bundle'),
                'panels_groups' => array('polst-widgets'),
            ),
            array(),
            false,
            plugin_dir_path(__FILE__)
        );
    }

    function initialize_form() {
        return array(
            'document_title' => array(
                'type' => 'text',
                'label' => __( 'Document title' , 'polst-widgets-bundle' ),
                'item_name'  => __( 'Document title', 'polst-widgets-bundle' ),
            ),
            'document_description' => array(
                'type' => 'text',
                'label' => __( 'Document Description (optinal)' , 'polst-widgets-bundle' ),
                'item_name'  => __( 'Document Description', 'polst-widgets-bundle' ),
            ),
            'document_url' => array(
                'type' => 'media',
                'label' => __( 'File from the media library' , 'polst-widgets-bundle' ),
                'choose' => __( 'Chose file' , 'polst-widgets-bundle' ),
                'update' => __( 'Set file' , 'polst-widgets-bundle' ),
                'library' => 'application, image, audio, video',
                'description' => 'For files hosted on polst.org',
                // 'fallback' => true,
                'item_name'  => __( 'PDF', 'polst-widgets-bundle' ),
            ),
            'external_document_url' => array(
                'type' => 'text',
                'label' => __( 'External file' , 'polst-widgets-bundle' ),
                'item_name'  => __( 'External file', 'polst-widgets-bundle' ),
                'description' => 'For files hosted offsite',
            ),
        );

    }

    function get_template_name($instance) {
        return 'pdf';
    }

    // function get_style_name($instance) {
        // return 'pdf';
    // }

    function initialize() {

        $this->register_frontend_styles(
            array(
                array( 
                    'poslt-pdf-style', 
                    get_stylesheet_directory_uri() . '/includes/widgets/pdf/css/pdf.css',
                    array(),
                    '1.0'
                )
            )
        );
    }
}

siteorigin_widget_register('polst-pdf-widget', __FILE__, 'PdfWidget');
