<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Polst_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'polst_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'polst_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'Polst Info', 'polst' );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$polst_options = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		$polst_options->add_field( array(
			'name' => __( 'Location info', 'polst' ),
			// 'desc' => __( 'field description (optional)', 'polst' ),
			'id'   => 'polst_contact_title',
			'type' => 'title',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Address', 'polst' ),
			'desc' => __( 'e.g. 1331 Garden Highway, Suite 100', 'polst' ),
			'id'   => 'polst_contact_address',
			'type' => 'text',
			// 'default' => '1331 Garden Highway, Suite 100',
		) );

		$polst_options->add_field( array(
			'name' => __( 'City, State, ZIP', 'polst' ),
			'desc' => __( 'e.g. Sacramento, CA 95833', 'polst' ),
			'id'   => 'polst_contact_city',
			'type' => 'text',
			// 'default' => 'Sacramento, CA 95833',
		) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'State', 'polst' ),
		// 	'desc' => __( 'e.g. Serbia', 'polst' ),
		// 	'id'   => 'polst_contact_state',
		// 	'type' => 'text',
		// 	'default' => 'Serbia',
		// ) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'Emails', 'polst' ),
		// 	// 'desc' => __( 'field description (optional)', 'polst' ),
		// 	'id'   => 'polst_email_title',
		// 	'type' => 'title',
		// 	// 'default' => 'Default Text',
		// ) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'Emails', 'polst' ),
		// 	'id'   => 'polst_contact_email',
		// 	'type' => 'text',
		// 	'repeatable' => true,
		// ) );

		$polst_options->add_field( array(
			'name' => __( 'Telephone(s)', 'polst' ),
			// 'desc' => __( 'field description (optional)', 'polst' ),
			'id'   => 'polst_tel_title',
			'type' => 'title',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Phone(s)', 'polst' ),
			'id'   => 'polst_contact_phone',
			'type' => 'text',
			'repeatable' => true,
			'default' => '(503) 494-4463',
		) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'Fax(es)', 'polst' ),
		// 	// 'desc' => __( 'field description (optional)', 'polst' ),
		// 	'id'   => 'polst_fax_title',
		// 	'type' => 'title',
		// 	// 'default' => 'Default Text',
		// ) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'Fax(es)', 'polst' ),
		// 	'id'   => 'polst_contact_fax',
		// 	'type' => 'text',
		// 	'repeatable' => true,
		// 	'default' => '(888) 789-9475',
		// ) );

		$polst_options->add_field( array(
			'name' => __( 'Email', 'polst' ),
			// 'desc' => __( 'field description (optional)', 'polst' ),
			'id'   => 'polst_email_title',
			'type' => 'title',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Info Email', 'polst' ),
			'desc' => 'default info email... e.g. info@polst.org',
			'id'   => 'polst_contact_email',
			'type' => 'text',
			'default' => 'info@polst.org',
			// 'repeatable' => true,
		) );

		$polst_options->add_field( array(
			'name' => __( 'Newsletter info', 'polst' ),
			// 'desc' => __( 'field description (optional)', 'polst' ),
			'id'   => 'polst_newsletter_title',
			'type' => 'title',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Newsletter footer text', 'polst' ),
			'desc' => __( 'Text displayed in footer sign up section. e.g. Sign Up For News From The National POLST Paradigm', 'polst' ),
			'id'   => 'polst_newsletter_text',
			'type' => 'textarea_small',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Newsletter modal title', 'polst' ),
			'desc' => __( 'Title displayed in sign up modal window', 'polst' ),
			'id'   => 'polst_newsletter_modal_title',
			'type' => 'text',
			'default' => 'Sign up to receive National POLST eNewsletters!',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Newsletter modal text', 'polst' ),
			'desc' => __( 'Text displayed in sign up modal window', 'polst' ),
			'id'   => 'polst_newsletter_modal_text_top',
			'type' => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 8,
				'media_buttons' => false,
				'teeny' => true
			),
		) );

		$polst_options->add_field( array(
			'name' => __( 'Newsletter modal small copy', 'polst' ),
			'desc' => __( 'Text displayed at the bottom of the sign up modal window', 'polst' ),
			'id'   => 'polst_newsletter_modal_text_bottom',
			'type' => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 8,
				'media_buttons' => false,
				'teeny' => true
			),
		) );

		// $polst_options->add_field( array(
		// 	'name' => __( 'Newsletter link', 'polst' ),
		// 	// 'desc' => __( 'e.g. Sign Up For News From The National POLST Paradigm', 'polst' ),
		// 	'id'   => 'polst_newsletter_link',
		// 	'type' => 'text',
		// 	// 'default' => 'Default Text',
		// ) );

		$polst_options->add_field( array(
			'name' => __( 'Social Links', 'polst' ),
			// 'desc' => __( 'field description (optional)', 'polst' ),
			'id'   => 'polst_social_title',
			'type' => 'title',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Facebook', 'polst' ),
			// 'desc' => __( 'e.g. Sign Up For News From The National POLST Paradigm', 'polst' ),
			'id'   => 'polst_facebook_link',
			'type' => 'text',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'Twitter', 'polst' ),
			// 'desc' => __( 'e.g. Sign Up For News From The National POLST Paradigm', 'polst' ),
			'id'   => 'polst_twitter_link',
			'type' => 'text',
			// 'default' => 'Default Text',
		) );

		$polst_options->add_field( array(
			'name' => __( 'YouTube', 'polst' ),
			// 'desc' => __( 'e.g. Sign Up For News From The National POLST Paradigm', 'polst' ),
			'id'   => 'polst_youtube_link',
			'type' => 'text',
			// 'default' => 'Default Text',
		) );

		// Professionals mode custom fields
		//=================================
		$polst_options->add_field( array(
			'name' => __( 'Professionals "mode"', 'polst' ),
			'id'   => 'polst_professionals_mode_title',
			'type' => 'title'
		) );

		$polst_options->add_field( array(
			'name'    => __( 'Professionals "mode" homepage', 'polst' ),
			'desc'    => __( 'Choose page that will be added as a link to "For Professionals" button in the site header', 'polst' ),
			'id'      => 'polst_professionals_homepage',
		    'type'    => 'select',
		    'options_cb' => 'polst_pages_options'
		) );
	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'polst' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the polst_Admin object
 * @since  0.1.0
 * @return polst_Admin object
 */
function polst_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new Polst_Admin();
		$object->hooks();
	}

	return $object;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function polst_get_option( $key = '' ) {
	return cmb2_get_option( polst_admin()->key, $key );
}

/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function polst_get_pages_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => 10,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}

/**
 * Gets all pages and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function polst_pages_options() {
    return polst_get_pages_options( array( 'post_type' => 'page', 'numberposts' => -1 ) );
}

// Get it started
polst_admin();
