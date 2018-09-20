<?php

//* This file handles single entries for the child theme.

remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
add_action( 'genesis_entry_header', 'genesis_post_info', 9 ); 

// add_action( 'genesis_entry_footer', 'polst_share_and_print');
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');

add_action('genesis_after_entry', 'polst_post_nav');
function polst_post_nav(){
	$uri = $_SERVER['QUERY_STRING'];
	$is_pro = $uri ; // for the first parameter
	if ( $is_pro == 'pro=1') { ?>
		<nav class="post-nav">
	        <a href="<?php echo esc_url(add_query_arg( 'pro', '1', get_permalink(get_adjacent_post(false,'',true)))); ?>" class="">&laquo; Previous News Story</a>
	        <a href="<?php echo esc_url( add_query_arg( 'pro', '1', get_permalink(get_adjacent_post(false,'',false)))); ?>" class="">Next News Story &raquo;</a>
		</nav>
	<?php } else { ?>
		<nav class="post-nav">
	        <a href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>" class="">&laquo; Previous News Story</a>
	        <a href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>" class="">Next News Story &raquo;</a>
		</nav>
	<?php  } ?>
	<?php get_template_part( 'template-parts/share-and-print' ); ?>
<?php }

genesis();

