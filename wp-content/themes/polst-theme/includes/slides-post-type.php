<?php

// // Flush rewrite rules for custom post types
// add_action( 'after_switch_theme', 'polst_flush_rewrite_rules' );

// // Flush your rewrite rules
// function polst_flush_rewrite_rules() {
// 	flush_rewrite_rules();
// }

// let's create the function for the custom type
function slider_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'slides', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Home Slider', 'polst' ), /* This is the Title of the Group */
			'singular_name' => __( 'Slide', 'polst' ), /* This is the individual type */
			'all_items' => __( 'All Slides', 'polst' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'polst' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Slide', 'polst' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'polst' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Slides', 'polst' ), /* Edit Display Title */
			'new_item' => __( 'New Slide', 'polst' ), /* New Display Title */
			'view_item' => __( 'View Slide', 'polst' ), /* View Display Title */
			'search_items' => __( 'Search Slides', 'polst' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'polst' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'polst' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the custom post type for the slider on home page', 'polst' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'slides', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'slides', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'thumbnail', 'excerpt', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	// register_taxonomy_for_object_type( 'category', 'slides' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'slides' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'slider_post_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	// register_taxonomy( 'custom_cat', 
	// 	array('slides'), /* if you change the name of register_post_type( 'slides', then you have to change this */
	// 	array('hierarchical' => true,     /* if this is true, it acts like categories */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Categories', 'polst' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Category', 'polst' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Categories', 'polst' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Categories', 'polst' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Category', 'polst' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Category:', 'polst' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Category', 'polst' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Category', 'polst' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Category', 'polst' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Category Name', 'polst' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true, 
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 		'rewrite' => array( 'slug' => 'custom-slug' ),
	// 	)
	// );
	
	// now let's add custom tags (these act like categories)
	// register_taxonomy( 'custom_tag', 
	// 	array('slides'), /* if you change the name of register_post_type( 'slides', then you have to change this */
	// 	array('hierarchical' => false,    /* if this is false, it acts like tags */
	// 		'labels' => array(
	// 			'name' => __( 'Custom Tags', 'polst' ), /* name of the custom taxonomy */
	// 			'singular_name' => __( 'Custom Tag', 'polst' ), /* single taxonomy name */
	// 			'search_items' =>  __( 'Search Custom Tags', 'polst' ), /* search title for taxomony */
	// 			'all_items' => __( 'All Custom Tags', 'polst' ), /* all title for taxonomies */
	// 			'parent_item' => __( 'Parent Custom Tag', 'polst' ), /* parent title for taxonomy */
	// 			'parent_item_colon' => __( 'Parent Custom Tag:', 'polst' ), /* parent taxonomy title */
	// 			'edit_item' => __( 'Edit Custom Tag', 'polst' ), /* edit custom taxonomy title */
	// 			'update_item' => __( 'Update Custom Tag', 'polst' ), /* update title for taxonomy */
	// 			'add_new_item' => __( 'Add New Custom Tag', 'polst' ), /* add new title for taxonomy */
	// 			'new_item_name' => __( 'New Custom Tag Name', 'polst' ) /* name title for taxonomy */
	// 		),
	// 		'show_admin_column' => true,
	// 		'show_ui' => true,
	// 		'query_var' => true,
	// 	)
	// );
	
	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
	*/
	

?>