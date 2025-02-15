<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://jackone
 * @since      1.0.0
 *
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/admin
 * @author     jackones <jackone@gmail.com>
 */
class Wordpressboiler_Admin {

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
		 * defined in Wordpressboiler_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpressboiler_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpressboiler-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wordpressboiler_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpressboiler_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpressboiler-admin.js', array( 'jquery' ), $this->version, false );

	}

   // create menu method
	public function book_management_menu(){
		add_menu_page("Book Management Tool", "Preference", "manage_options","book_management_tool", array($this,"book_management_plugin1"));

		// create sunmenu
		add_submenu_page("book_management_tool","Dashboard","Dashboard", "manage_options","book_management_tool", array($this,"book_management_plugin1"));
 

		add_submenu_page("book_management_tool","Create Book","Create Book","manage_options","book_management_create_book",array($this,"book_management_create_book") 

		);

		add_submenu_page("book_management_tool","List Book","List Book","manage_options","book_managment_list_dashboard",array($this,"callback_for_list_dashboard") 

		);

	}

   

	// menu callback function 
	public function book_management_plugin1(){
		echo "<h1>welcome to plugin  </h1>";
	}

	public function book_management_create_book(){
		echo "<h1>welcome to create book  </h1>";
	}

	public function  callback_for_list_dashboard(){
		global $wpdb;
// $wppb->get_var   for single value from database
// $wppb->get_row   for row data
//$wppb->get_col    for row data
// $wpdb->results   for all the table data
		// $user_email = $wpdb->get_row("SELECT * from wp_users WHERE ID = 1", ARRAY_N );
		// echo "<pre>";
		// print_r ($user_email);

		// $post_title = $wpdb->get_results("SELECT ID, post_title from wp_posts", ARRAY_A );
		// echo "<pre>";
		// print_r($post_title);

      

	}

};
