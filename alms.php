<?php
/**
* @package AlmsPlugin
*/
/*
Plugin Name: Arlen Donation Form
Plugin URI: https://saiarlen.com/alms
Description: This plugin use for collect donations with very secure and easy way and it supports multiple payment gateways.
Version: 1.0.0
Author: Saiarlen
Author URI: https://saiarlen.com
License: GPLv2 or later
Text Domain: alms
*/

defined('ABSPATH') or die("You don't have an access to this file!");

/**
 * Main class
 */
class AlmsSetup
{
	
	public function __construct()
	{
		require_once plugin_dir_path( __FILE__ ) . 'inc/almsinit.php';

	 
	}
	
}

if(class_exists('AlmsSetup'))
{
	$alms_class = new AlmsSetup();
}

if(class_exists('AlmsBootup')){
	$almsbootup = new AlmsBootup();
	register_activation_hook( __FILE__, array($almsbootup, 'almsActivation') );
}

