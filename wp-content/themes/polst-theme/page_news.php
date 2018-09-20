<?php

//* Template Name: News


/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'polst_news_loop' );
 
function polst_news_loop() {
 
    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args
    $args = array(
        'post_type' => 'post', // exclude posts from this category
        'paged'     => $paged, // respect pagination
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}

// add pagination at the top
// add_action( 'genesis_before_entry', 'genesis_posts_nav' );


// add sidebar
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');

// add url query (pro=1) if for professionals
add_filter( 'genesis_post_title_output', 'polst_custom_post_title' );
function polst_custom_post_title( $title ) {
	if( get_post_type( get_the_ID() ) == 'post' ) {
		$post_title = get_the_title( get_the_ID() );
		$post_permalink = get_the_permalink( get_the_ID() );
		$isForProfessionals = is_for_professionals();
		if ($isForProfessionals) {
			$post_url = esc_url( add_query_arg( 'pro', '1', $post_permalink ) );
		} else {
			$post_url = $post_permalink;
		}
		$title = '<h3 class="entry-title" itemprop="headline"><a href=" '.$post_url.' ">' . $post_title . '</a></h3>';
	}
	return $title;
}

genesis();
