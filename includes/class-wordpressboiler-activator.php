<?php

/**
 * Fired during plugin activation
 *
 * @link       https://jackone
 * @since      1.0.0
 *
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/includes
 * @author     jackones <jackone@gmail.com>
 */
class Wordpressboiler_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		global $wpdb;
	
		$table_name = $this->wp_owt_tbl_books(); // Get the table name dynamically
	
		// Corrected query to check if the table exists
		if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
	
			// Dynamic table creation SQL query
			$table_query = "CREATE TABLE `{$table_name}` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(150) DEFAULT NULL,
				`account` int(11) DEFAULT NULL,
				`description` text DEFAULT NULL,
				`book_image` varchar(200) DEFAULT NULL,
				`email` varchar(150) DEFAULT NULL,
				`shelf_id` INT NULL, 
				`status` int(11) NOT NULL DEFAULT 1,
				`created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
	
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta($table_query);
		}

        if($wpdb->get_var("SHOW TABLES LIKE '".$this->wp_owt_tbl_book_shelf() . "'") != $this->wp_owt_tbl_book_shelf()) {
		$shelf_table =	"CREATE TABLE `".$this->wp_owt_tbl_book_shelf()."` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`shelf_name` varchar(150) NOT NULL,
				`capacity` int(11) NOT NULL,
				`shelf_location` varchar(200) NOT NULL,
				`status` int(11) NOT NULL DEFAULT 1,
				`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
				PRIMARY KEY (`id`)
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

      require_once ABSPATH . 'wp-admin/includes/upgrade.php';
      dbDelta($shelf_table);

  $insert_query = "INSERT INTO " .$this->wp_owt_tbl_book_shelf()."
  (shelf_name,capacity,shelf_location,status) VALUES 
  ('Shelf 1', 230, 'Left Corner', 1),
  ('Shelf 2', 250, 'Right Corner', 1),
  ('Shelf 3', 350, 'Center Top', 1)";

			  $wpdb->query($insert_query);
		}

		// creata page on plugin activation

		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * from ".$wpdb->prefix."posts WHERE post_name = %s", 'book_tool'
			)
			);

			if(!empty($get_data)){
				//already we have data with this post name
			}else{
				// create page

				$post_arr_data = array(
					'post_title' => "Book Tool",
					"Post_name"  => "book_tool",
					"post_status" => "publish",
					"post_author" => 1,
					"post_content" => "Simple page content of Book Tool",
					"post_type" => "page"
				);

				wp_insert_post($post_arr_data);
			}

	}
	
	// Function to return table name with prefix
	public function wp_owt_tbl_books() {
		global $wpdb;
		return $wpdb->prefix . "owt_tbl_books";  //$wpdb->prefix => wp_
	}

  public function wp_owt_tbl_book_shelf(){
	global $wpdb;
	return $wpdb->prefix."owt_tbl_book_shelf";
  }


}	


