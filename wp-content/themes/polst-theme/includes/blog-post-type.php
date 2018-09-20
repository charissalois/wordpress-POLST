<?php

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'polst_flush_rewrite_rules' );

// Flush your rewrite rules
function polst_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function blog_posts() { 
	// creating (registering) the custom type 
	register_post_type( 'blog', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Blog', 'polst' ), /* This is the Title of the Group */
			'singular_name' => __( 'Blog', 'polst' ), /* This is the individual type */
			'all_items' => __( 'All Blog Posts', 'polst' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'polst' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Blog Post', 'polst' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'polst' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Blog Post', 'polst' ), /* Edit Display Title */
			'new_item' => __( 'New Blog Post', 'polst' ), /* New Display Title */
			'view_item' => __( 'View Blog Post', 'polst' ), /* View Display Title */
			'search_items' => __( 'Search Blog Posts', 'polst' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'polst' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'polst' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a custom post type for Blog posts', 'polst' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			// 'rewrite'	=> array( 'slug' => 'blog', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => false, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky')
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'blog_posts');
	
	

?>