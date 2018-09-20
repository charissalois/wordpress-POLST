<?php
// custom post type for state programs

// Flush rewrite rules for custom post types
// add_action( 'after_switch_theme', 'polst_flush_rewrite_rules' );

// Flush your rewrite rules
// function polst_flush_rewrite_rules() {
	// flush_rewrite_rules();
// }

// let's create the function for the custom type
function custom_post_programs() { 
	// creating (registering) the custom type 
	register_post_type( 'programs', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Polst Programs', 'polst' ), /* This is the Title of the Group */
			'singular_name' => __( 'POLST Program', 'polst' ), /* This is the individual type */
			'all_items' => __( 'All POLST Programs', 'polst' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'polst' ), /* The add new menu item */
			'add_new_item' => __( 'Add New POLST Program', 'polst' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'polst' ), /* Edit Dialog */
			'edit_item' => __( 'Edit POLST Programs', 'polst' ), /* Edit Display Title */
			'new_item' => __( 'New POLST Program', 'polst' ), /* New Display Title */
			'view_item' => __( 'View POLST Program', 'polst' ), /* View Display Title */
			'search_items' => __( 'Search POLST Program', 'polst' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'polst' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'polst' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the custom post type for POLST Programs in states', 'polst' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'programs', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'programs', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'revisions')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type( 'category', 'programs' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'programs' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_programs');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	// register_taxonomy( 'custom_cat', //custom category for program status
	// 	array('programs'), /* if you change the name of register_post_type( 'programs', then you have to change this */
	// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
	// 		'labels' => array(
	// 			'name' => __( 'Status', 'polst' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Status', 'polst' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Status', 'polst' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Stautses', 'polst' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Status', 'polst' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Status:', 'polst' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Status', 'polst' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Status', 'polst' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Status', 'polst' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Status Name', 'polst' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true, 
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array( 'slug' => 'status-slug' ),
	// 	)
	// );
	
	

?>