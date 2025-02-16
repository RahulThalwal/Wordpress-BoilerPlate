<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://jackone
 * @since      1.0.0
 *
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wordpressboiler
 * @subpackage Wordpressboiler/includes
 * @author     jackones <jackone@gmail.com>
 */
class Wordpressboiler_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	private $table_activator;

	public function __construct($activator){
		$this->table_activator = $activator;
	}
	public function deactivate() {

		global $wpdb;

		//dropping tables on plugin uninstall
		$wpdb->query("DROP TABLE IF EXISTS ".$this->table_activator->wp_owt_tbl_books());
		$wpdb->query("DROP TABLE IF EXISTS ".$this->table_activator->wp_owt_tbl_book_shelf());

		// delete page when plugin uninstalls
		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT ID from ".$wpdb->prefix."posts WHERE post_name = %s", 'book_tool'
			)
			);

			if($get_data && $page_id = $get_data->ID ) {
				if (get_post ($page_id)) {
					wp_delete_post($page_id, true);  //Delete the matched post 
				}
			}
	}

}
