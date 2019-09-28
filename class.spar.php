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

		// add_action( 'wp_enqueue_scripts', array('Spar','load_scripts') );
	}

	public static function load_scripts(){

	}
}