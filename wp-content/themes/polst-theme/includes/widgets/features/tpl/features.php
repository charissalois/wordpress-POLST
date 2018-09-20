<?php
if (!empty($instance['features'])) :
    $i = 0;
	$bg_color = $instance['color']; 
	$display_circle = $instance['display_circle'];
	
	foreach( $instance['features'] as $item ) :
		$i++;
		if ($i == 3) {
			break;
		}
	endforeach;
	?>
	
	<div class="polst-features row">

		<?php 
	    foreach( $instance['features'] as $item ) : ?>

			<?php 
			$url = $item['url'];
			if (!empty($url)) {
				 
			?>
				<!-- if link exist display the section as a link -->
				<a href="<?php echo esc_url($url) ?>" class="polst-feature <?php echo 'number-of-features-' . $i ?>">		
					<div 
						class="<?php if ($display_circle) { echo 'polst-icon-container polst-icon-container--round';}?>"
						<?php if ($display_circle) { echo 'style="background-color:' . $bg_color . '"';}?>
					>
							<?php echo wp_get_attachment_image($item['image'], 'thumbnail') ?>
					</div>
					<h4 class="h4"><?php echo $item['title'] ?></h4>
				</a>

			<?php } else { ?>
				<!-- if link does not exist display just the image and tite -->
				<div class="polst-feature <?php echo 'number-of-features-' . $i ?>">
					<div 
						class="<?php if ($display_circle) { echo 'polst-icon-container polst-icon-container--round';}?>"
						<?php if ($display_circle) { echo 'style="background-color:' . $bg_color . '"';}?>
					>
							<?php echo wp_get_attachment_image($item['image'], 'thumbnail') ?>
					</div>
					<h4 class="h4"><?php echo $item['title'] ?></h4>
				</div>

			<?php } ?>

	    <?php 
	    endforeach;
	    ?>
    </div><!-- /.row -->
    <?php

endif;






						
	