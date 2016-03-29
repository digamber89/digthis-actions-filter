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
		add_action( 'admin_enqueue_scripts', array($this, 'digthis_admin_enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', array($this, 'load_enqueue_scripts') );
		add_action('admin_bar_menu', array($this,'custom_toolbar_link'), 999);
		add_action('wp_footer', array($this, 'magnific_holder') );
	}

	public function magnific_holder(){
	?>
	<div id="test-popup" class="white-popup mfp-hide">
	  <?php require_once(DIGTHIS_PLUGIN_DIR_PATH.'/view/front-end.php'); ?>
	</div>
		<script type="text/javascript">
		jQuery(function($){
			$('#wp-admin-bar-digthis-show-filter > a').magnificPopup({
				type:'inline',
				midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			});
			
		})
		</script>
		<style type="text/css">
			.white-popup {
			  position: relative;
			  background: #FFF;
			  padding: 20px;
			  width: auto;
			  max-width: 80%;
			  margin: 20px auto;
			}
		</style>
	<?php
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

	/**
	 * [custom_toolbar_link description]
	 * @param  [object] $wp_admin_bar [object for admin bar]
	 * @return [type]               [description]
	 */
	public function custom_toolbar_link($wp_admin_bar) {
		if( !is_admin() ){
		$args = array(
			'id' => 'digthis-show-filter',
			'title' => 'Show Filters', 
			'href' => '#test-popup', 
			'meta' => array(
				'class' => 'digthis-show-filter', 
				'title' => 'Show Action Hooks and Filters'
				)
		);
		$wp_admin_bar->add_node($args);
		}
	}


	public function generate_admin_page(){
		require_once(DIGTHIS_PLUGIN_DIR_PATH.'/view/admin.php');
	}

	public function load_enqueue_scripts(){
		/*echo plugins_url( 'assets/js/jquery.magnific-popup.min.js', DIGTHIS_PLUGIN_FILE_PATH );
		die; */
		wp_register_script(
			'magnific-popup',
			plugins_url( 'assets/js/jquery.magnific-popup.min.js', DIGTHIS_PLUGIN_FILE_PATH ),
			array('jquery'),
			false,
			true );
		wp_register_style( 
			'magnific-popup',
			plugins_url( 'assets/css/magnific-popup.css', DIGTHIS_PLUGIN_FILE_PATH ),
			false, false, 'ALL' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_style( 'magnific-popup' );

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

		//
		//
		
			wp_enqueue_style(  'select2' );
			wp_enqueue_script( 'select2' );
			wp_enqueue_script( 'list' );
	
	}

	public function digthis_admin_enqueue_scripts() {
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
