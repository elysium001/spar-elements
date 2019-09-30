<?php
include_once('class.tabs.php');
include_once('class.accordion.php');
include_once('class.carousel.php');
include_once('class.modal.php');

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
        wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . '../../assets/libraries/bootstrap/dist/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap-bundle', plugin_dir_url( __FILE__ ) . '../../assets/libraries/bootstrap/dist/js/bootstrap.bundle.min.js', array('jquery'), '4.3.1', true );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . '../../assets/libraries/bootstrap/dist/js/bootstrap.min.js', array('jquery'), '4.3.1', true );
		
    }

    public static function get_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
            'type'=>'accordion',
			'style'=>'tab',
			'title'=>'',
			'btn_class'=>'',
			'btn_text'=>'',
			'headings'=> true,
			'modal'=>'v-centered:false,fade:true,size:lg,backdrop:true,keyboard:true,focus:true,show:true',
			'carousel'=>'controls:true,indicators:true,captions:true,interval:5000,keyboard:true,pause:hover,ride:carousel,wrap:true'
		 ), $atts));

		switch ($type) {
			case 'tabs':
				$tabs = new SparBootstrapTabs( $content, $style );
				$tabs->render();
				break;
			case 'accordion':
				$accordion = new SparBootstrapAccordion( $content );
				$accordion->render();
				break;
			case 'carousel':
				$carousel = new SparBootstrapCarousel( $content, $carousel);
				$carousel->render();
				break;
			case 'modal':
				$modal = new SparBootstrapModal( $content, $modal, $title, $btn_class, $btn_text );
				$modal->render();
				break;
		}
    }
}