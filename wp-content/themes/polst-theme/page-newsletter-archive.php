<?php
/**
* Template Name: Newsletter Archive
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
						<?php
							foreach ($nla_items as $nla_item) {
						?>
							<tr class="">
								<td class="nla-title">
									<a href="<?php echo $nla_item['file']; ?>" target="_blank"><?php echo $nla_item['title']; ?></a>
									
								</td>
								<td class="nla-content">
									<?php
										$contents = $nla_item['contents'];
										if ($contents){
											foreach ($contents as $content) {
												echo '<span class="newsletter-contents">' . $content . '</span>';
											}
										}
									?>
								</td>
							</tr>

						<?php
							} // foreach
						?>
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
