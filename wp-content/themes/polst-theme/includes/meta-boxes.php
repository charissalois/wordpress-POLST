<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function polst_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}




add_action( 'cmb2_admin_init', 'polst_register_repeatable_home_links_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function polst_register_repeatable_home_links_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_home_link_';

	/**
	 * Repeatable Field Groups
	 */
	$home_links = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home Page Links', 'cmb2' ),
		'object_types' => array( 'page', ),
		'show_on_cb' => 'polst_show_if_front_page', // function should return a bool value
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$home_link_group_id = $home_links->add_field( array(
		'id'          => $prefix . 'demo',
		'type'        => 'group',
		'description' => __( 'Generates links located below the mission statement', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Link {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Link', 'cmb2' ),
			'remove_button' => __( 'Remove Link', 'cmb2' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$home_links->add_group_field( $home_link_group_id, array(
		'name'       => __( 'Link Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$home_links->add_group_field( $home_link_group_id, array(
		'name' => __( 'Link Image', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
		'preview_size' => array( 150, 150 ),
	) );

	$home_links->add_group_field( $home_link_group_id, array(
		'name'        => __( 'Links to:' ),
	    'id'          => 'prefix_related_post',
	    'type'        => 'post_search_text', // This field type
	    'desc' => __( 'Select a page by clicking on the Find Page button or enter the page ID.', 'cmb2' ),
	    // post type also as array
	    'post_type'   => 'page',
	    // Default is 'checkbox', used in the modal view to select the post type
	    'select_type' => 'radio',
	    // Will replace any selection with selection from modal. Default is 'add'
	    'select_behavior' => 'replace',
	) );

}

// add_action( 'cmb2_admin_init', 'yourprefix_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function yourprefix_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_yourprefix_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ),
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Extra Info', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => __( 'Avatar', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Facebook URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Twitter URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Google+ URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Linkedin URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'User Field', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

/********************************************************************
* POLST SLIDER
*********************************************************************/
add_action( 'cmb2_admin_init', 'polst_slider_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function polst_slider_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_slider_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_slider = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'Slide info', 'cmb2' ),
		'object_types'     => array( 'slides' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		// 'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_slider->add_field( array(
		'name'     => __( 'Slide title', 'cmb2' ),
		'id'       => $prefix . 'title',
		'type'     => 'text',
	) );

	$cmb_slider->add_field( array(
		'name'     => __( 'Slide Content', 'cmb2' ),
		'id'       => $prefix . 'content',
		'description' => 'Text below the title',
		'type'     => 'textarea_small',
	) );

	$cmb_slider->add_field( array(
	    'name'        => __( 'Link to Page or Post ' ),
	    'id'       => $prefix . 'existing_url',
	    'type'        => 'post_search_text', // This field type
	    // post type also as array
	    'post_type'   =>  array('post', 'page' ),
	    'description' => 'Find existing page or post or enter page/post ID',
	    // Default is 'checkbox', used in the modal view to select the post type
	    'select_type' => 'radio',
	    // Will replace any selection with selection from modal. Default is 'add'
	    'select_behavior' => 'replace',
	) );

	$cmb_slider->add_field( array(
		'name' => __( 'Custom URL', 'cmb2' ),
		'desc' => __( 'Paste custom URL here (e.g. http://www.polst.org/educational-resources/) instead of linking to existing page/post', 'cmb2' ),
		'id'   => $prefix . 'custom_url',
		'type' => 'text_url',
	) );


}



/********************************************************************
* POLST PROGRAMS METABOX
*********************************************************************/

// program info
add_action( 'cmb2_admin_init', 'polst_slider_programs_info' );
function polst_slider_programs_info() {

	$prefix = '_program_info_';

	$polst_programs_info = new_cmb2_box( array(
		'id'               => $prefix . 'info_box',
		'title'            => __( 'Program information', 'cmb2' ),
		'object_types'     => array( 'programs' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Program name', 'cmb2' ),
		'desc'    => __( 'Enter program name', 'cmb2' ),
		'id'      => $prefix . 'program_name',
		'type'    => 'text',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Program website', 'cmb2' ),
		'desc'    => __( 'Enter program website URL', 'cmb2' ),
		'id'      => $prefix . 'program_website',
		'type'    => 'text_url',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Registry website', 'cmb2' ),
		'desc'    => __( 'Enter registry website URL', 'cmb2' ),
		'id'      => $prefix . 'registry_website',
		'type'    => 'text_url',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Program status', 'cmb2' ),
		'desc'    => __( 'Select program status', 'cmb2' ),
		'id'      => 'wpcf-status',
		'type'    => 'select',
		'options'          => array(
			'0' => __( 'None', 'cmb2' ),
			'1'   => __( 'Non Conforming', 'cmb2' ),
			'2'     => __( 'Developing', 'cmb2' ),
			'3'     => __( 'Endorsed', 'cmb2' ),
			'4'     => __( 'Mature', 'cmb2' ),
		),
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Started on', 'cmb2' ),
		'desc'    => __( 'Select date', 'cmb2' ),
		'id'      => $prefix . 'program_started',
		'type'    => 'text',
		// 'date_format' => 'F j, Y',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Endorsed since', 'cmb2' ),
		'desc'    => __( 'Select date', 'cmb2' ),
		'id'      => $prefix . 'program_endorsed',
		'type'    => 'text',
		// 'date_format' => 'F j, Y',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Mature since', 'cmb2' ),
		'desc'    => __( 'Select date', 'cmb2' ),
		'id'      => $prefix . 'program_mature',
		'type'    => 'text',
		// 'date_format' => 'F j, Y',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Status description', 'cmb2' ),
		'desc'    => __( 'e.g. why a state is non-conforming', 'cmb2' ),
		'id'      => $prefix . 'program_status_description',
		'type'    => 'textarea_small',
	) );

	$polst_programs_info->add_field( array(
		'name'    => __( 'Legislative/Regulatory Information', 'cmb2' ),
		'id'      => $prefix . 'program_legislative_info',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 8,
			'media_buttons' => false,
			'teeny' => true
		),

	) );


}


// contact info
add_action( 'cmb2_admin_init', 'polst_slider_programs_contact' );
function polst_slider_programs_contact() {

	$prefix = '_program_contact_';

	$polst_programs_contact = new_cmb2_box( array(
		'id'               => $prefix . 'contact_box',
		'title'            => __( 'Contact details', 'cmb2' ),
		'object_types'     => array( 'programs' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$polst_programs_group_id = $polst_programs_contact->add_field( array(
		'id'          => $prefix . 'contact_group',
		'type'        => 'group',
		'description' => __( 'Contact information', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Contact {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Contact', 'cmb2' ),
			'remove_button' => __( 'Remove Contact', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact Name', 'cmb2' ),
		'desc' => __( 'Enter persons name.', 'cmb2' ),
		'id'   => 'contact_name',
		'type' => 'text',
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact Title', 'cmb2' ),
		'desc' => __( 'Enter persons title/position.', 'cmb2' ),
		'id'   => 'contact_position',
		'type' => 'text',
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact email', 'cmb2' ),
		'desc' => __( 'Enter persons email.', 'cmb2' ),
		'id'   => 'contact_email',
		'type' => 'text',
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact address', 'cmb2' ),
		'desc' => __( 'Enter contact address.', 'cmb2' ),
		'id'   => 'contact_address',
		'type' => 'textarea_small',
		// 'default' => '',
		// 'type' => 'wysiwyg',
		// 'options' => array(
		// 	'textarea_rows' => 4,
		// 	'media_buttons' => false,
		// 	'teeny' => true
		// ),

	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact organization', 'cmb2' ),
		'desc' => __( 'Enter organization name.', 'cmb2' ),
		'id'   => 'contact_organization',
		'type' => 'text',
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact phone', 'cmb2' ),
		'desc' => __( 'Enter phone number.', 'cmb2' ),
		'id'   => 'contact_phone',
		'type' => 'text',
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Contact fax', 'cmb2' ),
		'desc' => __( 'Enter fax number.', 'cmb2' ),
		'id'   => 'contact_fax',
		'type' => 'text',
	) );

}

// social networks info
add_action( 'cmb2_admin_init', 'polst_slider_programs_social' );
function polst_slider_programs_social() {

	$prefix = '_program_social_';

	$polst_programs_contact = new_cmb2_box( array(
		'id'               => $prefix . 'contact_box',
		'title'            => __( 'Social Networks', 'cmb2' ),
		'object_types'     => array( 'programs' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$polst_programs_group_id = $polst_programs_contact->add_field( array(
		'id'          => $prefix . 'social_group',
		'type'        => 'group',
		'description' => __( '', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Network {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Network', 'cmb2' ),
			'remove_button' => __( 'Remove Network', 'cmb2' ),
			'closed' => 'true',
			'sortable'      => true, // beta
		),
	) );

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Network Name', 'cmb2' ),
		'desc' => __( 'Enter network name. e.g. Twitter', 'cmb2' ),
		'id'   => 'network_name',
		'type' => 'text',
	) );

	

	$polst_programs_contact->add_group_field( $polst_programs_group_id, array(
		'name' => __( 'Network URL', 'cmb2' ),
		'desc' => __( 'Enter profile URL. e.g. https://twitter.com/NationalPOLST', 'cmb2' ),
		'id'   => 'network_url',
		'type' => 'text_url',
	) );

	

}

// program status
// add_action( 'cmb2_admin_init', 'polst_programs_status' );
// function polst_programs_status() {

// 	$prefix = '_program_status_';

// 	$polst_program_colors = new_cmb2_box( array(
// 		'id'               => $prefix . 'status_box',
// 		'title'            => __( 'Status', 'cmb2' ),
// 		'object_types'     => array( 'programs' ),
// 		'context'      => 'side',
// 		'priority'     => 'low',
// 	) );

// 	$polst_program_colors->add_field( array(
// 		'name'    => __( 'Select status', 'cmb2' ),
// 		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
// 		'id'      => $prefix . 'options',
// 		'type'    => 'select',
// 		'options'          => array(
// 	        'mature' => __( 'Mature', 'cmb2' ),
// 	        'endorsed'   => __( 'Endorsed', 'cmb2' ),
// 	        'developing'     => __( 'Developing', 'cmb2' ),
// 	        'non-conforming'     => __( 'non-conforming', 'cmb2' ),
// 	        'none'     => __( 'None', 'cmb2' ),
// 	    ),
// 	) );


// }

// test
add_action( 'cmb2_admin_init', 'polst_resource_details' );
function polst_resource_details() {

	$prefix = '_resource_details_';

	$polst_resource_details = new_cmb2_box( array(
		'id'               => $prefix . 'id',
		'title'            => __( 'Resource Details', 'cmb2' ),
		'object_types'     => array( 'educational_resource' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Citation', 'cmb2' ),
		'desc'    => __( 'Citations for academic articles on POLST', 'cmb2' ),
		'id'      => 'wpcf-citation_slug',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 8, ),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Endorsed POLST Program', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'wpcf-endorsed_polst',
		'type'             => 'radio',
		'options'          => array(
			'Yes' => __( 'Yes', 'cmb2' ),
			'No'   => __( 'No', 'cmb2' ),
		),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Resource type', 'cmb2' ),
		'desc'    => __( 'The type of resource available for download', 'cmb2' ),
		'id'      => 'wpcf-resource_type',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'Brochures' => __( 'Brochures', 'cmb2' ),
			'Consumer Guides'   => __( 'Consumer Guides', 'cmb2' ),
			'FAQs'     => __( 'FAQs', 'cmb2' ),
			'Forms'     => __( 'Forms', 'cmb2' ),
			'Guidelines'     => __( 'Guidelines', 'cmb2' ),
			'Journal Articles'     => __( 'Journal Articles', 'cmb2' ),
			'Magazine Articles'     => __( 'Magazine Articles', 'cmb2' ),
			'Presentations'     => __( 'Presentations', 'cmb2' ),
			'Provider Guides'     => __( 'Provider Guides', 'cmb2' ),
			'Reports'     => __( 'Reports', 'cmb2' ),
			'Webinars'     => __( 'Webinars', 'cmb2' ),
		),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Language', 'cmb2' ),
		'desc'    => __( 'Language of resource', 'cmb2' ),
		'id'      => 'wpcf-language',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'English' => __( 'English', 'cmb2' ),
			'Armenian' => __( 'Armenian', 'cmb2' ),
			'Farsi' => __( 'Farsi', 'cmb2' ),
			'Hmong' => __( 'Hmong', 'cmb2' ),
			'Ilocano' => __( 'Ilocano', 'cmb2' ),
			'Japanese' => __( 'Japanese', 'cmb2' ),
			'Korean' => __( 'Korean', 'cmb2' ),
			'Marshallese' => __( 'Marshallese', 'cmb2' ),
			'Pashto' => __( 'Pashto', 'cmb2' ),
			'Russian' => __( 'Russian', 'cmb2' ),
			'Simplified Chinese' => __( 'Simplified Chinese', 'cmb2' ),
			'Spanish' => __( 'Spanish', 'cmb2' ),
			'Tagalog' => __( 'Tagalog', 'cmb2' ),
			'Tongan' => __( 'Tongan', 'cmb2' ),
			'Traditional Chinese' => __( 'Traditional Chinese', 'cmb2' ),
			'Vietnamese' => __( 'Vietnamese', 'cmb2' ),
		),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Document Date', 'cmb2' ),
		// 'desc'    => __( '', 'cmb2' ),
		'id'      => 'wpcf-date',
		'type'    => 'text',
		// 'date_format' => 'F j, Y',
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'File type', 'cmb2' ),
		'desc'    => __( 'Type of file to be accessed', 'cmb2' ),
		'id'      => 'wpcf-file_type',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'PDF' => __( 'PDF', 'cmb2' ),
			'PPT' => __( 'PPT', 'cmb2' ),
			'DOC' => __( 'DOC', 'cmb2' ),
			'PUB' => __( 'PUB', 'cmb2' ),
			'Webpage' => __( 'Webpage', 'cmb2' ),
			'Korean' => __( 'Korean', 'cmb2' ),
		),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Permission to Adapt Resource', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'wpcf-permission-to-adapt-resource',
		'type'             => 'radio',
		'options'          => array(
			'-'   => __( '-', 'cmb2' ),
			'Yes, with written acknowledgement' => __( 'Yes, with written acknowledgement', 'cmb2' ),
			'Yes, with conditions'   => __( 'Yes, with conditions', 'cmb2' ),
			'Resource cannot be adapted or reproduced'   => __( 'Resource cannot be adapted or reproduced', 'cmb2' ),
		),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Resource Permissions', 'cmb2' ),
		'desc'    => __( 'How the POLST resource may be used', 'cmb2' ),
		'id'      => 'wpcf-resource_permissions',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 8, ),
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'Resource Link', 'cmb2' ),
		'desc'    => __( 'Link to PDF or website of resource', 'cmb2' ),
		'id'      => 'wpcf-resource_link',
		'type'    => 'text_url',
	) );

	$polst_resource_details->add_field( array(
		'name'    => __( 'State', 'cmb2' ),
		'desc'    => __( 'State POLST Program that created the resource', 'cmb2' ),
		'id'      => 'wpcf-resource_state',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(		
			'Alabama' => __( 'Alabama', 'cmb2' ),
			'Alaska' => __( 'Alaska', 'cmb2' ),
			'Arizona' => __( 'Arizona', 'cmb2' ),
			'Arkansas' => __( 'Arkansas', 'cmb2' ),
			'California' => __( 'California', 'cmb2' ),
			'Colorado' => __( 'Colorado', 'cmb2' ),
			'Connecticut' => __( 'Connecticut', 'cmb2' ),
			'Delaware' => __( 'Delaware', 'cmb2' ),
			'Florida' => __( 'Florida', 'cmb2' ),
			'Georgia' => __( 'Georgia', 'cmb2' ),
			'Hawaii' => __( 'Hawaii', 'cmb2' ),
			'Idaho' => __( 'Idaho', 'cmb2' ),
			'Illinois' => __( 'Illinois', 'cmb2' ),
			'Indiana' => __( 'Indiana', 'cmb2' ),
			'Iowa' => __( 'Iowa', 'cmb2' ),
			'Kansas' => __( 'Kansas', 'cmb2' ),
			'Kentucky' => __( 'Kentucky', 'cmb2' ),
			'Louisiana' => __( 'Louisiana', 'cmb2' ),
			'Maine' => __( 'Maine', 'cmb2' ),
			'Maryland' => __( 'Maryland', 'cmb2' ),
			'Massachusetts' => __( 'Massachusetts', 'cmb2' ),
			'Michigan' => __( 'Michigan', 'cmb2' ),
			'Minnesota' => __( 'Minnesota', 'cmb2' ),
			'Mississippi' => __( 'Mississippi', 'cmb2' ),
			'Missouri' => __( 'Missouri', 'cmb2' ),
			'Montana' => __( 'Montana', 'cmb2' ),
			'Nebraska' => __( 'Nebraska', 'cmb2' ),
			'Nevada' => __( 'Nevada', 'cmb2' ),
			'New Hampshire' => __( 'New Hampshire', 'cmb2' ),
			'New Jersey' => __( 'New Jersey', 'cmb2' ),
			'New Mexico' => __( 'New Mexico', 'cmb2' ),
			'New York' => __( 'New York', 'cmb2' ),
			'North Carolina' => __( 'North Carolina', 'cmb2' ),
			'North Dakota' => __( 'North Dakota', 'cmb2' ),
			'Ohio' => __( 'Ohio', 'cmb2' ),
			'Oklahoma' => __( 'Oklahoma', 'cmb2' ),
			'Oregon' => __( 'Oregon', 'cmb2' ),
			'Pennsylvania' => __( 'Pennsylvania', 'cmb2' ),
			'Rhode Island' => __( 'Rhode Island', 'cmb2' ),
			'South Carolina' => __( 'South Carolina', 'cmb2' ),
			'South Dakota' => __( 'South Dakota', 'cmb2' ),
			'Tennessee' => __( 'Tennessee', 'cmb2' ),
			'Texas' => __( 'Texas', 'cmb2' ),
			'Utah' => __( 'Utah', 'cmb2' ),
			'Vermont' => __( 'Vermont', 'cmb2' ),
			'Virginia' => __( 'Virginia', 'cmb2' ),
			'Washington' => __( 'Washington', 'cmb2' ),
			'Washington DC' => __( 'Washington DC', 'cmb2' ),
			'West Virginia' => __( 'West Virginia', 'cmb2' ),
			'Wisconsin' => __( 'Wisconsin', 'cmb2' ),
			'Wyoming' => __( 'Wyoming', 'cmb2' ),
		),
	) );

}


// program map pdf link
// add_action( 'cmb2_admin_init', 'polst_program_map_pdf' );
// function polst_program_map_pdf() {

// 	$prefix = '_map_';

// 	$polst_program_map_pdf = new_cmb2_box( array(
// 		'id'               => $prefix . 'pdf',
// 		'title'            => __( 'PDF Download', 'cmb2' ),
// 		'object_types'     => array( 'page' ),
// 		'context'      => 'side',
// 		'priority'     => 'low',
// 		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-programs-map.php' ),
// 		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
// 	) );

// 	$polst_program_map_pdf->add_field( array(
// 		'name'    => __( 'Paste map PDF URL', 'cmb2' ),
// 		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
// 		'id'      => $prefix . 'pdf_url',
// 		'type'    => 'text_url',
// 	) );

// 	$polst_program_map_pdf->add_field( array(
// 		'name'    => __( 'Paste current state status PDF URL', 'cmb2' ),
// 		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
// 		'id'      => $prefix . 'status_url',
// 		'type'    => 'text_url',
// 	) );

// }

// program map pdf link
add_action( 'cmb2_admin_init', 'polst_map_download_buttons' );
function polst_map_download_buttons() {

	$prefix = '_download_button_';

	$polst_map_download_buttons = new_cmb2_box( array(
		'id'               => $prefix . 'box',
		'title'            => __( 'PDF Download', 'cmb2' ),
		'object_types'     => array( 'page' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-programs-map.php' ),
		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
	) );

	$polst_map_download_buttons_group_id = $polst_map_download_buttons->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		'description' => __( 'Generates Download PDF buttons', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Button {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Button', 'cmb2' ),
			'remove_button' => __( 'Remove Button', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

	$polst_map_download_buttons->add_group_field( $polst_map_download_buttons_group_id, array(
		'name'       => __( 'Button Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$polst_map_download_buttons->add_group_field( $polst_map_download_buttons_group_id, array(
		'name'       => __( 'PDF URL', 'cmb2' ),
		'id'         => 'url',
		'type'       => 'text_url',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

}

// program map pdf link
add_action( 'cmb2_admin_init', 'polst_map_download_maps' );
function polst_map_download_maps() {

	$prefix = '_download_map_';

	$polst_map_download_maps = new_cmb2_box( array(
		'id'               => $prefix . 'box',
		'title'            => __( 'Aditional maps', 'cmb2' ),
		'object_types'     => array( 'page' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-programs-map.php' ),
		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
	) );

	$polst_map_download_buttons_group_id = $polst_map_download_maps->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		'description' => __( 'Generates PDF buttons', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Button {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Button', 'cmb2' ),
			'remove_button' => __( 'Remove Button', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'     => true, // true to have the groups closed by default
		),
	) );

	$polst_map_download_maps->add_group_field( $polst_map_download_buttons_group_id, array(
		'name'       => __( 'Button Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$polst_map_download_maps->add_group_field( $polst_map_download_buttons_group_id, array(
		'name'       => __( 'PDF URL', 'cmb2' ),
		'id'         => 'url',
		'type'       => 'text_url',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$polst_map_download_maps->add_group_field( $polst_map_download_buttons_group_id, array(
		'name'       => __( 'Button color', 'cmb2' ),
		'id'         => 'color',
		'type'    => 'colorpicker',
		'default' => '#029ea8',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

}

// program status colors info
add_action( 'cmb2_admin_init', 'polst_program_colors' );
function polst_program_colors() {

	$prefix = '_program_color_';

	$polst_program_colors = new_cmb2_box( array(
		'id'               => $prefix . 'color_box',
		'title'            => __( 'Status colors', 'cmb2' ),
		'object_types'     => array( 'page' ),
		'context'      => 'side',
		'priority'     => 'low',
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-programs-map.php' ),
		'closed' => 'true',
		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
	) );

	$polst_program_colors->add_field( array(
		'name'    => __( 'Mature color', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'mature',
		'type'    => 'colorpicker',
		'default' => '#df3477',
	) );

	$polst_program_colors->add_field( array(
		'name'    => __( 'Endorsed color', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'endorsed',
		'type'    => 'colorpicker',
		'default' => '#e587ad',
	) );

	$polst_program_colors->add_field( array(
		'name'    => __( 'Developing color', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'developing',
		'type'    => 'colorpicker',
		'default' => '#f8d3da',
	) );

	$polst_program_colors->add_field( array(
		'name'    => __( 'Non-conforming', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'nonconforming',
		'type'    => 'colorpicker',
		'default' => '#888888',
	) );

	$polst_program_colors->add_field( array(
		'name'    => __( 'None color', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'none',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );
}

// program status colors info
add_action( 'cmb2_admin_init', 'polst_program_definitions' );
function polst_program_definitions() {

	$prefix = '_program_definition_';

	$polst_program_definitions = new_cmb2_box( array(
		'id'               => $prefix . 'box',
		'title'            => __( 'Program definitions', 'cmb2' ),
		'object_types'     => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-programs-map.php' ),
		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'Mature definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'mature',
		'type'    => 'textarea',
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'Endorsed definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'endorsed',
		'type'    => 'textarea',
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'Developing definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'developing',
		'type'    => 'textarea',
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'Non-conforming definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'non-conforming',
		'type'    => 'textarea',
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'None definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'no',
		'type'    => 'textarea',
	) );

	$polst_program_definitions->add_field( array(
		'name'    => __( 'Asterisk definition', 'cmb2' ),
		// 'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'asterisk',
		'type'    => 'textarea',
	) );
}



add_action( 'cmb2_admin_init', 'polst_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function polst_register_theme_options_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$option_key = '_polst_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$polst_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => __( 'Theme Options Metabox', 'cmb2' ),
		'hookup'  => false, // Do not need the normal user/post hookup
		'show_on' => array(
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$polst_options->add_field( array(
		'name'    => __( 'Site Background Color', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );
}


//================================================
// Newsletter Archive
//================================================

// program map pdf link
add_action( 'cmb2_admin_init', 'polst_enewsletter' );
function polst_enewsletter() {

	$prefix = '_newsletter_';

	$polst_enewsletter = new_cmb2_box( array(
		'id'               => $prefix . 'files',
		'title'            => __( 'Newsletter PDF', 'cmb2' ),
		'object_types'     => array( 'newsletter' ),
		'context'      => 'normal',
		'priority'     => 'high',
		// 'show_on'      => array( 'key' => 'post-type', 'value' => 'newsletter' ),
		// 'show_on'      => array( 'id' => array( 3086, ) ), // Specific post IDs to display this metabox
	) );

	$polst_enewsletter->add_field( array(
		'name' => __( 'Newsletter URL', 'cmb2' ),
		'desc' => __( 'Upload a file or enter an URL.', 'cmb2' ),
		'id'   => $prefix . 'file_url',
		'type' => 'file',
		'preview_size' => array( 100, 100 ),
	) );

}


// delete the function below when newsletters get transffered from page to custom post type
add_action( 'cmb2_admin_init', 'polst_newsletter_archive' );
function polst_newsletter_archive() {

	$prefix = '_nla_';

	$nla = new_cmb2_box( array(
		'id' => $prefix . 'pdf',
		'title' => __( 'Newsletter Archive', 'cmb2' ),
		'object_types' => array( 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'show_on' => array( 'key' => 'page-template', 'value' => 'page-newsletter-archive.php' ),
	) );


	$nla_group = $nla->add_field( array(
		'id' => $prefix . 'group',
		'type' => 'group',
		'description' => __( 'Create a list of newsletters', 'cmb2' ),
		'options' => array(
			'group_title' => __( 'Newsletter {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button' => __( 'Add Another Newsleter', 'cmb2' ),
			'remove_button' => __( 'Remove Newsletter', 'cmb2' ),
			'sortable' => true, // beta
		),
	) );

	$nla->add_group_field( $nla_group, array(
		'name' => __( 'Newsletter Title', 'cmb2' ),
		'id' => 'title',
		'type' => 'text',
	) );

	$nla->add_group_field( $nla_group, array(
		'name' => __( 'Newsletter URL', 'cmb2' ),
		'desc' => __( 'Upload a file or enter an URL.', 'cmb2' ),
		'id' => 'file',
		'type' => 'file',
		'preview_size' => array( 100, 100 ),
	) );

	$nla->add_group_field( $nla_group, array(
		'name' => __( 'Newsletter Contents', 'cmb2' ),
		'id' => 'contents',
		'type' => 'text',
		'repeatable' => true, 
	) );

}

//================================================
// Adds "for professionals" checkbox to admin pane
//================================================

// add_action( 'cmb2_admin_init', 'polst_is_for_professionals' );
// function polst_is_for_professionals() {

//     /**
//      * Initiate the metabox
//      */
//     $polst_is_for_professionals = new_cmb2_box( array(
//         'id'            => 'is_for_professionals',
//         'title'         => __( 'For Professionals or Consumers', 'cmb2' ),
//         'object_types'  => array( 'page', ), // Post type
//         'context'       => 'normal',
//         'priority'      => 'high',
//         'show_names'    => true // Show field names on the left
//     ) );

//     // Checkbox field
//     $polst_is_for_professionals->add_field( array(
//         'desc'       => __( 'This page is for professionals "mode"', 'cmb2' ),
//         'id'         => '_polst_is_for_professionals',
//         'type'       => 'checkbox',
//         'show_on_cb' => 'cmb2_hide_if_no_cats' // function should return a bool value
//     ) );
// }
