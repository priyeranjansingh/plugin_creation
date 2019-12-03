<?php
/**
 * Plugin Name: HELLO WORLD
 * Plugin URI: 
 * Description: WRITE YOU DESCRIPTION THAT DEFINES THE USE AND FUNCTIONALITY OF PLUGIN
 * Version: 1.0.0
 * Author: PRIYE RANJAN
 * Author URI: 
 *
 * @package HELLO WORLD
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!defined('HW_PLUGIN_PATH')){
   define('HW_PLUGIN_PATH',  plugin_dir_path( __FILE__ ));
}

   
add_action('admin_menu', 'cwb_menu_pages');
function cwb_menu_pages(){
	$user_roles = wp_get_current_user();
    $current_user_role = $user_roles->roles[0]; 
	if (($current_user_role == "administrator")){
		add_menu_page('PAGE NAME', 'PAGE NAME', 'manage_options', 'URL TO DISPLAY', 'FUNCTION_NAME','dashicons-analytics',66 );
	}
}

//here is code create database if needed,other wise comment this code
function create_db(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'TABLE_NAME';
	if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name){ 
		 $sql = "CREATE TABLE $table_name (
		 id int(111) NOT NULL AUTO_INCREMENT,
		 COLOUMN_NAME varchar(255) NOT NULL,
		 date_added date NOT NULL,
		 PRIMARY KEY  (id)
		 );";

		 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		 dbDelta( $sql );
	}
}
register_activation_hook( __FILE__, 'create_db' );
/*
	* REPALCE FUNCTION_NAME WITH YOUR FUNCTION 
*/
function FUNCTION_NAME(){
	global $wpdb;
	/*
    WRITE YOUR CODE HERE 
  */
}

// BELOW CODE TO REMOVE DATABASE IF ANY CREATED AFTER PLUGIN DELETE
/*
* OPTIONAL IF YOU DON'T NEED DELETE THIS CODE OR COMMENT IT
*/
register_uninstall_hook( __FILE__, 'my_plugin_remove_database' );
function my_plugin_remove_database() {
     global $wpdb;
     $table_name = $wpdb->prefix . 'TABLE_NAME';
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);
     delete_option("my_plugin_db_version");
}  
?>
