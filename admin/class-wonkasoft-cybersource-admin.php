<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Cybersource
 * @subpackage Wonkasoft_Cybersource/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wonkasoft_Cybersource
 * @subpackage Wonkasoft_Cybersource/admin
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Wonkasoft_Cybersource_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

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
		 * defined in Wonkasoft_Cybersource_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Cybersource_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wonkasoft-cybersource-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wonkasoft_Cybersource_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Cybersource_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wonkasoft-cybersource-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * This sets up the admin menu for Wonkasoft Instafeed.
	 */
	public function wonkasoft_cybersource_admin_menu() {
		/**
		* This will check for Wonkasoft Tools Menu, if not found it will make it.
		*/
		global $wonkasoft_cybersource_page;
		if ( empty( $GLOBALS['admin_page_hooks']['wonkasoft_menu'] ) ) {
			$wonkasoft_cybersource_page = 'wonkasoft_menu';
			add_menu_page(
				'Wonkasoft',
				'Wonkasoft Tools',
				'manage_options',
				'wonkasoft_menu',
				array( $this, 'wonkasoft_cybersource_settings_display' ),
				WONKASOFT_CYBERSOURCE_IMG_PATH . '/wonka-logo-2.svg',
				100
			);

			add_submenu_page(
				'wonkasoft_menu',
				WONKASOFT_CYBERSOURCE_NAME,
				WONKASOFT_CYBERSOURCE_NAME,
				'manage_options',
				$wonkasoft_cybersource_page,
				array( $this, 'wonkasoft_cybersource_settings_display' )
			);
		} else {

			/**
			* This creates option page in the settings tab of admin menu
			*/
			$wonkasoft_cybersource_page = 'wonkasoft_cybersource_settings_display';
			add_submenu_page(
				'wonkasoft_menu',
				WONKASOFT_CYBERSOURCE_NAME,
				WONKASOFT_CYBERSOURCE_NAME,
				'manage_options',
				$wonkasoft_cybersource_page,
				array( $this, 'wonkasoft_cybersource_settings_display' )
			);
		}

		$this->cybersource_register_settings();

		if ( ! class_exists( 'WooCommerce' ) ) :
			deactivate_plugins( WONKASOFT_CYBERSOURCE_BASENAME );
		endif;
	}

	/**
	 * For the setting to be registered.
	 */
	public function cybersource_register_settings() {
		register_setting( 'cybersource-settings-group', '_v_c_merchant_id' );
		register_setting( 'cybersource-settings-group', '_host' );
		register_setting( 'cybersource-settings-group', '_digest' );
		register_setting( 'cybersource-settings-group', '_signature' );
		register_setting( 'cybersource-settings-group', '_content_type' );
	}

	/**
	 * The function returns the option from the database.
	 *
	 * @return string returns the option.
	 */
	public function get_cybersource_vc_merchant_id() {
		return get_option( '_v_c_merchant_id', null );
	}

	/**
	 * The function echos the option from the database on the screen.
	 */
	public function the_cybersource_vc_merchant_id() {
		echo esc_html( $this->get_cybersource_vc_merchant_id() );
	}

	/**
	 * The function returns the option from the database.
	 *
	 * @return string returns the option.
	 */
	public function get_cybersource_host() {
		return get_option( '_host', null );
	}

	/**
	 * The function echos the option from the database on the screen.
	 */
	public function the_cybersource_host() {
		echo esc_html( $this->get_cybersource_host() );
	}

	/**
	 * The function returns the option from the database.
	 *
	 * @return string returns the option.
	 */
	public function get_cybersource_digest() {
		return get_option( '_digest', null );
	}

	/**
	 * The function echos the option from the database on the screen.
	 */
	public function the_cybersource_digest() {
		echo esc_html( $this->get_cybersource_digest() );
	}

	/**
	 * The function returns the option from the database.
	 *
	 * @return string returns the option.
	 */
	public function get_cybersource_signature() {
		return get_option( '_signature', null );
	}

	/**
	 * The function echos the option from the database on the screen.
	 */
	public function the_cybersource_signature() {
		echo esc_html( $this->get_cybersource_signature() );
	}

	/**
	 * The function returns the option from the database.
	 *
	 * @return string returns the option.
	 */
	public function get_cybersource_content_type() {
		return get_option( '_content_type', null );
	}

	/**
	 * The function echos the option from the database on the screen.
	 */
	public function the_cybersource_content_type() {
		echo esc_html( $this->get_cybersource_content_type() );
	}

	/**
	 * For the setting display page.
	 */
	public function wonkasoft_cybersource_settings_display() {
		include_once plugin_dir_path( __FILE__ ) . '/partials/wonkasoft-cybersource-admin-display.php';
	}

}
