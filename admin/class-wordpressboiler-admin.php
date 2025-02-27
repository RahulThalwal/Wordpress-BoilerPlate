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

	private $table_activator;
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

		require_once WORDPRESSBOILER_PLUGIN_PATH . 'includes/class-wordpressboiler-activator.php';
	$activator = new WordPressBoiler_Activator();
		$this->table_activator = $activator;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {


		$valid_pages = array ("book_management_tool","book_management_create_book","book_managment_list_dashboard","book_management_create_book_shelf","book_management_list_book_shelf");


		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : ""; 

		if(in_array($page, $valid_pages)){

			// adding css files in valid pages

		wp_enqueue_style( "owt-bootstrap","https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css", array(), $this->version, 'all' );

		wp_enqueue_style( "owt-datatable", "https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css", array(), $this->version, 'all' );
		
		wp_enqueue_style( "owt-sweetalert", WORDPRESSBOILER_PLUGIN_URL . 'assets/css/sweetalert.css', array(), $this->version, 'all' );
		}
    
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpressboiler-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {


		$valid_pages = array ("book_management_tool","book_management_create_book","book_managment_list_dashboard","book_management_create_book_shelf","book_management_list_book_shelf");


		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : ""; 

		if(in_array($page, $valid_pages)){


			wp_enqueue_script('jquery');
		
		wp_enqueue_script( "owt-bootstrap-js", WORDPRESSBOILER_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );


		wp_enqueue_script( "owt-datatable-js", "https://cdn.datatables.net/2.2.2/js/dataTables.min.js", array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt-validate-js", WORDPRESSBOILER_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( "owt-sweetalert-js", WORDPRESSBOILER_PLUGIN_URL . 'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpressboiler-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name,"owt_book",array(
			"name"=>"WordpressBoiler",
			"author"=> "rahul",
			"ajaxurl"=> admin_url("admin-ajax.php")
		));

		}

	}

   // create menu method
	public function book_management_menu(){
		add_menu_page("Book Management Tool", "Preference", "manage_options","book_management_tool", array($this,"book_management_tool"));

		// create sunmenu
		add_submenu_page("book_management_tool","Dashboard","Dashboard", "manage_options","book_management_tool", array($this,"book_management_tool"));
 
		

		add_submenu_page("book_management_tool","Create Book Shelf","Create Book Shelf","manage_options","book_management_create_book_shelf",array($this,"book_management_create_book_shelf"));

		add_submenu_page("book_management_tool","List Book Shelf","List Book Shelf","manage_options","book_management_list_book_shelf",array($this,"book_management_list_book_shelf"));

		add_submenu_page("book_management_tool","Create Book","Create Book","manage_options","book_management_create_book",array($this,"book_management_create_book"));

		add_submenu_page("book_management_tool","List Book","List Book","manage_options","book_managment_list_dashboard",array($this,"callback_for_list_dashboard") 

		);

	}

   
	// menu callback function 
	public function book_management_tool(){

		echo "<h1>welcome to dashboard book  </h1>";
	}

	// create book shelf layout
	public function book_management_create_book_shelf(){
		ob_start();    // Started buffer
		include_once(WORDPRESSBOILER_PLUGIN_PATH."admin/partials/tmpl-create-book-shelf.php"); // included template file
	    $template =	ob_get_contents();  // reading content
		ob_end_clean();    // cloasing and cleaning buffer
		echo $template;
	}


	public function book_management_list_book_shelf(){


		global $wpdb;

		$book_shelf = $wpdb->get_results(

			$wpdb->prepare(
				"SELECT * FROM ".$this->table_activator-> wp_owt_tbl_book_shelf(), ""
			)
		);

		print_r($book_shelf);

		ob_start();    // Started buffer
		include_once(WORDPRESSBOILER_PLUGIN_PATH."admin/partials/tmpl-list-book-shelf.php"); // included template file
	    $template =	ob_get_contents();  // reading content
		ob_end_clean();    // cloasing and cleaning buffer
		echo $template;
	}
	public function book_management_create_book(){
		
		global $wpdb;

		$book_shelf = $wpdb->get_results(

			$wpdb->prepare(
				"SELECT id, shelf_name FROM ".$this->table_activator-> wp_owt_tbl_book_shelf(), ""
			)
		);


		ob_start();    // Started buffer
		include_once(WORDPRESSBOILER_PLUGIN_PATH."admin/partials/tmpl-create-book.php"); // included template file
	    $template =	ob_get_contents();  // reading content
		ob_end_clean();    // cloasing and cleaning buffer
		echo $template;
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

		ob_start();    // Started buffer
		include_once(WORDPRESSBOILER_PLUGIN_PATH."admin/partials/tmpl-list-books.php"); // included template file
	    $template =	ob_get_contents();  // reading content
		ob_end_clean();    // cloasing and cleaning buffer
		echo $template;

	}


	public function handle_ajax_requests_admin(){

		global $wpdb;
		// handles all ajax request of admin
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";

		if(!empty($param)){
			if($param == "first_simple_ajax"){

				echo json_encode(array(
					"status" => 1, 
					"message"=> "First Ajax Request",
					"data" => array(
						"name"=> "Wordpreesboiler",
						"author" => "rahul"
					)
					));
			}elseif($param == "create_book_shelf"){

				// get all data from form
				$name= isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name']: "";

				$capacity= isset($_REQUEST['txt_capacity']) ? $_REQUEST['txt_capacity']: "";
				$location= isset($_REQUEST['txt_location']) ? $_REQUEST['txt_location']: "";
				$status= isset($_REQUEST['dd_status']) ? $_REQUEST['dd_status']: "";

				$wpdb->insert($this->table_activator->wp_owt_tbl_book_shelf(

				),
			array(

				"shelf_name" => $name,
				"capacity"=> $capacity,
				"shelf_location" => $location,
				"status"=>$status
			));

			if ($wpdb ->insert_id > 0){

				echo json_encode(array(
					"status" => 1,
					"message" => "Book Shelf created successfully"
				));
			}else{
				echo json_encode(array(
					"status" => 0,
					"message" => "Failed to ceate a book shelf"
				));
			}
			}elseif($param == "delete_book_shelf"){
				$shelf_id = isset($_REQUEST['shelf_id']) ? intval($_REQUEST['shelf_id']) : 0;

				if($shelf_id > 0){

					$wpdb->delete($this->table_activator->wp_owt_tbl_book_shelf(), array(
						"id"=> $shelf_id
					));
					echo json_encode(array(
						"status" =>1,
						"message"=> "Book shelf deleted successfully"

					));
				}else{
					echo json_encode(array(
						"status" =>0,
						"message"=> "Book shelf is not valid"

					));
				}
			}elseif($param = "create_book"){

				//print_r($_REQUEST);die;
			   
				$shelf_id = isset($_REQUEST['dd_book_shelf']) ? intval($_REQUEST['dd_book_shelf']): 0;

				$txt_name = isset($_REQUEST['txt_name']) ?  $_REQUEST['txt_name']: "";

				$book_cover_image = isset($_REQUEST['book_cover_image']) ?  $_REQUEST['book_cover_image']: "";

				$txt_email = isset($_REQUEST['txt_email']) ? $_REQUEST['txt_email']: "";

				$txt_publication = isset($_REQUEST['txt_publication']) ? $_REQUEST['txt_publication']: "";

				$text_description = isset($_REQUEST['text_description']) ? $_REQUEST['text_description']: "";

				$txt_cost = isset($_REQUEST['txt_cost']) ? intval($_REQUEST['txt_cost']): 0;

				$dd_status = isset($_REQUEST['dd_status']) ? intval($_REQUEST['dd_status']): 0;

				$wpdb->insert($this->table_activator->wp_owt_tbl_books(), array(
					"name" => strtolower($txt_name),
					"amount" => $txt_cost,
					"description" => $text_description,
					"email" => $txt_email,
					"shelf_id" => $shelf_id,
					"book_image" => $book_cover_image,
					"status" => $dd_status
				));

				if($wpdb-> insert_id > 0){

					echo json_encode(array(

						"status" => 1,
						"message" => "Book created successfully"
					));
				}else{
					echo json_encode(array(

						"status" => 0,
						"message" => "Failed to create book"
					));
				}
			}
		}
		wp_die();
	}

};