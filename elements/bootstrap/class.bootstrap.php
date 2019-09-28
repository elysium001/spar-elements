<?php
class SparBootstrap {
    private static $initiated = false;
	private static $items = '';
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
    
    public static function parse_wp_content( $content ){
        if( $content == null ) return;
		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        $content = preg_replace($empty_tags, '', $content);
        $content_items = preg_split('/<h[0-6]>/', $content);
        $count = 1;
		foreach( $content_items as $item ){
            if( trim($item) == '</p>' ) continue;
            $show_class = $count == 1 ? 'show':'';
            $item = preg_split('/<\/h[0-6]>/', $item);            
			self::$items .= "<div class=\"card\">";
			self::$items .= "<div class=\"card-header\" id=\"heading-{$count}\">";
			self::$items .= "<h5 class=\"mb-0\">";
			self::$items .= "<button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse-{$count}\" aria-expanded=\"true\" aria-controls=\"collapse-{$count}\">";
			self::$items .= "{$item[0]}</button></h5></div>";
			self::$items .= "<div id=\"collapse-{$count}\" class=\"collapse {$show_class}\" aria-labelledby=\"heading-{$count}\" data-parent=\"#accordion\">";
            self::$items .= "<div class=\"card-body\">";
            self::$items .= "{$item[1]}</div></div></div>";
            $count++;
        }
    }


    public static function get_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'=>'accordion',
			'headings'=> true,
		 ), $atts));

		self::$bootstrap_name = 'spar-bootstrap-'.uniqid();

		self::parse_wp_content( $content );
		return self::render();
    }
    
    public static function render(){
		$elem = '<div id="accordion-'.self::$bootstrap_name.'">';
		$elem .= self::$items;
		$elem .= '</div>';
		echo $elem;
	}
}