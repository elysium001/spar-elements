<?php
include_once('class.tabs.php');
include_once('class.accordion.php');
class SparBootstrap {
    private static $initiated = false;
	private static $items = '';
	private static $item_headings = '';
	private static $bootstrap_name = '';

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

		add_action( 'wp_enqueue_scripts', array('SparBootstrap','load_scripts') );
		add_shortcode( 'spar-bootstrap', array('SparBootstrap','get_shortcode') );
	}

	public static function load_scripts(){
        wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '../../node_modules/bootstrap/dist/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap-bundle', plugin_dir_url( __FILE__ ) . '../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . '../../node_modules/bootstrap/dist/js/bootstrap.min.js', array('jquery'), '4.3.1', true );
		
    }

    public static function get_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
            'type'=>'accordion',
            'style'=>'tab',
			'headings'=> true,
		 ), $atts));

        if( $type == 'tab' || $type == 'tabs' ){
            $tabs = new SparBootstrapTabs( $content, $style );
            return $tabs->render();
        }else if( $type == 'accordion' ){
            $accordion = new SparBootstrapAccordion( $content );
            return $accordion->render();
        }
    }
}