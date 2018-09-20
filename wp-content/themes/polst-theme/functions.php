<?php
//* Start the engine
// session_start(); // for using session variables to display pro or consumeer navigation
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Polst Theme' );
define( 'CHILD_THEME_URL', 'http://www.polst.org/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'polst_scripts_and_styles' );

function polst_scripts_and_styles() {

	wp_enqueue_style( 'polst-stylesheet',  get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/assets/js/slick-min.js', array( 'jquery' ), '1.5.9', true );
	// wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/assets/js/owl.carousel-min.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'fitvids', get_stylesheet_directory_uri() . '/assets/js/fitvids-min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'svgxuse', get_stylesheet_directory_uri() . '/assets/js/svgxuse-min.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'tooltip', get_stylesheet_directory_uri() . '/assets/js/tooltip-min.js', array( 'jquery' ), '', true );


	// wp_enqueue_script( 'jvectormap', get_stylesheet_directory_uri() . '/assets/js/jvectormap-2.0.3.min.js', array( 'jquery' ), '', true );
	// wp_enqueue_script( 'jvectormaps', get_stylesheet_directory_uri() . '/assets/js/jquery-jvectormap-data-us-ut-aea-en.js ', array( 'jquery' ), '', true );
	// wp_enqueue_script( 'usa-map', get_stylesheet_directory_uri() . '/assets/js/jquery-jvectormap-us-lcc.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'behaviors', get_stylesheet_directory_uri() . '/assets/js/behaviors-min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


//* Add new featured image sizes
add_image_size( 'home-slider', 1230, 550, TRUE );
add_image_size( 'thumbnail-big', 240, 240, TRUE );

//* Add custom Viewport meta tag for mobile browsers
add_action( 'genesis_meta', 'add_polst_meta' );
function add_polst_meta() {
	echo '<meta name="description" content="The National POLST Paradigm is an approach to end-of-life planning based on conversations between patients, loved ones, and health care professionals designed to ensure that seriously ill or frail patients can choose the treatments they want or do not want and that their wishes are documented and honored."/>';
	echo '<meta name="keywords" content="polst, national, end-of-life, patient, health, care, treatments"/>';
}


//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Remove secondary navigation menu from header
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

//* Includes
include_once( CHILD_DIR . '/includes/meta-boxes.php' );
include_once( CHILD_DIR . '/includes/polst-options-page.php' );
include_once( CHILD_DIR . '/includes/CMB2/cmb2_post_search_field.php' );
include_once( CHILD_DIR . '/includes/blog-post-type.php' );
include_once( CHILD_DIR . '/includes/programs-post-type.php' );
include_once( CHILD_DIR . '/includes/educational-resources-post-type.php' );
include_once( CHILD_DIR . '/includes/slides-post-type.php' );
include_once( CHILD_DIR . '/includes/newsletter-post-type.php' );
include_once( CHILD_DIR . '/includes/widgets.php' );


//* Add Donate button in the main menu
add_filter( 'genesis_nav_items', 'be_follow_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'be_follow_icons', 10, 2 );
function be_follow_icons($menu, $args) {
	$args = (array)$args;
	// if ( 'primary' !== $args['theme_location']   )
	if ( 'primary' !== $args['theme_location'] && 'primary_professionals' !== $args['theme_location']  )
		return $menu;
	
	$cons_buttons = '<li id="donate_link" class="menu-item donate-link"><a href="http://polst.org/about/make-a-gift-to-the-national-polst-paradigm/" class="button blue donate" target="_blank">Donate</a></li>';

	$pro_buttons = '<li id="donate_link" class="menu-item donate-link"><a href="http://polst.org/about/make-a-gift-to-the-national-polst-paradigm/?pro=1" class="button blue donate" target="_blank">Donate</a></li>
	<li id="forum" class="menu-item forum-link"><a href="http://polst.discoursehosting.net/login" class="button blue forum" target="_blank">Forum</a></li>';
	
	
	$isForProfessionals = is_for_professionals();
	if ($isForProfessionals) {
		return $menu . $pro_buttons;
	} else {
		return $menu . $cons_buttons;
	}
}


//* Customize the post info function
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
if ( !is_page() ) {
	$post_info = '[post_date] [post_edit]';
	return $post_info;
}}


//=====================================================================================
//* EXCERPT
//=====================================================================================

//* Modify the Genesis content limit read more link
add_filter('excerpt_more', 'polst_read_more_link');
add_filter( 'get_the_content_more_link', 'polst_read_more_link' );
function polst_read_more_link() {
	$isForProfessionals = is_for_professionals();
	if ($isForProfessionals) {
		return '... <br><a class="more-link button pink outline" href="' . esc_url( add_query_arg( 'pro', '1', get_permalink() ) ) . '">Read More</a>';
	} else {
		return '... <br><a class="more-link button pink outline" href="' . get_permalink() . '">Read More</a>';
	}
	// return '... <br><a class="more-link button pink outline" href="' . get_permalink() . '">Read More</a>';
}
//* Modify the length of post excerpts
add_filter( 'excerpt_length', 'polst_excerpt_length' );
function polst_excerpt_length( $length ) {
	return 30; // pull first N words
}


//=====================================================================================
//* Filter pagination text
//=====================================================================================

add_filter( 'genesis_prev_link_text', 'gt_review_prev_link_text' );
function gt_review_prev_link_text() {
        $prevlink = '&laquo;';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'gt_review_next_link_text' );
function gt_review_next_link_text() {
        $nextlink = '&raquo;';
        return $nextlink;
}

//=====================================================================================
//* Customize the header
//=====================================================================================
add_action('genesis_header_right', 'polst_header');

add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return esc_attr( 'Search...' );
}
add_filter( 'genesis_search_button_text', 'sp_search_button_text' );
function sp_search_button_text( $text ) {
	return esc_attr( '&#xf179;' );
}



function is_for_professionals() {
	// return get_post_meta( get_the_ID(), '_polst_is_for_professionals', true ) ? true : false;
	
	$uri = $_SERVER['QUERY_STRING'];
	$is_pro = $uri ; // for the first parameter
	global $contact_url;
	global $site_url;
	if ( $is_pro == 'pro=1') {
		$contact_url = esc_url( add_query_arg( 'pro', '1', get_permalink(107) ) );
		$site_url = esc_url( add_query_arg( 'pro', '1', home_url() ) );

		return true;
	} 
	else {
		$contact_url = get_permalink(107);
		$site_url = home_url();
		return false;
	}
	// if (  isset($_SESSION['prosesion']) ) {
	// 	esc_url(  add_query_arg( 'pro', '1', get_permalink($post->ID) ) );
	// 	echo ' session on';
	// 	return true;
	// } else {
	// 	return false;
	// }
}

function pro_body_class( $classes ) {
	$isForProfessionals = is_for_professionals();
	if ($isForProfessionals) {
		$classes[] = 'pro-is-active';
	}
	return $classes;
}
add_filter( 'body_class', 'pro_body_class' );

add_action('genesis_site_description', 'postst_switch_button');
function postst_switch_button(){
	$isForProfessionals = is_for_professionals();
	$professionalsHomepageId = polst_get_option( 'polst_professionals_homepage' );
	$buttonText = !$isForProfessionals ? "<span class='clickity-click'>Click here</span> <br> For Professionals" : "<span class='clickity-click'>Click here</span> <br> I'm a Patient / Caregiver";
	// $buttonClass = !$isForProfessionals ? "go-professional" : "go-consumer";
	$buttonUrl = !$isForProfessionals ? get_page_link($professionalsHomepageId) : home_url();
	$uri = $_SERVER['QUERY_STRING'];
	$is_pro = $uri ; // for the first parameter
	global $contact_url;
	if ( !$is_pro == 'pro=1') {
		$buttonUrlQuery = esc_url( add_query_arg( 'pro', '1', $buttonUrl ) );
		
		
	} else {
		$buttonUrlQuery = $buttonUrl;
	}
	?>
	<div class="cons-pros-switch text-center">
		<a class="button pink outline  <?php echo $buttonClass ?>" href="<?php echo $buttonUrlQuery ?>"><?php echo $buttonText ?></a>
	</div>
	<?php
}

function polst_header() {
	// $isForProfessionals = is_for_professionals();
	// $professionalsHomepageId = polst_get_option( 'polst_professionals_homepage' );
	// $buttonText = !$isForProfessionals ? "For Professionals" : "I'm a patient";
	// // $buttonClass = !$isForProfessionals ? "go-professional" : "go-consumer";
	// $buttonUrl = !$isForProfessionals ? get_page_link($professionalsHomepageId) : home_url();
	// $uri = $_SERVER['QUERY_STRING'];
	// $is_pro = $uri ; // for the first parameter
	global $contact_url;
	// if ( !$is_pro == 'pro=1') {
	// 	$buttonUrlQuery = esc_url( add_query_arg( 'pro', '1', $buttonUrl ) );
	// } else {
	// 	$buttonUrlQuery = $buttonUrl;
	// }
	?>
	<div class="header-right-top clearfix">
		<a class=" button pink outline" href="<?php echo $contact_url; ?>">Contact Us</a>
	</div>

	<div class="header-right-bottom">

		<?php get_search_form(); ?>

		<ul class="social-links">
			<li>
				<a href="<?php echo polst_get_option( 'polst_twitter_link' ); ?>" target="_blank">
	                <svg class="icon icon-twitter">
	                	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-twitter"></use>
	                </svg>
				</a>
			</li>
			<li>
				<a href="<?php echo polst_get_option( 'polst_facebook_link' ); ?>" target="_blank">
					<svg class="icon icon-facebook">
	                	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-facebook"></use>
	                </svg>
				</a>
			</li>
			<li>
				<a href="<?php echo polst_get_option( 'polst_youtube_link' ); ?>" target="_blank">
					<svg class="icon icon-youtube">
	                	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-youtube"></use>
	                </svg>
				</a>
			</li>
		</ul>
	</div>
	<?php
}

add_filter( 'genesis_seo_title', 'polst_header_title_query', 10, 3 );
function polst_header_title_query( $title, $inside, $wrap ) {
	global $site_url;
    $inside = sprintf( '<a href="%s" title="%s">%s</a>', home_url() , esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );
    return sprintf( '<%1$s class="site-title">%2$s</%1$s>', $wrap, $inside );
}

// Add logo that would be displayed only when priting page
add_action('genesis_header', 'polst_printable_logo');

function polst_printable_logo() { ?>
	<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png" class="logo-printable">
<?php
}

//=====================================================================================
//* Customize the entire footer & add newsletter modal
//=====================================================================================
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'polst_footer' );

function polst_footer() {
	$post_address = polst_get_option( 'polst_contact_address' );
	$post_city = polst_get_option( 'polst_contact_city' );
	?>
	<div class="sup-footer row">
		<div class="footer-widget contact text-center">
			<h3>Contact Us</h3>
			<ul class="phones"> <!-- <ul class="address"> -->
				<?php if ( !empty($post_address) ) { ?>
					<li><?php echo polst_get_option( 'polst_contact_address' ); ?></li>	
				<?php } ?>
				<?php if ( !empty($post_city) ) { ?>
					<li><?php echo polst_get_option( 'polst_contact_city' ); ?></li>
				<?php } ?>
			</ul>
			<ul class="address"> <!-- <ul class="phones"> -->
				<li></li>
				<?php $phones = polst_get_option( 'polst_contact_phone' );
				// var_dump($phones);
				if ($phones) {	
					foreach ($phones as $phone => $value) {
						echo '<li>'.$value.'</li>';
					}
				}
				?>
			</ul>
			

			<div class="email-us">
				<?php
					$polst_email_address = polst_get_option( 'polst_contact_email' );
					$encodedEmail = encode_email_address( $polst_email_address );
				?>
				<b>Comments? Questions? 
				<?php printf('<a href="mailto:%s">%s</a>', $encodedEmail, 'Email us.'); ?>
					
				</b>
			</div>

		</div><!-- /.contact -->
		 <div class="footer-widget newsletter">
			<h3>Newsletter</h3>
			<p><?php echo polst_get_option( 'polst_newsletter_text' ); ?></p>
			<a href="#modal-newsletter" class="button pink js-open-modal" data-target="#modal-newsletter">Sign Up</a>
			<div id="modal-newsletter" class="js-modal-handler modal modal-newsletter">
				<div class="modal-dialog">

					<div class="modal-content text-center">
						<span class="close-modal js-close-modal">
							 <svg class="icon icon-close">
			                	<use xlink:href="<?php echo get_stylesheet_directory_uri() ?>/assets/svg/symbol-defs.svg#icon-close"></use>
			                </svg>
						</span>
						<h3 class="h2"><?php echo polst_get_option( 'polst_newsletter_modal_title' ); ?></h3>
						<p><?php echo polst_get_option( 'polst_newsletter_modal_text_top' ); ?></p>
						<div class="row">
							<div class="form-wrapper">
								<?php // echo do_shortcode('[contact-form-7 id="3190" title="Newsletter"]'); ?>
								<form action="//polst.us12.list-manage.com/subscribe/post?u=316b810ca22a5c8fb3210e871&amp;id=6063fa832f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" validate>
								    <div id="mc_embed_signup_scroll">
								<div class="mc-field-group">
								    <label for="mce-EMAIL">Email Address </label>
								    <input type="email" value="" name="EMAIL" class="required email" required id="mce-EMAIL">
								</div>
								<div class="mc-field-group">
								    <label for="mce-FNAME">First Name </label>
								    <input type="text" value="" name="FNAME" class="required"  required="required" id="mce-FNAME">
								</div>
								<div class="mc-field-group">
								    <label for="mce-LNAME">Last Name </label>
								    <input type="text" value="" name="LNAME" class="required"  required id="mce-LNAME">
								</div>
								    <div id="mce-responses" class="clear">
								        <div class="response" id="mce-error-response" style="display:none"></div>
								        <div class="response" id="mce-success-response" style="display:none"></div>
								    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_316b810ca22a5c8fb3210e871_6063fa832f" tabindex="-1" value=""></div>
								    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
								    </div>
								</form>
							</div>
						</div>
						<div class="row">
							<p class="h3">Comments or Questions? <a href="mailto:<?php echo encode_email_address('info@polst.org') ?> ">Email Us</a></p>
							<p class="text-xs"><?php echo polst_get_option( 'polst_newsletter_modal_text_bottom' ); ?></p>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="footer-widget footer-nav">
			<h3>Quick Links</h3>
			<?php add_action( 'footer_links', 'genesis_do_subnav' ); ?>
			<?php do_action('footer_links') ?>

		</div><!-- /.footer-nav -->
	</div><!-- /.site-footer -->
	<?php
}

add_action( 'genesis_after_footer', 'polst_subfooter' );
function polst_subfooter() {
	?>
	<div class="sub-footer">
		<div class="wrap">
			<div class="row">
				<p class="half text-left"><?php echo get_bloginfo('description'); ?></p>
				
				<p class="half text-right">&copy;<?php echo date('Y'); ?> National POLST Paradigm, a project of <a href="http://www.tides.org/" target="_blank">Tides Center</a><br /><a href="http://polst.org/privacy/">Privacy</a> & <a href="http://polst.org/terms/">Terms</a></p>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.subfooter -->
	<?php
}

//=====================================================================================
//* Add new menu location - For Professionals
//=====================================================================================
remove_theme_support ( 'genesis-menus' );

add_theme_support( 'genesis-menus', array(
	'primary'   => __( 'Primary Navigation', 'genesis' ),
	'primary_professionals'   => __( 'Primary Navigation for Pros', 'genesis' ),
	'secondary' => __( 'Secondary Navigation', 'genesis' ),
) );

//=====================================================================================
//* Change Primary Nav for Professionals and Consumers
// http://www.billerickson.net/customizing-menu-arguments/
//=====================================================================================
function polst_primary_meny_args( $args ) {
	if ($args['theme_location'] === "secondary") {
		return $args;
	}
	$args['theme_location'] = is_for_professionals() ? 'primary_professionals' : 'primary';

  	return $args;
}
add_filter( 'wp_nav_menu_args', 'polst_primary_meny_args' );



//=====================================================================================
//* Check if pro menu, if so add query arg
//=====================================================================================
function polst_nav_items( $items, $menu, $args ) {
    if( is_admin() )
        return $items;

	    foreach( $items as $item ) {
            $item->url = esc_url( add_query_arg( 'pro', '1', $item->url ) );
	    }
	    return $items;
}
$uri = $_SERVER['QUERY_STRING'];
$is_pro = $uri ; // for the first parameter
if ( $is_pro == 'pro=1') {
	add_filter( 'wp_get_nav_menu_items','polst_nav_items', 11, 3 );
}


//=====================================================================================
//* Update logo URL for professionals
//=====================================================================================
function polst_logo_url( $title, $inside, $wrap ) {
	$professionalsHomepageId = polst_get_option( 'polst_professionals_homepage' );
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', esc_url( add_query_arg( 'pro', '1', get_page_link($professionalsHomepageId) ) ), esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );
	$title = sprintf( '<%s id="title" class="site-title">%s</%s>', $wrap, $inside, $wrap );
	return $title;
}
if ( $is_pro == 'pro=1') {
	add_filter( 'genesis_seo_title', 'polst_logo_url', 10, 3 );
}

//=====================================================================================
//* Encode an email address to display on your website
//=====================================================================================
function encode_email_address( $email ) {
     $output = '';
     for ($i = 0; $i < strlen($email); $i++)
     {
          $output .= '&#'.ord($email[$i]).';';
     }
     return $output;
}

function encode_email($e) {
	for ($i = 0; $i < strlen($e); $i++) { $output .= '&#'.ord($e[$i]).';'; }
	return $output;
}


//=====================================================================================
//* Sets "Open link in a new window/tab" to checked by default
//=====================================================================================
function polst_check_blank_external_links() {
	?>
	<script type="text/javascript">
	jQuery( function() {
		jQuery( 'input#wp-link-target' ).prop( 'checked', true );
	} );
	</script>    
    <?php
}
add_action( 'after_wp_tiny_mce', 'polst_check_blank_external_links' );



//=====================================================================================
//* Shortcodes
//=====================================================================================

// encode email shortcode
function encode_email_shortcode( $atts, $content = null ) {
	return '<a href="mailto:'.encode_email_address( $content ).'" >' . encode_email_address( $content ) . '</a>';
}
add_shortcode( 'email', 'encode_email_shortcode' );

// pro/cons links shortcode - keeps pro or consumer side for WP editor links
function pro_cons_links_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'url' => 'linker',
	), $atts );
	$uri = $_SERVER['QUERY_STRING'];
	$is_pro = $uri ; // for the first parameter
	if ( $is_pro == 'pro=1') {
		return '<a href="'. esc_attr($a['url']) .'?pro=1">' . $content . '</a>';
	} else {
		return '<a href="'. esc_attr($a['url']) .'">' . $content . '</a>';
	}
}
add_shortcode( 'link', 'pro_cons_links_shortcode' );

//=====================================================================================
//* Add ancestor class to single posts
//=====================================================================================
// function add_single_post_ancestor_nav_class($classes, $item){
//     global $post;
//     $is_ancestor = false;
//     if ( is_single() ) {
//         if ( $post->post_type != 'post' ) {
//         	// Checks if the custom-post-type label name matches the title of the nav-page-item
//         	$post_type_obj = get_post_type_object($post->post_type);
//         	$post_type_labels = $post_type_obj->labels;
//         	$post_type_name = $post_type_labels->name;
//         	if( $item->title == $post_type_name ) { $is_ancestor = true; }
//         }
//         else {
//         	// Checks if one of the single-post categories matches the title of the nav-page-item
//         	$categories = get_categories();
//         	foreach ( $categories as $category ) {
//         		if ( in_category($category->name) && $item->title == $category->name ) { $is_ancestor = true; }
//         	}
//         }
//         if( $is_ancestor ){ $classes[] = 'current-menu-ancestor'; }
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class' , 'add_single_post_ancestor_nav_class' , 10 , 2);

// Developer Tools
// require_once CHILD_DIR . '/library/developer-tools.php';		// DO NOT USE THESE ON A LIVE SITE

// Bones
// require_once CHILD_DIR . '/library/bones.php';
//



 



