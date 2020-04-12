<?php 

/**
* @package AlmsPlugin
All plugin bootup functions 
*/


defined('ABSPATH') or die;


class AlmsBootup 
{

//Init 
 function __construct(){
 
 	add_action( 'admin_enqueue_scripts', array($this, 'adminEnqueue') );

 	add_action('admin_menu', array($this, 'adminPage'));

 	add_shortcode( 'alms-donantion-form', array($this, 'almsDonationForm') );

 }

  //All admin side scripts
  public function adminEnqueue()
  {

  		wp_enqueue_script( 'alms_script', plugins_url('../vendor/alertms.js', __FILE__) );
  }

  //For adding admin menu at the side bar
  public function adminPage()
  {
  	add_menu_page( 'Alms Donation Plugin', 'Donations', 'manage_options', 'alms_plugin', array($this, 'adminPageLink'), 'dashicons-heart', 4 );
  }

  //Admin page function
  public function adminPageLink(){
  	require_once plugin_dir_path( __FILE__ ) . 'almsadmin.php';
  }

  //Plugin after activation functions
  public function almsActivation()
  {
    global $wpdb;
  	//global $your_db_name;
  	$your_db_name = $wpdb->prefix . "alms"; 
 
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$your_db_name'") != $your_db_name) 
	{
		$sql = "CREATE TABLE " . $your_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` mediumtext NOT NULL,
		`email` tinytext NOT NULL,
		`phone` tinytext NOT NULL,
		`amount` tinytext NOT NULL,
		UNIQUE KEY id (id)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
  }

  //Short code generation
  public function almsDonationForm(){
  	ob_start();

  	require_once plugin_dir_path( __FILE__ ) . 'almsform.php';

  	return ob_get_clean();
  }



}









  