<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.deferousa.com/
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/admin
 * @author     Lisdanay <ldominguez@deferousa.com>
 */
class Home_Page_Popups_Admin {

    const KEY = 'popup-action';
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version )
    {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
    {

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

		wp_enqueue_style( 'home-page-popups', plugin_dir_url( __FILE__ ) . 'css/home-page-popups-admin.css', array(), $this->version, 'all' );

        if ( in_array( $_REQUEST['page'], ['schedules', 'categories'] ) ) {
            wp_enqueue_style( 'hpp-schedules', plugin_dir_url( __FILE__ ) . 'css/home-page-popups-admin-schedule.css', array(), '', 'all' );
            wp_enqueue_style( 'daterangepicker', plugin_dir_url( __FILE__ ) . 'css/daterangepicker.css', array(), '', 'all' );
        }
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
    {

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

		global $post;
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            if ( self::POST_TYPE === $post->post_type ) {
                wp_enqueue_script( 'home-page-popups-validations', plugin_dir_url( __FILE__ ) . 'js/home-page-popups-admin-validations.js', 'jquery', '', true );
            }
        }
        if (  $_REQUEST['page'] == 'schedules'  ) {
            wp_enqueue_script( 'moment.min', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( 'daterangepicker.min', plugin_dir_url( __FILE__ ) . 'js/daterangepicker.min.js', array( 'jquery' ), $this->version, false );
            wp_enqueue_script( 'home-page-popups', plugin_dir_url( __FILE__ ) . 'js/home-page-popups-admin.js', array( 'jquery' ), $this->version, false );
        }
        if ( $_REQUEST['page'] == 'categories' ) {
             wp_enqueue_script( 'home-page-popups-category', plugin_dir_url( __FILE__ ) . 'js/home-page-popups-admin-category.js', array( 'jquery' ), $this->version, false );
        }
	}


/**
     * Allow to register our own Custom Post Types.
     *
     * Post Type:
     *  - home-page-popups
     *
     * @since    1.0.0
     * @access   private
     */
    public function create_post_type()
    {
        $labels = [
            'name'                  => _x( 'Home Page Popups', 'Post Type General Name', self::POST_TYPE ),
            'singular_name'         => _x( 'Home Page Popups', 'Post Type Singular Name', self::POST_TYPE ),
            'menu_name'             => __( 'Home Page Popup', self::POST_TYPE ),
            'name_admin_bar'        => __( 'Home Page Popup', self::POST_TYPE ),
            'archives'              => __( 'Home Page Popup Archives', self::POST_TYPE ),
            'attributes'            => __( 'Home Page Popup Attributes', self::POST_TYPE ),
            'parent_item_colon'     => __( 'Parent Home Page Popup:', self::POST_TYPE ),
            'all_items'             => __( 'Popups', self::POST_TYPE ),
            'add_new_item'          => __( 'Add New Popup', self::POST_TYPE ),
            'add_new'               => __( 'Add Popup', self::POST_TYPE ),
            'new_item'              => __( 'New Popup', self::POST_TYPE ),
            'edit_item'             => __( 'Edit Popup', self::POST_TYPE ),
            'update_item'           => __( 'Update Popup', self::POST_TYPE ),
            'view_item'             => __( 'View Popup', self::POST_TYPE ),
            'view_items'            => __( 'View Popups', self::POST_TYPE ),
            'search_items'          => __( 'Search Popup', self::POST_TYPE ),
            'not_found'             => __( 'Not found', self::POST_TYPE ),
            'not_found_in_trash'    => __( 'Not found in Trash', self::POST_TYPE ),
            'insert_into_item'      => __( 'Insert into Home Page Popup', self::POST_TYPE ),
            'uploaded_to_this_item' => __( 'Uploaded to this Home Page Popup', self::POST_TYPE ),
            'items_list'            => __( 'Home Page Popup list', self::POST_TYPE ),
            'items_list_navigation' => __( 'Home Page Popups list navigation', self::POST_TYPE ),
            'filter_items_list'     => __( 'Filter Home Page Popups list', self::POST_TYPE ),
        ];
        $args = [
            'label'                 => __( 'Home Page Popup', self::POST_TYPE ),
            'description'           => __( 'Home Page Popup', self::POST_TYPE ),
            'labels'                => $labels,
            'supports'              => [ 'custom-fields' ],
            'taxonomies'            => ['title','product_type' ],
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-megaphone',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => [
                'slug'                  => self::POST_TYPE,
                'with_front'            => false,
                'pages'                 => false,
                'feeds'                 => false,
            ],
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        ];
        register_post_type( self::POST_TYPE, $args );
    }

    /**
     * Provide the custom post type template path.
     *
     *  - Verify if is a correct post type.
     *  - Checks if the file exists in the theme first,
     * otherwise serve the file from the plugin
     *
     * @since    1.0.0
     * @access   private
     *
     * @param $template_path
     * @return string
     */
    public function single_template_include( $template_path )
    {
        if ( get_post_type() == self::POST_TYPE && is_single() ) {
            if ( $theme_file = locate_template( array ( 'single-product.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-product.php';
            }
        }
        return $template_path;
    }


    /**
     * Return the custom post type slug.
     *
     * Check if the post is an home-page-popups type and if is publish.
     * Otherwise return the post type concat with the post link.
     *
     * @since    1.0.0
     * @access   private
     *
     * @param $post_link
     * @param $post
     * @param $leavename
     * @return string
     */
    public function get_post_type_slug( $post_link, $post )
    {
        if (
            self::POST_TYPE != $post->post_type ||
            'publish' != $post->post_status
        ) {
            return $post_link;
        }

        return str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }

    /**
     * Create meta boxes to be displayed on the post editor screen.
     *
     * @since    1.0.0
     * @access   private
     */
    public function build_meta_box()
    {
        add_meta_box(
            'popupName',
            esc_html__( 'Popup', self::POST_TYPE),
            [ $this, 'display_meta_box' ],
            self::POST_TYPE, // Admin page (or post type)
            'advanced',
            'default'
        );
    }


    /**
     * Provide and lets us modify a WP_Query.
     *
     *  - Verify if is the main query.
     *  - Verify our very specific rewrite rule match.
     *  - 'name' will be set if post permalinks are just post_name, otherwise the page rule will match.
     *
     * @since    1.0.0
     * @access   private
     *
     * @param $query
     */
    public function get_post( $query )
    {
        if ( ! $query->is_main_query() ) {
            return false;
        }
        if ( self::POST_TYPE != $query->query['post_type'] ) {
            return false;
        }


        if ( isset( $query->query_vars['s'] ) && ! empty( $query->query_vars['s'] ) ) {
            $search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_STRING) ? : '';

            $query->set('meta_query', [
                [
                    'key' => 'popupName',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'popupCookieName',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'desktopFullscreen',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'popupExpiration',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'category',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'popupRedirectTo',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'desk_popup_img',
                    'value' => $search_term,
                    'compare' => '='
                ],
                [
                    'key' => 'mobile_popup_img',
                    'value' => $search_term,
                    'compare' => '='
                ]
            ]);

            add_filter( 'get_meta_sql', function( $sql )
            {
                global $wpdb;

                static $nr = 0;
                if( 0 != $nr++ ) {
                    return $sql;
                }

                $sql['where'] = mb_eregi_replace( '^ AND', ' OR', $sql['where']);

                return $sql;
            });

            return $query;
        }
    }


    /**
     *Allow to  remove teh Date filters from post type page
     *
     * @since    1.0.0
     * @access   public
     */
    public function remove_filter()
    {
        if ( self::POST_TYPE ==  get_current_screen()->post_type ){
            add_filter('months_dropdown_results', '__return_empty_array');
        }
    }

    /**
     * Remove all notice from post type page to allow keep the page clean.
     *
     * @since    1.0.0
     * @access   private
     */
    public function admin_notice()
    {
        global $pagenow;
        if ($pagenow != 'edit.php') {
            return;
        }
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
    }

    public function custom_config_page(){
        add_submenu_page(
            'edit.php?post_type='. self::POST_TYPE,
            'Schedules',
            'Schedules',
            'manage_options',
            'schedules',
            [ $this, 'schedule_page' ]
        );
    }

    public function custom_categories_page(){
        add_submenu_page(
            'edit.php?post_type='. self::POST_TYPE,
            'Categories',
            'Categories',
            'manage_options',
            'categories',
            [ $this, 'categories_page' ]
        );
    }

    public function schedule_page()
    {
        require_once( plugin_dir_path( __FILE__ ) . 'partials/home-page-popups-admin-schedule.php' );
    }

    public function categories_page()
    {
        require_once( plugin_dir_path( __FILE__ ) . 'partials/home-page-popups-admin-category.php' );
    }

    /**
     * Allow Add a custom status to te post
     *  - New post_type:
     *   1 subscribed
     *   2 unsubscribed
     *
     * @since    1.0.0
     * @access   public
     */
    public function register_custom_post_status()
    {
        register_post_status( 'active',
            [
                'label'                     => _x( 'Active', 'post' ),
                'public'                    => true,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Active <span class="count">(%s)</span>', 'Active <span class="count">(%s)</span>' ),
            ]
        );

        register_post_status( 'inactive',
            [
                'label'                     => _x( 'Inactive', 'post' ),
                'public'                    => true,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Inactive <span class="count">(%s)</span>', 'Inactive <span class="count">(%s)</span>' ),
            ]
        );

        register_post_status( 'schedule',
            [
                'label'                     => _x( 'Schedule', 'post' ),
                'public'                    => true,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Schedule <span class="count">(%s)</span>', 'Schedules <span class="count">(%s)</span>' ),
            ]
        );
    }

    /**
     * Save the meta box's post metadata.
     *
     *  - Verify the mata ID and if is empty or an popup format.
     *  - Verify the nonce before proceeding.
     *  - Check if the current user has permission to edit the post.
     *  - Get the meta value of the custom field key.
     *  - If a new meta value was added and there was no previous value, add it.
     *  - If the new meta value does not match the old value, update it.
     *  - If there is no new meta value but an old value exists, delete it.
     *
     * @since    1.0.0
     * @access   public
     */
    public function save_meta_box( $post_id, $post )
    {
        //die
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
            return $post_id;

        if ( self::POST_TYPE == $post->post_type ) {
            if ( ! isset( $_POST[ 'popupName_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'popupName_nonce' ], 'popupName' ) ) {
                return $post_id;
            }

            foreach (
                [
                    'popupName',
                    'popupExpiration',
                    'category',
                    'popupRedirectTo',
                ] as $meta
            ) {
                if ( isset( $_POST[ $meta ]) ) {
                    $this->save_meta( $meta, $_POST[ $meta ], $post_id );
                }
            }
            foreach (
                [
                    'desk_popup_img',
                    'mobile_popup_img',
                ] as $meta
            ) {
                delete_post_meta( $post_id, $meta );
                if ( isset( $_POST[ $meta ]) ) {
                    add_post_meta( $post_id, $meta,  $_POST[ $meta ], true );
                }
            }

            if ( !empty( $_POST[ 'popupCookieName' ]) ) {
                $popupCookieName = $_POST[ 'popupCookieName' ];
                $args = array(
                    'post_type' => self::POST_TYPE,
                    'post_status' => 'active',
                    'meta_query'=> array(
                        array(
                            'key' => 'popupCookieName',
                            'compare' => '=',
                            'value' => $popupCookieName,
                        )
                    ),
                    'posts_per_page' => 1,
                    'post__not_in' => [$post_id],
                    'order' => 'DESC'
                );
                $wp_query = new WP_Query($args);
                if ( !empty($wp_query->posts) ) {
                    $popupCookieName .= strtotime('now');
                }
                $this->save_meta(  'popupCookieName', $popupCookieName, $post_id );
            }

            if ( isset( $_POST[ 'active' ]) ) {
                $this->save_meta(  'active', (int)("on" == $_POST[ 'active' ]), $post_id );
                $status = 'active';
            } else {
                $this->save_meta (  'active', 0, $post_id );
                $status = 'inactive';
            }
            if ( isset( $_POST[ 'desktopFullscreen' ]) ) {
                $this->save_meta(  'desktopFullscreen', (int)("on" == $_POST[ 'desktopFullscreen' ]), $post_id );
            } else {
                $this->save_meta (  'desktopFullscreen', 0, $post_id );
            }

            global $wpdb;
            $wpdb->update(
                $wpdb->posts,
                [
                    'post_title'  => $_POST[ 'popupName' ],
                    'post_status' => $status
                ],
                [ 'ID'=> $post_id ]
            );
        }
    }

    private function save_meta( $meta, $value, $post_id )
    {
        $meta_value = get_post_meta( $post_id, $meta, true );
        if ( $meta_value == '' ) {
            add_post_meta( $post_id, $meta, $value, true );
        }
        elseif ( $_POST[ $meta ] != $meta_value ) {
            update_post_meta($post_id, $meta, $value);
        }
    }

    /**
     * Allow to add custom column displayed info in the post type list table.
     *
     * @since    1.0.0
     * @access   public
     *
     * @param $column_name
     * @param $post_id
     */
    public function build_custom_content( $column_name, $post_id )
    {
        switch ( $column_name ) {
            case 'active':
                echo ucwords( ( get_post($post_id) )->post_status );
                break;
            case 'desktopFullscreen':
                echo get_post_meta( $post_id, "desktopFullscreen", true );
                break;
            case 'popupName':
                echo ( get_post($post_id) )->post_title;
                break;
            case 'popupCookieName':
                echo get_post_meta( $post_id, "popupCookieName", true );
                break;
            case 'popupExpiration':
                echo get_post_meta( $post_id, "popupExpiration", true );
                break;
            case 'category':
                echo get_post_meta( $post_id, "category", true );
                break;
            case 'popupRedirectTo':
                $popupRedirectTo = get_post_meta( $post_id, "popupRedirectTo", true );
                if ( $popupRedirectTo ) {
                    echo '<a target="_blank" href="'.$popupRedirectTo.'">'.$popupRedirectTo.'</a>';
                } else {
                    echo '';
                }
                break;
            case 'schedule':
                $start = get_post_meta( $post_id, "doNotShowBefore", true );
                $end = get_post_meta( $post_id, "doNotShowAfter", true );
                if ( $start ) {
                    $schedule = date('m/d/Y h:m A', $start);
                    if ( $end ) {
                        $schedule .= ' - ' . date('m/d/Y h:m A', $end);
                    }
                } else {
                    $schedule = '<a href="/wp-admin/edit.php?post_type=' . self::POST_TYPE . '&page=schedules&id='. $post_id .'">Add Schedule</a>';
                }
                echo $schedule;
                break;
            default:
                break;
        }
    }

    public function add_custom_link( $actions, WP_Post $post ) {
        if ( $post->post_type != self::POST_TYPE ) {
            return $actions;
        }

        $start = get_post_meta( $post->ID, "doNotShowBefore", true );
        if ( $start ) {
            $actions['edit-schedule'] = '<a href="/wp-admin/edit.php?post_type=' . self::POST_TYPE . '&page=schedules&id='. $post->ID .'">Edit Schedule</a>';
        }
        return $actions;
    }

    public function remove_row_actions( $actions )
    {
        if( get_post_type() === self::POST_TYPE ) {
            unset( $actions['view'] );
            unset( $actions['inline hide-if-no-js'] );
        }

        return $actions;
    }

    /**
     * Allow to add custom columns to displayed in the Posts list table.
     *  - Columns:
     *      - cb
     *      - popupName
     *      - popupCookieName
     *      - popupExpiration
     *      - category
     *      - active
     *      - schedule
     *      - desktopFullscreen
     *      - popupRedirectTo
     *      - date (wp original)
     *
     * @since    1.0.0
     * @access   public
     *
     * @param $columns
     * @return array
     */
    public function add_custom_columns( $columns ) {
        return [
            'cb' => $columns['cb'],
            'popupName' => __( 'Name', self::POST_TYPE ),
            'category' => __( 'Category', self::POST_TYPE ),
            'popupCookieName' => __( 'Cookie Name', self::POST_TYPE  ),
            'popupExpiration' => __( 'Cookie Expiration', self::POST_TYPE  ),
            'active' => __( 'Active', self::POST_TYPE  ),
            'schedule' => __( 'Schedule', self::POST_TYPE  ),
            'popupRedirectTo' => __( 'Redirect Url', self::POST_TYPE  ),
            'date' => __( 'Updated', self::POST_TYPE)
        ];
    }

    /**
     * Allow to add sort by custom specific columns on the post type page table.
     *
     * @since    1.0.0
     * @access   public
     *
     * @param $columns
     * @return mixed
     */
    public function build_custom_table_sort( $columns ) {
        $columns['active'] = 'active';
        $columns['popupName'] = 'popupName';
        $columns['schedule'] = 'schedule';
        return $columns;
    }

    /**
     * Allow to modify the data results.
     *
     * @since    1.0.0
     * @access   public
     *
     * @param $vars
     * @return array
     */
    public function handle_request( $vars ) {
        if ( isset( $vars['orderby'] ) ) {
            switch ( $vars['orderby'] ) {
                case 'popupName':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'popupName',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'popupCookieName':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'popupCookieName',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'desktopFullscreen':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'desktopFullscreen',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'popupExpiration':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'popupExpiration',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'category':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'category',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'popupRedirectTo':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'popupRedirectTo',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                case 'active':
                    $vars = array_merge(
                        $vars,
                        [
                            'meta_key' => 'active',
                            'orderby' => 'meta_value'
                        ]
                    );
                    break;
                default:
                    break;
            }
        }
        if ( isset( $_REQUEST['action'] ) && '-1' == $_REQUEST['action'] && empty( $_REQUEST['s'] )) {
            wp_safe_redirect( '/wp-admin/edit.php?post_type=' . self::POST_TYPE );
            exit;
        }
        return $vars;
    }

    /**
     * Update the post title with name.
     *
     * @since    1.0.0
     * @access   private
     *
     * @param $post_id
     * @param $meta_value
     * @param $is_publish
     */
    private function save_hpp( $post_id, $arg )
    {
        global $wpdb;
        $wpdb->update(
            $wpdb->posts,
            $arg,
            [ 'ID'=> $post_id ]
        );
    }

    /**
     * Display the Link post meta box.
     *
     * @since    1.0.0
     * @access   private
     */
    public function display_meta_box( $post )
    {
        require_once( plugin_dir_path( __FILE__ ) . 'partials/home-page-popups-admin-display.php' );
    }


    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function get_popup()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'get_popup' ) {
            if ( is_numeric(  $_POST['name'] ))  {
                $p = get_post($_POST['name']);
                $ret = $this->get_custom_data( get_post_custom($p->ID) );
                $ret['id'] = $p->ID;
                $ret['name'] = $p->post_title;
                $response = [
                    'status' => 1,
                    'data'   => [$ret]
                ];
            } else {
                $args = array(
                    'post_type' => self::POST_TYPE,
                    'post_status' => 'active',
                    'meta_query'=> array(
                        array(
                            'key' => 'popupName',
                            'compare' => '=',
                            'value' => $_POST['name'],
                        )
                    ),
                    'posts_per_page' => -1,
                    'order' => 'DESC'
                );
                $response = [
                    'status' => 1,
                    'data'   => $this->prepare_query($args)
                ];
            }




        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function schedule_popup()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'schedule_popup' && isset($_POST[ 'id' ]) && isset($_POST[ 'schedule' ]) ) {
           $schedules = explode( '-', $_POST[ 'schedule' ]);
           if ( isset($schedules[0])) {
               $post_id = (int)$_POST[ 'id' ];
               $category = get_post_meta( $post_id, "category", true );

               $start = explode(' ', trim($schedules[0]))[0] . ' 00:00';
               $dateInit = strtotime($start);
               if ( $this->validateSchedule( $dateInit, $category ) ) {
                   $end = explode(' ', ltrim($schedules[1]))[0] . ' 23:59';
                   $this->save_meta(  'doNotShowBefore', $dateInit, $post_id);
                   $this->save_meta(  'doNotShowAfter', strtotime($end), $post_id );
                   $response = [
                       'status'   => 1
                   ];
               }else {
                   $response = [
                       'msg' => 'Invalid date range, found a schedule popup in this date range.',
                       'status'   => 0
                   ];
               }
           } else {
               $response = [
                   'msg' => 'Date to schedule is required.',
                   'status'   => 0
               ];
           }
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function remove_popups()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'remove_popups' && isset($_POST[ 'id' ]) ) {
            $post_id = (int)$_POST[ 'id' ];
            delete_post_meta( $post_id, 'doNotShowBefore');
            delete_post_meta( $post_id, 'doNotShowAfter');
            $response = [
                'status'   => 1
            ];
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function add_category()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'hpp_add_category' && isset($_POST[ 'category' ]) ) {
            $options = get_option('hpp_option', []);
            $already_exist = false;
            foreach ( $options as $option ) {
                if (  $_POST[ 'category' ] == $option[ 'category' ]) {
                    $already_exist = true;
                    break;
                }
            }
            if ( $already_exist ) {
                $response = [
                    'msg'    => 'This category already exist.',
                    'status' => 0
                ];
            } else {
                $options []= [
                    'category' => $_POST[ 'category' ],
                    'description' => $_POST[ 'description' ]
                ];
                update_option('hpp_option', $options);
                $response = [
                    'status'   => 1
                ];
            }
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function remove_category()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'remove_category' && isset($_POST[ 'category' ]) ) {
            $options = get_option('hpp_option', []);
            $new_options = [];
            foreach ( $options as $index =>  $option ) {
                if ( !in_array( $_POST[ 'category' ], $option )) {
                    $new_options []= $option;
                }
            }
            update_option('hpp_option', $new_options);
            $response = [
                'status'   => 1
            ];
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function get_categories()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'get_categories' ) {
            $response = [
                'status'   => 1,
                'data'     => get_option('hpp_option', [])
            ];
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    /**
     * Ajax. Allow to build the pagination.
     *
     * since    1.0.0
     * @access  public
     */
    public function get_schedules()
    {
        if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'get_schedules' ) {
            $today = date('m/d/Y 00:00');
            $now = strtotime($today);
            $args = array(
                'post_type' => self::POST_TYPE,
                'post_status' => 'active',
                'meta_query'=> array(
                    [
                        'key' => 'doNotShowAfter',
                        'compare' => '>=',
                        'value' => $now,
                    ]
                ),
                'posts_per_page' => -1,
                'order' => 'DESC'
            );
            $response = [
                'status' => 1,
                'data'   => $this->prepare_query($args)
            ];
        } else {
            $response = [
                'msg' => 'Invalid action.',
                'status'   => 0
            ];
        }

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit();
    }

    private function prepare_query($args)
    {
        $wp_query = new WP_Query($args);
        $popups = [];
        if ( !empty($wp_query->posts) ) {
            foreach ($wp_query->posts as $p) {
                $ret = $this->get_custom_data( get_post_custom($p->ID) );
                $ret['id'] = $p->ID;
                $ret['name'] = $p->post_title;
                $popups []= $ret;
            }
        }
        return $popups;
    }

    private function get_custom_data( $custom )
    {
        $desk_popup_img= null;
        if( $image_attributes = wp_get_attachment_image_src( esc_attr( $custom['desk_popup_img'][0] ) ) ) {
            $desk_popup_img = $image_attributes[0];
        }
        $mobile_popup_img= null;
        if( $image_attributes = wp_get_attachment_image_src( esc_attr( $custom['mobile_popup_img'][0] ) ) ) {
            $mobile_popup_img = $image_attributes[0];
        }
        $schedule = '';
        $start = $custom['doNotShowBefore'][0];
        $end   = $custom['doNotShowAfter'][0];
        if ( $start ) {
            $schedule .= date('m/d/Y h:m A', $start) . ' - ' . date('m/d/Y h:m A', $end);
        }
        $popupRedirectTo = $custom['popupRedirectTo'][0];
        return [
            'popupCookieName' => $custom['popupCookieName'][0],
            'popupExpiration' => $custom['popupExpiration'][0],
            'desktopFullscreen' => $custom['desktopFullscreen'][0],
            'category' => $custom['category'][0],
            'popupRedirectTo' => $popupRedirectTo ? $popupRedirectTo : '',
            'schedule' => $schedule,
            'desk_popup_img' => $desk_popup_img,
            'mobile_popup_img' => $mobile_popup_img
        ];
    }

    private function validateSchedule( $start, $category )
    {
        $args = array(
            'post_type' => self::POST_TYPE,
            'post_status' => 'active',
            'meta_query'=> array(
                [
                    'key' => 'doNotShowAfter',
                    'compare' => '>=',
                    'value' => $start,
                ],
                [
                    'key' => 'category',
                    'compare' => '=',
                    'value' => $category,
                ]
            ),
            'posts_per_page' => -1,
            'order' => 'DESC'
        );
       return empty((new WP_Query($args))->posts);
    }

}
