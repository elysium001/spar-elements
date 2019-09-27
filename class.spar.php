<?php 
class Spar {
	private static $initiated = false;
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;

		add_action( 'wp_enqueue_scripts', array('Spar','load_scripts') );
	}

	public static function load_scripts(){
		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '/node_modules/bootstrap/dist/css/bootstrap.min.css' );
	
		wp_enqueue_script( 'bootstrap-bundle', plugin_dir_url( __FILE__ ) . '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array('jquery'), '4.3.1', true );
	}
}