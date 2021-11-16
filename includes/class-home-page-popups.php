<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.deferousa.com/
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/includes
 * @author     Lisdanay <ldominguez@deferousa.com>
 */
class Home_Page_Popups {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Home_Page_Popups_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'HOME_PAGE_Popups_VERSION' ) ) {
			$this->version = HOME_PAGE_Popups_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'home-page-popups';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Home_Page_Popups_Loader. Orchestrates the hooks of the plugin.
	 * - Home_Page_Popups_i18n. Defines internationalization functionality.
	 * - Home_Page_Popups_Admin. Defines all hooks for the admin area.
	 * - Home_Page_Popups_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-home-page-popups-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-home-page-popups-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-home-page-popups-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-home-page-popups-public.php';

		/**
		 * The class responsible for defining the settings for the updater.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-home-page-popups-options.php';

		$this->loader = new Home_Page_Popups_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Home_Page_Popups_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Home_Page_Popups_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Home_Page_Popups_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_updater = new Home_Page_Popups_Options();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'create_post_type' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_custom_post_status' );
		// $this->loader->add_action( 'init', $plugin_updater, 'page_popups_settings' );

        $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'build_meta_box' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'save_meta_box', 10, 2  );
        $this->loader->add_action( 'pre_get_posts', $plugin_admin, 'get_post' );
        $this->loader->add_action( 'manage_hpp_posts_custom_column', $plugin_admin, 'build_custom_content', 10, 2  );
        $this->loader->add_action( 'in_admin_header', $plugin_admin, 'admin_notice', 100 );
        $this->loader->add_action( 'admin_head', $plugin_admin, 'remove_filter'  );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'custom_config_page' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'custom_categories_page' );

        $this->loader->add_action( 'quick_edit_custom_box', $plugin_admin, 'display_quick_edit_custom' );

        $this->loader->add_action( 'wp_ajax_get_popup', $plugin_admin, 'get_popup', 10, 1  );
        $this->loader->add_action( 'wp_ajax_schedule_popup', $plugin_admin, 'schedule_popup', 10, 1  );
        $this->loader->add_action( 'wp_ajax_remove_popups', $plugin_admin, 'remove_popups', 10, 1  );
        $this->loader->add_action( 'wp_ajax_get_schedules', $plugin_admin, 'get_schedules', 10, 1  );
        $this->loader->add_action( 'wp_ajax_hpp_add_category', $plugin_admin, 'add_category', 10, 1  );
        $this->loader->add_action( 'wp_ajax_get_categories', $plugin_admin, 'get_categories', 10, 1  );
        $this->loader->add_action( 'wp_ajax_remove_category', $plugin_admin, 'remove_category', 10, 1  );



		$this->loader->add_filter( 'template_include', $plugin_admin, 'single_template_include',1 );
		$this->loader->add_filter( 'post_type_link', $plugin_admin, 'get_post_type_slug', 10, 2 );
		$this->loader->add_filter( 'manage_hpp_posts_columns', $plugin_admin, 'add_custom_columns' );
		$this->loader->add_filter( 'manage_edit-hpp_sortable_columns', $plugin_admin, 'build_custom_table_sort' );
        $this->loader->add_filter( 'request', $plugin_admin, 'handle_request' );

        $this->loader->add_filter( 'post_row_actions', $plugin_admin, 'remove_row_actions', 10,1 );
        $this->loader->add_filter( 'post_row_actions', $plugin_admin, 'add_custom_link', 10,2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Home_Page_Popups_Public( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	//	do_action( 'defero_popup' );
		$this->loader->add_action( 'defero_popup', $plugin_public, 'render_popup', 100, 1 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Home_Page_Popups_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
