

<div class="home-links-section row">


			<?php if ( ! empty( $instance['first_item_section'] )  ) { ?>
				
				<a class="home-link" href="<?php echo sow_esc_url($instance['first_item_section']['showcase_link1']) ?>">				
					
					<?php echo wp_get_attachment_image($instance['first_item_section']['showcase_media1'], 'thumbnail-big') ?>

					<h3 class="eqh home-link-title">
						<?php echo $instance['first_item_section']['showcase_title1'] ?>
					</h3>

					<span class="button blue">Learn More</span>
				</a>

			<?php } ?>

			<?php if ( ! empty( $instance['second_item_section'] )  ) { ?>

				<a class="home-link" href="<?php echo sow_esc_url($instance['second_item_section']['showcase_link2']) ?>">				
					
					<?php echo wp_get_attachment_image($instance['second_item_section']['showcase_media2'], 'thumbnail-big') ?>

					<h3 class="eqh home-link-title">
						<?php echo $instance['second_item_section']['showcase_title2'] ?>
					</h3>

					<span class="button blue">Learn More</span>
				</a>

			<?php } ?>

			<?php if ( ! empty( $instance['third_item_section'] )  ) { ?>

				<a class="home-link" href="<?php echo sow_esc_url($instance['third_item_section']['showcase_link3']) ?>">				
					
					<?php echo wp_get_attachment_image($instance['third_item_section']['showcase_media3'], 'thumbnail-big') ?>

					<h3 class="eqh home-link-title">
						<?php echo $instance['third_item_section']['showcase_title3'] ?>
					</h3>

					<span class="button blue">Learn More</span>
				</a>

			<?php } ?>
            

    </div><!-- /.home-links -->

