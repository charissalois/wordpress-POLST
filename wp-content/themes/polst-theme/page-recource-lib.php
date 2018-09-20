<?php
/**
* Template Name: Resources Library
*/


add_action('genesis_after_entry_content', 'polst_edu_resources');

function polst_edu_resources(){ 

	// load script for sorting tables

	wp_enqueue_script( 'datatables', get_stylesheet_directory_uri() . '/assets/js/datatables-min.js', array(), '1.0.0', true );
	

	$edu_args = array(
		'post_type' => 'educational_resource',
		'posts_per_page' => -1,
		);
	// The Query
	$the_query = new WP_Query( $edu_args );
	
?>

	<?php 
	// The Loop
	if ( $the_query->have_posts() ) {
	?>

	<div class="resources">
		<div class="resources__table">
			<div class="resources__table--filters">
				<?php
				$arr_type = [];
				$arr_lang = [];
				$arr_file = [];
				$arr_permission = [];
				$arr_state = [];

				 while ( $the_query->have_posts() ) {

					$the_query->the_post(); 

					$res_lang = get_post_meta(get_the_ID(), 'wpcf-language', true );
					$res_file = get_post_meta(get_the_ID(), 'wpcf-file_type', true );
					$res_type = get_post_meta(get_the_ID(), 'wpcf-resource_type', true );
					$res_permission = get_post_meta(get_the_ID(), 'wpcf-permission-to-adapt-resource', true );
					if ( $res_permission == 'Yes, with written acknowledgement' ) {
						$res_permission_short = 'permission-written';
					} else if ( $res_permission == 'Yes, with conditions' ) {
						$res_permission_short = 'permission-conditions';
					} else if ( $res_permission == 'Resource cannot be adapted or reproduced' ) {
						$res_permission_short = 'permission-no';
					}
					$res_link = get_post_meta(get_the_ID(), 'wpcf-resource_link', true );
					$res_state = get_post_meta(get_the_ID(), 'wpcf-resource_state', true );

					// check for resource types
					if ( !in_array($res_type, $arr_type) &&  $res_type != "" ) {
					 	$arr_type[] = $res_type;
					 	sort($arr_type);
					}
					// check for resource states
					if ( !in_array($res_state, $arr_state) &&  $res_state != "" ) {
					 	$arr_state[] = $res_state;
					 	sort($arr_state);
					}
					// check for resource languages
					if ( !in_array($res_lang, $arr_lang) &&  $res_lang != "" ) {
					 	$arr_lang[] = $res_lang;
					 	sort($arr_lang);
					}
					// check for file types
					if ( !in_array($res_file, $arr_file) &&  $res_file != "" ) {
					 	$arr_file[] = $res_file;
					 	sort($arr_file);
					}
					// check for resource permissions
					if ( !in_array($res_permission, $arr_permission) &&  $res_permission != "" ) {
					 	$arr_permission[] = $res_permission;
					 	sort($arr_permission);
					}
					

				} // end while
				wp_reset_postdata();
				?>
				<div class="form-group">
					<label for="select-type">Resource type</label>
					<select class="resource-filter-select" id="select-type">
						<option value=""  selected>Select resource type</option>
						<?php
						foreach ($arr_type as $key ) {
							echo '<option value="' . $key . '">' . $key . '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="select-state">State/Region</label>
					<select class="resource-filter-select" id="select-state">
						<option value=""  selected>Select state or region</option>
						<?php
							echo '<option value="United States">United States</option>';
						foreach ($arr_state as $key ) {
							if (($key=='United States')||($key=='Not State Specific')) {}
							else {
								echo '<option value="' . $key . '">' . $key . '</option>';
							}	
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="select-lang">Language</label>
					<select class="resource-filter-select" id="select-lang">
						<option value=""  selected>Select language</option>
						<?php
						foreach ($arr_lang as $key ) {
							echo '<option value="' . $key . '">' . $key . '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="select-file">File type</label>
					<select class="resource-filter-select" id="select-file">
						<option value=""  selected>Select file type</option>
						<?php
						foreach ($arr_file as $key ) {
							echo '<option value="' . $key . '">' . $key . '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="select-permission">Usage rights</label>
					<select class="resource-filter-select" id="select-permission">
						<option value=""  selected>Select usage rights</option>
						<?php
						foreach ($arr_permission as $key ) {
							echo '<option value="' . $key . '">' . $key . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="resources__table--filters-reset text-center">
				<button class="reset-filters button js-reset-filters" type="reset">reset</button>
			</div>
			<div class="resources__table--holder">
				<table id="resources_table" class="data_table"> 
					<thead>
						<tr>
							<th  class="resource-title">Title</th>
							<th  class="resource-lang">Language</th>
							<th  class="resource-date">Document Date</th>
							<th  class="resource-type">File Type</th>
							<th  class="resource-permission">Usage Rights</th>
							<!-- <th data-sortable="false" class="resource-link">Resource Link</th> -->
							<th class="resource-state" style="display: none;">Resource State</th>
							<th class="resource-state" style="display: none;">Resource Type</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ( $the_query->have_posts() ) {
							$the_query->the_post();

							$res_lang = get_post_meta(get_the_ID(), 'wpcf-language', true );
							$res_date = get_post_meta(get_the_ID(), 'wpcf-date', true );
							$res_file = get_post_meta(get_the_ID(), 'wpcf-file_type', true );
							$res_type = get_post_meta(get_the_ID(), 'wpcf-resource_type', true );
							$res_permission = get_post_meta(get_the_ID(), 'wpcf-permission-to-adapt-resource', true );
							if ( $res_permission == 'Yes, with written acknowledgement' ) {
								$res_permission_short = 'permission-written';
							} else if ( $res_permission == 'Yes, with conditions' ) {
								$res_permission_short = 'permission-conditions';
							} else if ( $res_permission == 'Resource cannot be adapted or reproduced' ) {
								$res_permission_short = 'permission-no';
							}
							$res_link = get_post_meta(get_the_ID(), 'wpcf-resource_link', true );
							$res_state = get_post_meta(get_the_ID(), 'wpcf-resource_state', true );
						?>
							<tr class="<?php echo strtolower($res_lang) . ' ' . strtolower($res_type) . ' ' . strtolower($res_file) . ' ' . $res_permission_short . ' ' . strtolower($res_state); ?>">
								<td class="resource-title">
									<a href="<?php echo $res_link; ?>" target="_blank"><?php the_title(); ?></a>
									
								</td>
								<td class="resource-lang">
									<?php echo $res_lang; ?>
								</td>
								<td class="resource-date">
									<?php echo $res_date; ?>
								</td>
								<td class="resource-type">
									<?php echo $res_file; ?>
								</td>
								<td class="resource-permission">
									<?php echo $res_permission; ?>
								</td>
								 
								<td class="resource-state " style="display: none;">
									<?php echo $res_state; ?>
								</td>
								<td class="resource-type " style="display: none;">
									<?php echo $res_type; ?>
								</td>
							</tr>

						<?php
						} // endwhile
						?>
					</tbody>
					<tfoot>
						<tr>
							<th>
							
							</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>


							
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>


	<?php	
	} else {
			// no posts found
		}
	/* Restore original Post Data */
	wp_reset_postdata();
} //polst_edu_resources

genesis();
