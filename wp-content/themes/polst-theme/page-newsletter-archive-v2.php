<?php
/**
* Template Name: eNewsletter Archive 
*/


add_action('genesis_after_entry_content', 'polst_nletter_archive');

function polst_nletter_archive(){ 

	// load script for sorting tables

	wp_enqueue_script( 'datatables', get_stylesheet_directory_uri() . '/assets/js/datatables-min.js', array(), '1.0.0', true );
	
	
?>

	<?php
	$nla_items = get_post_meta( get_the_ID(),'_nla_group', true);
	if ($nla_items) {
	?>

	<div class="newsletter-archive entry-content">
		<div class="newsletter-archive__table">
			
			<div class="newsletter-archive__table--holder">
				<table id="nla_table" class="data_table"> 
					<thead class="hidden">
						<tr>
							<th class="nla-title">Title</th>
							<th class="nla-contents">Contents</th>
						</tr>
					</thead>
					<tbody>
						<?php $nla_args = array(
							'post_type' => 'newsletter',
							'posts_per_page' => -1,
							'orderby' => 'menu_order',
							'order'   => 'ASC',
							); 
						?>
						<?php $nla_query = new WP_Query( $nla_args );
						if ( $nla_query->have_posts() ) :
							while ( $nla_query->have_posts() ) : $nla_query->the_post(); ?>

						<tr>
							<td class="nla-title">
								<a href="<?php echo get_post_meta(get_the_ID(), '_newsletter_file_url', true ); ?>" target="_blank"><?php the_title(); ?></a>
								
							</td>
							<td class="nla-content">
								<?php the_content(); ?>
							</td>
						</tr>

							<?php endwhile; ?>
						<?php endif; ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<?php	
	} // if
	// } else {
	// 		// no posts found
	// 	}
	/* Restore original Post Data */
	wp_reset_postdata();
} //polst_edu_resources

genesis();
