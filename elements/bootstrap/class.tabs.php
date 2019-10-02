<?php
class SparBootstrapTabs {
	private $content = null;
	private $style = null;
    private $bootstrap_name = '';
	private static $items = '';
	private static $item_headings = '';
    
    function __construct( $content, $style ) {
        $this->content = $content;
        $this->style = $style;
		$this->bootstrap_name = 'spar-bootstrap-'.uniqid();
    }

    public function render(){
        if( $this->content == null ) return;
		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        $content = preg_replace($empty_tags, '', $this->content);
        $content_items = preg_split('/<h[0-6]>/', $content);
        $count = 1;
		foreach( $content_items as $item ){
            if( trim($item) == '</p>' ) continue;
            $active_class = $count == 1 ? 'active':'';
            $item = preg_split('/<\/h[0-6]>/', $item);
			self::$item_headings .= "<li class=\"nav-item\"><a class=\"nav-link {$active_class}\" data-toggle=\"{$this->style}\" href=\"#menu-item-{$count}\">{$item[0]}</a></li>";
			self::$items .= "<div class=\"tab-pane container {$active_class}\" id=\"menu-item-{$count}\">{$item[1]}</div>";
            $count++;
        }
        $elem = "<ul class=\"nav nav-{$this->style}s\">";
        $elem .= self::$item_headings;
        $elem .= "</ul>";
        $elem .= "<div id=\"tab-".$this->bootstrap_name."\" class=\"tab-content mb-5\">";
		$elem .= self::$items;
		$elem .= '</div>';
		echo $elem;
    }
}