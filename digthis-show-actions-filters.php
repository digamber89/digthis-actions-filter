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


class digthisShowFilters{
	/* instance of class*/
	public static $instance;
	public $menu_page;
	/* function to get instance of class */
	public static function get_instance(){
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct(){
		add_action( 'admin_menu', array($this, 'digthis_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array($this, 'digthis_enqueue_scripts') );
	}

	public function digthis_admin_menu() {
		$this->menu_page = add_menu_page( 
			'Digthis Show Filters',
		 	'View Filters',
		 	'manage_options',
		 	'digthis-show-filters',
		 	array($this, 'generate_admin_page')
		 );
	}

	public function generate_admin_page(){
		require_once(DIGTHIS_PLUGIN_DIR_PATH.'/view/admin.php');
	}

	public function digthis_enqueue_scripts() {
		$screen = get_current_screen();
		wp_register_style( 
				'select2',
				plugins_url( 'assets/css/select2.min.css', DIGTHIS_PLUGIN_FILE_PATH ),
				false, false, 'ALL' );
			
		wp_register_script(
				'select2',
				plugins_url( 'assets/js/select2.min.js', DIGTHIS_PLUGIN_FILE_PATH ),
				array('jquery'),
				false,
				true );

		wp_register_script(
				'list',
				plugins_url( 'assets/js/list.min.js', DIGTHIS_PLUGIN_FILE_PATH ),
				array('jquery'),
				false,
				true );

		if( $this->menu_page === $screen->id ) {
			wp_enqueue_style(  'select2' );
			wp_enqueue_script( 'select2' );
			wp_enqueue_script( 'list' );
		}
	}

}
add_action('plugins_loaded', array('digthisShowFilters','get_instance'), 10);