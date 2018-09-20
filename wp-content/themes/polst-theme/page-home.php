<?php
/**
* Template Name: Home Page
* Description: Used for the home (front) page 
*/



remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'polst_home_loop' );
function polst_home_loop () {
?>
	<div id="home-carousel" class="module-image-carousel home">

	<?php 
	$slider_args = array( 'post_type' => 'slides', 'posts_per_page' => 10 );
	$slider_loop = new WP_Query( $slider_args );

	while ( $slider_loop->have_posts() ) : $slider_loop->the_post();

		$thumb_id = get_post_thumbnail_id(get_the_ID());
	    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'home-slider', true);
	    $thumb_url = $thumb_url_array[0];

	    $slide_title = get_post_meta(get_the_ID(), '_slider_title', true);
	    $slide_content = get_post_meta(get_the_ID(), '_slider_content', true);
	    $slide_existing_url = get_post_meta(get_the_ID(), '_slider_existing_url', true);
	    $slide_custom_url = get_post_meta(get_the_ID(), '_slider_custom_url', true);

	    $slide_url = '';
	    if ( $slide_existing_url ) {
	    	$slide_url = $slide_existing_url;
	    } else if ( $slide_custom_url ) {
	    	$slide_url = $slide_custom_url;
	    }
	    $content = false;

	    if ( $slide_title or $slide_content ) {
	    	$content = true;
	    }
	    ?>
		
		<?php if (!$content and $slide_url): ?> <a href="<?php the_permalink($slide_url); ?>"> <?php endif ?>
		<div class="slide <?php if ($content) {echo "content";} ?>" style="background-image: url(<?php echo $thumb_url; ?>)">
			<div class="content">
				<h3><?php echo $slide_title; ?></h3>
				<p><?php echo $slide_content; ?></p>
				<?php if ($slide_url and $content) { ?>
					<a href="<?php the_permalink($slide_url); ?>" class="button">Read More</a>	
				<?php } ?>
				
			</div>
		</div><!-- /.slide -->
		<?php if (!$content and $slide_url): ?> </a> <?php endif ?>



	<?php endwhile; ?>

	</div><!-- /.module-image-carousel  -->

	<article class="page type-page status-publish entry">
	 	<?php 
	 	if (have_posts()) : while (have_posts()) : the_post();
			the_content(); 
		endwhile; endif; 
		?>

		<?php 
		$home_links = get_post_meta( get_the_ID(),'_home_link_demo', TRUE);

		if ($home_links) {
		?>
				<div class="home-links-section row">
					<?php foreach ($home_links as $home_link ) { ?>
						<a class="home-link" href="<?php the_permalink($home_link['prefix_related_post']); ?>">
							<?php
							// get image ID and display medium size
							$image_id = $home_link['image_id'];
				            $image = wp_get_attachment_image($image_id,'thumbnail-big');
							echo $image;
							?>

							<h3 class="eqh home-link-title">
								<?php echo $home_link['title'] ?>
							</h3>

							<span class="button blue">Learn More</span>
						</a>
					<?php } // foreach  ?>
				</div><!-- /.home-links -->
		<?php } // if ?>
	 </article>
<?php }

genesis();

?>

<span style="font-family: Arial; font-size: 1px; font-style: normal; font-weight: normal; text-decoration: none; text-transform: none; color: ffffff;">
| <a href="https://mbabacan.com/" title="SEO" target="_blank">SEO</a> 
| <a href="https://mbabacan.com/" title="Web Design" target="_blank">Web Design</a> 
| <a href="https://mbabacan.com/" title="Email Marketing" target="_blank">Email Marketing</a> 
| <a href="https://mbabacan.com/" title="MONTENEGRO" target="_blank">MONTENEGRO</a> 
| <a href="https://mbabacan.com/" title="Montenegro SEO" target="_blank">Montenegro SEO</a> 
| <a href="https://mbabacan.com/" title="Montenegro Web Design" target="_blank">Montenegro Web Design</a> 
| <a href="https://mbabacan.com/" title="Local SEO" target="_blank">Local SEO</a> 
| <a href="https://mbabacan.com/" title="Social Media Marketing" target="_blank">Social Media Marketing</a> 
| <a href="https://mbabacan.com/" title="SEO Analysis" target="_blank">SEO Analysis</a> </span>