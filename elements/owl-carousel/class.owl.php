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
		add_shortcode( 'spar-owl', array('SparOwl','get_shortcode') );
	}

	public static function load_scripts(){
		wp_enqueue_style( 'spar-default-owl-css', plugin_dir_url( __FILE__ ) . '../../assets/libraries/owl.carousel/dist/assets/owl.theme.default.min.css' );
		wp_enqueue_style( 'spar-owl-css', plugin_dir_url( __FILE__ ) . '../../assets/libraries/owl.carousel/dist/assets/owl.carousel.min.css' );
		wp_enqueue_script( 'spar-owl-js', plugin_dir_url( __FILE__ ) . '../../assets/libraries/owl.carousel/dist/owl.carousel.min.js', array('jquery'), '2.3.4', true );
		wp_enqueue_script( 'spar-carousel-js', plugin_dir_url( __FILE__ ) . '../../assets/js/spar_carousel.js', array('jquery','spar-owl-js'), '1.0.0', true );
		
	}

	public static function get_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'loop'=>true,
			'lazyLoad'=> false,
			'xs'=>"items:1,nav:true",
			'sm'=>"items:1,nav:true",
			'md'=>"items:3,nav:true",
			'lg'=>"items:4,nav:true",
			'xl'=>"items:5,nav:true",
			'nav'=>true,
			'center'=> false,
			'autoWidth'=>false,
			'autoplay'=> false,
			'autoplayTimeout'=> 3500,
			'autoplayHoverPause'=> true,
			'margin'=>10,
			'autoHeight'=>false
		 ), $atts));

		self::$carousel_name = 'spar-carousel-'.uniqid();
		$size_arr = [
			0=>parse_arr($xs),
			480=>parse_arr($sm),
			768=>parse_arr($md),
			992=>parse_arr($lg),
			1200=>parse_arr($xl)
		];
		
		// Localize the script with new data
		$spar_data = array(
			"carouselName" => self::$carousel_name,
			"owlOptions" => [ 
				"loop"=>$loop,
				"responsive"=>$size_arr,
				"nav"=>$nav,
				"center"=>$center,
				"autoplay"=>$autoplay,
				"autoplayTimeout"=>$autoplayTimeout,
				"autoplayHoverPause"=>$autoplayHoverPause,
				"margin"=>$margin,
				"autoWidth"=>$autoWidth,
				"autoHeight"=>$autoHeight]
		);
		wp_localize_script( 'spar-carousel-js', 'spar', $spar_data );

		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
		$content = preg_replace($empty_tags, '', $content);
		$content_items = preg_split('/\r\n|\r|\n/', $content);
		foreach( $content_items as $item ){
			if( trim($item) == '</p>' ) continue;
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