<?php
// custom post type for state programs


// let's create the function for the custom type
function polst_educational_resources() { 
	// creating (registering) the custom type 
	register_post_type( 'educational_resource', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Educational Resources', 'polst' ), /* This is the Title of the Group */
			'singular_name' => __( 'Educational Resource', 'polst' ), /* This is the individual type */
			'all_items' => __( 'All Educational Resources', 'polst' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'polst' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Educational Resource', 'polst' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'polst' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Educational Resource', 'polst' ), /* Edit Display Title */
			'new_item' => __( 'New Educational Resource', 'polst' ), /* New Display Title */
			'view_item' => __( 'View Educational Resource', 'polst' ), /* View Display Title */
			'search_items' => __( 'Search Educational Resources', 'polst' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'polst' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'polst' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the custom post type for Educational Resources', 'polst' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			// 'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'educational_resource', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'educational_resource', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'revisions')
		) /* end of options */
	); /* end of register post type */

	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'polst_educational_resources');
	
	register_taxonomy( 'resource_cat', 
		array('educational_resource'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Resource Categories', 'polst' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Resource Category', 'polst' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Resource Categories', 'polst' ), /* search title for taxomony */
				'all_items' => __( 'All Resource Categories', 'polst' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Resource Category', 'polst' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Resource Category:', 'polst' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Resource Category', 'polst' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Resource Category', 'polst' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Resource Category', 'polst' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Resource Category Name', 'polst' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'resource-category' ),
		)
	);

	
	

?>