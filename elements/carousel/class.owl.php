<?php 
class SparOwl {
	private static $initiated = false;
	private static $items = '';
	private static $carousel_name = '';

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

		add_action( 'wp_enqueue_scripts', array('SparOwl','load_scripts') );
		add_shortcode( 'spar-carousel', array('SparOwl','get_shortcode') );
	}

	public static function load_scripts(){
		wp_enqueue_style( 'spar-default-owl-css', plugin_dir_url( __FILE__ ) . '../../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css' );
		wp_enqueue_style( 'spar-owl-css', plugin_dir_url( __FILE__ ) . '../../node_modules/owl.carousel/dist/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'spar-owl-js', plugin_dir_url( __FILE__ ) . '../../node_modules/owl.carousel/dist/owl.carousel.min.js', array('jquery'), '2.3.4', true );
		wp_enqueue_script( 'spar-carousel-js', plugin_dir_url( __FILE__ ) . 'spar-carousel.js', array('jquery','spar-owl-js'), '1.0.0', true );
		
	}

	public static function get_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'posts' => 1,
		 ), $atts));

		 self::$carousel_name = 'omar';

		 // Localize the script with new data
		 $spar_data = array(
			 'carouselName' => self::$carousel_name 
		 );
		 wp_localize_script( 'spar-carousel-js', 'spar', $spar_data );
		$content_items = preg_split('/\r\n|\r|\n/', $content);
		foreach( $content_items as $item ){
			self::$items .= "<div class=\"item\">{$item}</div>";
		}
		return self::render();
	}

	public static function render(){
		$elem = '<div class="owl-carousel owl-theme '.self::$carousel_name.'">';
		$elem .= self::$items;
		$elem .= '</div>';
		echo $elem;
	}
}