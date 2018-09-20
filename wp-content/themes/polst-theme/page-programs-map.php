<?php
/**
* Template Name: Programs in Your State 
* Description: Used for the home Programs in Your State map and information
*/


//* Remove page titles site wide (posts & pages) (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* add map
add_action('genesis_before_entry', 'polst_programs_map');
function polst_programs_map(){ ?>

	<?php
	global $wp_query;
	$post = $wp_query->post;
	
	$color_mature = get_post_meta(get_the_ID(), '_program_color_mature', true );
	$color_endorsed = get_post_meta(get_the_ID(), '_program_color_endorsed', true );
	$color_developing = get_post_meta(get_the_ID(), '_program_color_developing', true );
	$color_nonconforming = get_post_meta(get_the_ID(), '_program_color_nonconforming', true );
	$color_none = get_post_meta(get_the_ID(), '_program_color_none', true );
	?>
	<!-- add map colors to data attribute -->
	<div id="programs-map" class="programs-map" data-cmature="<?php echo $color_mature ?>" data-cendorsed="<?php echo $color_endorsed;?>" data-cdeveloping="<?php echo $color_developing;?>" data-cnonconforming="<?php echo $color_nonconforming;?>" data-cnone="<?php echo $color_none;?>">
		<div id="bar" class="info-bar text-center">
			<h3>
				<span class="button pink thin pull-left print-hide js-back-top-map">&laquo; Back to Map</span>
				<span class="region-name"></span>
			</h3>
		</div><!-- /.info-bar -->
		<div class="the-legend">
			<h3 class="h2">National POLST Paradigm Program Designations</h3><h4 class="h2">Click a state for more information</h4>
			<ul class="status">
				<li>
					<span class="badge mature" style="background: <?php echo $color_mature; ?>"></span>
					<a href="#" data-toggle="tooltip" data-placement="top" data-title="<?php echo get_post_meta(get_the_ID(), '_program_definition_mature', true );?>">
					mature
					</a>
				</li>
				<li>
					<span class="badge endorsed" style="background: <?php echo $color_endorsed; ?>"></span>
					<a href="#" data-toggle="tooltip" data-placement="top" data-title="<?php echo get_post_meta(get_the_ID(), '_program_definition_endorsed', true );?>">
						endorsed
					</a>
				</li>
				<li>
					<span class="badge developing" style="background: <?php echo $color_developing; ?>"></span>
					<a href="#" data-toggle="tooltip" data-placement="top" data-title="<?php echo get_post_meta(get_the_ID(), '_program_definition_developing', true );?>">
						developing
					</a>
				</li>
				<li>
					<span class="badge non-conforming" style="background: <?php echo $color_nonconforming; ?>"></span>
					<a href="#" data-toggle="tooltip" data-placement="top" data-title="<?php echo get_post_meta(get_the_ID(), '_program_definition_non-conforming', true );?>">
						non-conforming
					</a>
				</li>
				<!-- <li>
					<span class="badge none" style="background: <?php echo $color_none; ?>"></span>
					<a href="#" data-toggle="tooltip" data-placement="top" data-title="<?php echo get_post_meta(get_the_ID(), '_program_definition_no', true );?>">
						Oregon has separated from the National POLST organization due to operational differences
					</a>
				</li> -->
				<li>
					<img class="badge" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/asterisk.png" alt="Asterisk">
					
						<!-- Oregon has separated from the National POLST organization due to operational differences -->
					<?php echo get_post_meta(get_the_ID(), '_program_definition_asterisk', true );?>
				</li>
			</ul>
			<p class="legend-info text-sm text-gray-light" style="">Totals include WASHINGTON DC.<br />
			MATURE Programs are also Endorsed and are counted in both the Mature and Endorsed Program totals.
			<br />
			<a href="#levels">LEARN MORE in the text below the map</a>
			</p>
		
		</div><!-- /.legend -->

		<!-- generated info -->
		<div class="state-info">
			<?php

			$programs_args = array( 'post_type' => 'programs', 'posts_per_page' => -1 );
			$programs_loop = new WP_Query( $programs_args );

			if ( $programs_loop->have_posts() ) : while ( $programs_loop->have_posts() ) : $programs_loop->the_post();

			$contact_info = get_post_meta( get_the_ID(),'_program_contact_contact_group', true);

			$network_info = get_post_meta( get_the_ID(),'_program_social_social_group', true);

			$program_name = get_post_meta(get_the_ID(), '_program_info_program_name', true );
			$program_website = get_post_meta(get_the_ID(), '_program_info_program_website', true );
			$registry_website = get_post_meta(get_the_ID(), '_program_info_registry_website', true );
			$program_started_on = get_post_meta(get_the_ID(), '_program_info_program_started', true );
			$program_endorsed_since = get_post_meta(get_the_ID(), '_program_info_program_endorsed', true );
			$program_mature_since = get_post_meta(get_the_ID(), '_program_info_program_mature', true );
			$program_legislative_info = get_post_meta(get_the_ID(), '_program_info_program_legislative_info', true );

			$program_status_description = get_post_meta(get_the_ID(), '_program_info_program_status_description', true );

			$status = get_post_meta(get_the_ID(), 'wpcf-status', true );
			$state = get_post_meta(get_the_ID(), 'wpcf-state', true);
			?>

			<?php



			if ( $status == '4') {
				$status_pretty = 'Mature';
			}
			else if ( $status == '3') {
				$status_pretty = 'Endorsed';
			}
			else if ( $status == '2') {
				$status_pretty = 'Developing';
			}
			else if ( $status == '1') {
				$status_pretty = 'Non Conforming';
			}
			else if ( $status == '0') {
				$status_pretty = 'Oregon has separated from the National POLST organization due to operational differences';
			}
			?>

<div class="program <?php echo 'program-' . $status; ?>" style="display: none;" id="<?php echo get_post_meta(get_the_ID(), 'wpcf-state', true) ?>" data-state="<?php echo $state; ?>" data-status="<?php echo $status; ?>"> 

	<span class="status"><strong>Status:</strong> <?php echo $status_pretty; ?>. <?php if ( $status == '3' || $status == '4' ){ echo '<br /><strong>NOTE</strong>: Please search for state-specific POLST forms/resources in our <a href="/library">Resource Library</a>.'; } ?></span><span class="badge <?php echo 'badge' . $status; ?>"></span>
		
		<div class="table-holder-outer"> 
			<div class="table-holder-inner">
				<table class="dark">
					<tr>
						<td class="heading">State</td>
						<td>
							<?php the_title(); ?>
						</td>
					</tr>
					<?php if ($contact_info) : foreach ($contact_info as $contact) { ?>
						<?php  if ( !empty($contact['contact_name']) ) : ?>
							<tr>
								<td class="heading">Program Contact</td>
								<td>
										<span class="contact-name"><?php echo $contact['contact_name']; ?></span>
										<span class="contact-position"><?php echo $contact['contact_position']; ?></span>
										<?php
											$email_address = $contact['contact_email'];
											$encodedEmail = encode_email_address( $email_address );
											printf('<a href="mailto:%s">%s</a>', $encodedEmail, $encodedEmail);
										?>
								</td>
							</tr>
						<?php endif; ?>
						<?php  if ( !empty( $contact['contact_address']) ) : ?>
							<tr>
								<td class="heading">Address</td>
								<td>
									<?php echo nl2br($contact['contact_address']); ?>
								</td>
							</tr>
						<?php endif; ?>
						<?php  if ( !empty( $contact['contact_organization']) ) : ?>
							<tr>
								<td class="heading">Organization</td>
								<td>
									<?php echo $contact['contact_organization']; ?>
								</td>
							</tr>
						<?php endif; ?>
						<?php  if ( !empty( $contact['contact_phone']) ) : ?>
							<tr>
								<td class="heading">Phone</td>
								<td>
									<?php echo $contact['contact_phone']; ?>
								</td>
							</tr>
						<?php endif; ?>
						<?php  if ( !empty( $contact['contact_fax']) ) : ?>
							<tr>
								<td class="heading">Fax</td>
								<td>
									<?php echo $contact['contact_fax']; ?>
								</td>
							</tr>
						<?php endif; ?>
						<?php  if ( !empty( $contact['contact_email']) ) : ?>
							<tr>
								<td class="heading">Email</td>
								<td>
									<?php 
									$email_address = $contact['contact_email'];
									$encodedEmail = encode_email_address( $email_address );
									printf('<a href="mailto:%s">%s</a>', $encodedEmail, $encodedEmail);
									?>
								</td>
							</tr>
						<?php endif; ?>
					<?php } endif; ?>

					<?php  if ($network_info) { ?> 
						<tr>
							<td class="heading">Social Media</td>
							<td>
								<?php foreach ($network_info as $network) { ?>
					
									<?php  if ( !empty($network['network_name']) ) { ?>
										<a href="<?php echo $network['network_url']; ?>" target="_blank" class="program__social-network"><?php echo $network['network_name']; ?></a>
									<?php } ?>
								<?php } ?>
							</td>
							
						</tr>
					<?php } ?>

					<?php if ( !empty($program_status_description) ) : ?>
							<tr class="important-info">
								<td class="heading">Status</td>
								<td>
									<?php echo $program_status_description; ?>
								</td>
							</tr>
						<?php endif; ?>
				</table>
			</div><!-- /.table-holder -->
		</div><!-- /.table-holder -->

		<div class="table-holder-outer"> 
			<div class="table-holder-inner">
				<table class="dark">
					<?php if ( !empty($program_name) ) : ?>
						<tr>
							<td class="heading">Program name</td>
							<td>
								<?php echo $program_name; ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($program_website) ) : ?>
						<tr>
							<td class="heading">Program website</td>
							<td>
								<a href="<?php echo $program_website; ?>" target="_blank"><?php echo $program_website; ?></a>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($registry_website) ) : ?>
						<tr>
							<td class="heading">Registry website</td>
							<td>
								<a href="<?php echo $registry_website; ?>" target="_blank"><?php echo $registry_website; ?></a>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($program_started_on) ) : ?>
						<tr>
							<td class="heading">Started on</td>
							<td>
								<?php echo $program_started_on; ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($program_endorsed_since) ) : ?>
						<tr>
							<td class="heading">Endorsed since</td>
							<td>
								<?php echo $program_endorsed_since; ?>

							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($program_mature_since) ) : ?>
						<tr>
							<td class="heading">Mature since</td>
							<td>
								<?php echo $program_mature_since; ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ( !empty($program_legislative_info) ) : ?>
						<tr>
							<td class="heading">Legislative<br />Information</td>
							<td class="legislative-info">
								<?php echo $program_legislative_info; ?>
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</div><!-- /.table-holder -->
		</div><!-- /.table-holder -->
		<span class="button pink thin pull-left print-hide js-back-top-map">&laquo; Back to Map</span>


<div>
<?php // echo wpautop($post->post_content); ?>
</div>

</div><!-- /.program -->

<?php 
// endforeach; 
endwhile; endif; wp_reset_postdata(); 

?>
</div><!-- /.state-info -->
<!-- /generated info -->

	<?php // $map_pdf = get_post_meta(get_the_ID(), '_map_pdf_url', true ); ?>
	<?php // $status_pdf = get_post_meta(get_the_ID(), '_map_status_url', true ); ?>

		<div id="the-map" class="the-map">
			
		</div><!-- /.the map -->

		<div class="map-resources">
				<div class="row">
					<div class="additional-maps">
						<?php $add_maps_items = get_post_meta( get_the_ID(),'_download_map_group', true); 
						if ($add_maps_items) {
						?>
							<h4>Additional maps</h4>
							<!-- buttons-->
							<?php 
						
						
							foreach ($add_maps_items as $add_maps_item) { ?>
								<div class="download-button-wrapper">
									<?php $add_button_color = $add_maps_item['color']; ?>
									<a href="<?php echo $add_maps_item['url']; ?>" target="_blank" class="button thin blue download-button no-print" style="background-color: <?php echo $add_button_color; ?>">
										<?php echo $add_maps_item['title']; ?>
										<svg class="icon icon-file-pdf-o">
							            	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-file-pdf-o"></use>
							            </svg>
									</a>
								</div>
							<?php } ?>
						<?php } ?>
						<!-- ./buttons -->
					</div><!-- /.additional-maps -->

					<div class="additional-resources">
						<h4>Additional resources</h4>
						<!-- buttons-->
						<?php 
						$download_items = get_post_meta( get_the_ID(),'_download_button_group', true);
						if ($download_items) {
							foreach ($download_items as $download_item) { ?>
								<div class="download-button-wrapper">
									<a href="<?php echo $download_item['url']; ?>" target="_blank" class="button thin blue download-button no-print">
										<?php echo $download_item['title']; ?>
										<svg class="icon icon-file-pdf-o">
							            	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-file-pdf-o"></use>
							            </svg>
									</a>
								</div>
							<?php } ?>
						<?php } ?>
						<!-- ./buttons -->
					</div><!-- /.additional-resources -->




				</div><!-- /.row -->
				
			</div><!-- /.map-resources -->
		

	</div><!-- /.programs-map -->




<!-- /generated info -->

<?php }
// Enqueue 
	add_action( 'wp_enqueue_scripts', 'polst_enqueue_map_scripts' );
	function polst_enqueue_map_scripts() {
	    wp_enqueue_script( 'jvectormap', get_stylesheet_directory_uri() . '/assets/js/jvectormap-2.0.3.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script( 'jvectormaps', get_stylesheet_directory_uri() . '/assets/js/jvectormap-data-us-ut-aea-en.js ', array( 'jquery' ), false, false );
		wp_enqueue_script( 'usa-map', get_stylesheet_directory_uri() . '/assets/js/jquery-jvectormap-us-lcc.js', array( 'jquery' ), '', false );
	}


add_action('genesis_after', 'polst_map_js');
function polst_map_js(){ 
?>
 
<script>

(function( $ ){
//======================================
	// Programs in your states map
	var $regions = ["US-AZ","US-WY","US-WI","US-WV","US-DC","US-WA","US-VA","US-VT","US-UT","US-TX","US-TN","US-SD","US-SC","US-RI","US-PA","US-OR","US-OK","US-OH","US-ND","US-NC","US-NY","US-NM","US-NJ","US-NH","US-NV","US-NE","US-MT","US-MO","US-MS","US-MN","US-MI","US-MA","US-MD","US-ME","US-LA","US-KY","US-KS","US-IA","US-IN","US-IL","US-ID","US-HI","US-GA","US-FL","US-DE","US-CT","US-CA","US-CO","US-AR","US-AK","US-AL"];

	var programs = {};
	$('.program').each(function(i, e) {
		var state = $(this).attr('data-state');
		var status = $(this).attr('data-status');
        programs[state] = status;
    });

	if ( $('body').hasClass('page-template-page-programs-map') ) {

		var pins = [
			{coords: [38.90, -77.03], name: 'Washington DC', status: 'true'},
			{coords: [43.8, -120.55], name: 'Oregon has separated from the National POLST organization due to operational differences', status: 'false'},
		];

		$('#the-map').vectorMap({
			map: 'us_lcc',
	    	backgroundColor: 'transparent',
	    	zoomOnScroll: true,
	    	markerStyle: {
		    	initial: {
			    	fill: '#029ea8',
			    	stroke: '#353439'
		    	}
		    },
	    	markers: pins.map(function(h) {
	        return {
	          name: h.name,
	          latLng: h.coords
	        }
	      }),

			onRegionClick: function(event, code){
			var mapObj = $('#the-map').vectorMap('get', 'mapObject');
				$('.programs-map').addClass('region-open');
				$('.program').hide();
				$('#bar .region-name').html('');
				$('#bar .region-name').append(mapObj.getRegionName(code));
				$('.entry-content').hide();
				$('.page').css('padding', '0');
				$('.jvectormap-marker').hide();
				$('.map-resources').hide();
				mapObj.updateSize();
				mapObj.updateSize();
				mapObj.setFocus({
					region: code,
				});	
				event.preventDefault();
				$(this).find("[data-code='" + code + "']").siblings().hide();
				$("[data-code='0']").hide();
				$("#"+code).show("fast");

			},
			onMarkerClick: function(e, code){
				if ( code == 0 ) {
					var mapObj = $('#the-map').vectorMap('get', 'mapObject');
			        $('.programs-map').addClass('region-open');
					$('.program').hide();
					$('#bar .region-name').html('');
					$('#bar .region-name').append(mapObj.getRegionName('US-DC'));
					$('.entry-content').hide();
					$('.page').css('padding', '0');
					$('.jvectormap-marker').hide();
					$('.map-resources').hide();
					mapObj.updateSize();
					mapObj.updateSize();
					mapObj.setFocus({
						region: 'US-DC',
					});	
					e.preventDefault();
					$(this).find("[data-code='US-DC']").siblings().hide();
					$("[data-code='0']").hide();
					$("#US-DC").show("fast");
				}
	    },
			focusOn: {
		       x: 0.5,
		       y: 0.5,
		       scale: 0.1
		     },
	    	series: {
				regions: [{
			        values: programs,
			        min : 1,
			        max: 5,
					backgroundColor: '#505050',
					// scaleColors: myCustomColors,
					scale: {
						'0': $('#programs-map').attr('data-cnone'),
            '1': $('#programs-map').attr('data-cnonconforming'),
            '2': $('#programs-map').attr('data-cdeveloping'),
            '3': $('#programs-map').attr('data-cendorsed'),
            '4': $('#programs-map').attr('data-cmature'),
          },
			        
				}],
				markers: [{
	        attribute: 'image',
	        scale: {
	          'false': '/wp-content/themes/polst-theme/assets/img/asterisk.png'
	        },
	        
	        values: pins.reduce(function(p, c, i){ p[i] = c.status; return p }, {}),
	        
	      }]
			},
		});
		

		$('.js-back-top-map').click(function(){
			$('.programs-map').removeClass('region-open');
			$('.program').hide();
			$('.entry-content').show();
			$('.page').css('padding', '');
			var mapObj = $('#the-map').vectorMap('get', 'mapObject');
			$('.jvectormap-region').show();
			$('.jvectormap-marker').show();
			$('.map-resources').show();
			mapObj.updateSize();
			mapObj.setFocus({
				regions: $regions,
			});
			$('html, body').animate({scrollTop: $('.site-header').height()}, 350);
		});	
	}

	// count status number and display them on badges next to status
	var num_mature = $('.program-4').length,
		num_endorsed = $('.program-3').length + $('.program-4').length,
		num_developing = $('.program-2').length,
		num_nonconforming = $('.program-1').length,
		num_none = $('.program-0').length;

	$('.status .badge.mature').append(num_mature);
	$('.status .badge.endorsed').append(num_endorsed);
	$('.status .badge.developing').append(num_developing);
	$('.status .badge.non-conforming').append(num_nonconforming);
	$('.status .badge.none').append(num_none);

})( jQuery );
</script>
<?php }

//get_template_part( 'template-parts/share-and-print' );
add_action('genesis_after_entry', 'polst_print_and_share');
function polst_print_and_share(){
	get_template_part( 'template-parts/share-and-print' );
}

genesis();
