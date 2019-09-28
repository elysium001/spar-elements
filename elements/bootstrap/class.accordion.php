<?php
class SparBootstrapAccordion {
	private $content = null;
    private $bootstrap_name = '';
	private static $items = '';
	private static $item_headings = '';
    
    function __construct( $content ) {
        $this->content = $content;
		$this->bootstrap_name = 'spar-bootstrap-'.uniqid();

    }
    
    public function render( ){
        if( $this->content == null ) return;
		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        $content = preg_replace($empty_tags, '', $this->content);
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
			self::$items .= "<div id=\"collapse-{$count}\" class=\"collapse {$show_class}\" aria-labelledby=\"heading-{$count}\" data-parent=\"#accordion-".$this->bootstrap_name."\">";
            self::$items .= "<div class=\"card-body\">";
            self::$items .= "{$item[1]}</div></div></div>";
            $count++;
        }
        $elem = '<div id="accordion-'.$this->bootstrap_name.'">';
		$elem .= self::$items;
		$elem .= '</div>';
		echo $elem;
    }
}