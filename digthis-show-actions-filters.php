<?php
/*
Plugin Name: Digthis Show Action Hook
Description: Simple Plugin To See filter and action hooks
Plugin URI: http://#
Author: 
Author URI: http://www.digamberpradhan.com.np/
Version: 1.0
License: GPL2
Text Domain: digthis-show-filters
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( !defined( 'DIGTHIS_PLUGIN_DIR_PATH') ) {
	define('DIGTHIS_PLUGIN_DIR_PATH', dirname(__FILE__) );
}
if( !defined( 'DIGTHIS_PLUGIN_FILE_PATH') ){
	define('DIGTHIS_PLUGIN_FILE_PATH', __FILE__ );	
}
require_once(DIGTHIS_PLUGIN_DIR_PATH.'/includes/class-qm-util.php');
require_once(DIGTHIS_PLUGIN_DIR_PATH.'/includes/class-digthis-show-action-filters.php');