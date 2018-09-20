<?php
/**
* Template Name: Page with Right Sidebar
* Description: Used for news page
*/

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');

add_action('genesis_after_entry', 'polst_post_nav');
function polst_post_nav(){
	get_template_part( 'template-parts/share-and-print' );
}

genesis();
