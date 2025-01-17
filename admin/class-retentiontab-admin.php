<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://retentiontab.com
 * @since      1.0.0
 *
 * @package    Retentiontab
 * @subpackage Retentiontab/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Retentiontab
 * @subpackage Retentiontab/admin
 * @author     RetentionTab <support@retentiontab.com>
 */
class Retentiontab_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'retentiontab';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Retentiontab_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Retentiontab_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/retentiontab-admin.css', array(), $this->version, 'all' );

	}

	public function retentiontab_general_cb() {
			echo '<p>' . __( 'Please change the settings accordingly.', '' ) . '</p>';
	}

	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'retentiontab' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			$this->option_name . '_campaign',
			__( 'RetentionTab Campaign', 'retentiontab' ),
			array( $this, $this->option_name . '_campaign_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_campaign' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_campaign');
	}

	public function retentiontab_campaign_cb() {
		$campaign = get_option( $this->option_name . '_campaign' );
		echo '<input type="text" name="' . $this->option_name . '_campaign' . '" id="' . $this->option_name . '_campaign' . '" value="' . $campaign . '"> ' . __( '', 'retentiontab' );
	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'RetentionTab Settings', 'retentiontab' ),
			__( 'RetentionTab', 'retentiontab' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
		function show_setting_missing() {
		    ?>
		    <div class="update-nag notice">
		        <p><?php _e( 'Please specify a RetentionTab campaign', 'retentiontab' ); ?> </p>
		    </div>
		    <?php
		}
		$campaign = get_option( $this->option_name . '_campaign' );

		if (!isset($campaign) || empty($campaign)) {
			add_action( 'admin_notices', 'show_setting_missing' );
		}

	
	}


	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/retentiontab-admin-display.php';
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Retentiontab_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Retentiontab_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/retentiontab-admin.js', array( 'jquery' ), $this->version, false );

	}

}
