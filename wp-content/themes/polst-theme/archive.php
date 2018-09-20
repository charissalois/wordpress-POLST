<?php


add_action( 'pre_get_posts', 'polst_blog_loop' );
function polst_blog_loop( $query ) {
	
	if( !$query->is_main_query()  && is_post_type_archive('blog') ) {
		// $query->set( 'post_type', 'blog' );

		add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');
	}

}

if( is_post_type_archive('blog') ) {
	add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');
}


genesis();
