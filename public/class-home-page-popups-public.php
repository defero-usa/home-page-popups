<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.deferousa.com/
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/public
 * @author     Lisdanay <ldominguez@deferousa.com>
 */
class Home_Page_Popups_Public {

    const POST_TYPE = 'hpp';

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Home_Page_Popups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Home_Page_Popups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'hpp', plugin_dir_url( __FILE__ ) . 'css/home-page-popups-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Home_Page_Popups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Home_Page_Popups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'hpp', plugin_dir_url( __FILE__ ) . 'js/home-page-popups-public.js', array( 'jquery' ), $this->version, true );
	}

   /**
    * Display the Link post meta box.
    *
    * @since    1.0.1
    * @access   private
    */
    public function render_popup( $categories )
    {
        if ( !is_array($categories) ) {
            $categories []= $categories;
        }
        $today = date('m/d/Y h:m A');
        $now = strtotime($today);
        $args = array(
            'post_type' => self::POST_TYPE,
            'post_status' => 'active',
            'meta_query'=> array(
                [
                    'key' => 'doNotShowBefore',
                    'compare' => '<=',
                    'value' => $now,
                ],
                [
                'key' => 'doNotShowAfter',
                'compare' => '>=',
                'value' => $now,
                ],
                [
                'key' => 'category',
                'compare' => 'in',
                'value' => $categories,
                ]
            ),
            'posts_per_page' => -1,
            'orderby'   => 'meta_value_num',
            'meta_key'   => 'doNotShowBefore',
            'order' => 'ASC'
        );
        $wp_query = new WP_Query($args);
        $popups =[];
        if ( !empty($wp_query->posts) ) {
            foreach ( $wp_query->posts as $posts ) {
                $custom = get_post_custom($posts->ID);
                $desk_popup_img= null;
                if( $image_attributes = wp_get_attachment_image_src( esc_attr( $custom['desk_popup_img'][0] ), 'full' ) ) {
                    $desk_popup_img = $image_attributes[0];
                }

                $mobile_popup_img= $desk_popup_img;
                if( $image_attributes = wp_get_attachment_image_src( esc_attr( $custom['mobile_popup_img'][0] ), 'full' ) ) {
                    $mobile_popup_img = $image_attributes[0];
                }

                $popups []= [
                    'id'=> $posts->ID,
                    'name'=> $posts->post_title,
                    'desktopFullscreen' => $custom['desktopFullscreen'][0],
                    'popupCookieName' => $custom['popupCookieName'][0],
                    'popupExpiration' => $custom['popupExpiration'][0],
                    'popupRedirectTo' => $custom['popupRedirectTo'][0],
                    'category' => $custom['category'][0],
                    'desk_popup_img'  => $desk_popup_img,
                    'mobile_popup_img'=> $mobile_popup_img
                ];
            }

            require_once( plugin_dir_path( __FILE__ ) . 'partials/home-page-popups-public-display.php' );
        }
    }

}
