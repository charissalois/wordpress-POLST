<?php if ( ! empty( $instance['document_url'] )  ) { ?>
	<div class="download-pdf-widget">
		<div class="description">
			<h3><?php echo $instance['document_title'] ?></h3>
			<p><?php echo $instance['document_description'] ?></p>
		</div>
		<div class="download">
			<a class="button blue" href="<?php echo wp_get_attachment_url($instance['document_url']) ?>" target="_blank"> 
				Download PDF

				<svg class="icon icon-file-pdf-o"><use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-file-pdf-o"></use></svg>
			</a>
		</div>

	</div>
<?php }  else if ( ! empty( $instance['external_document_url'] )  ) { ?>
	<div class="download-pdf-widget">
		<div class="description">
			<h3><?php echo $instance['document_title'] ?></h3>
			<p><?php echo $instance['document_description'] ?></p>
		</div>
		<div class="download">
			<a class="button blue" href="<?php echo $instance['external_document_url'] ?>" target="_blank"> 
				Download
			</a>
		</div>

	</div>
<?php } ?>