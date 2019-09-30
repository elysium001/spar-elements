<?php
class SparBootstrapCarousel {
	private $content = null;
	private $options = null;
    private $bootstrap_name = '';
	private static $items = '';
	private static $item_indicators = '';
    
    function __construct( $content, $options = null ) {
        $this->content = $content;
        $this->options = parse_arr( $options );
		$this->bootstrap_name = 'spar-bootstrap-carousel-'.uniqid();
    }

    /**
     * Bootstrap v4 docs:https://getbootstrap.com/docs/4.0/components/carousel/#options
     */
    private function build_options(){
        $data_attributes = [];
        foreach( $this->options as $key => $value ){
            switch ($key) {
                case 'interval':
                    array_push($data_attributes, 'data-interval="'.$value.'"');
                    break;
                case 'keyboard':
                    array_push($data_attributes, 'data-keyboard="'.$value.'"');
                    break;
                case 'pause':
                    array_push($data_attributes, 'data-pause="'.$value.'"');
                    break;
                case 'ride':
                    array_push($data_attributes, 'data-ride="'.$value.'"');
                    break;
                case 'wrap':
                    array_push($data_attributes, 'data-wrap="'.$value.'"');
                    break;
                
            }
        }
        return join(" ", $data_attributes);
    }

    public function render(){
        if( $this->content == null ) return;
		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        $content = preg_replace($empty_tags, '', $this->content);
        $content_items = preg_split('/\r\n|\r|\n/', $content);
        $count = 0;
		foreach( $content_items as $item ){
            if( trim($item) == '</p>' ) continue;
            $active_class = $count == 0 ? 'active':'';            
            self::$items .= "<div class=\"carousel-item {$active_class}\">{$item}</div>";
            self::$item_indicators .= "<li data-target=\"#".$this->bootstrap_name."\" data-slide-to=\"{$count}\" class=\"{$active_class}\"></li>";
            $count++;
        }
        
        $elem = "<div id=\"{$this->bootstrap_name}\" class=\"carousel slide\" {$this->build_options()}>";

        if( $this->options['indicators'] == 'true' ){
            $elem .= "<ol class=\"carousel-indicators\">".self::$item_indicators."</ol>";
        }

        $elem .= "<div class=\"carousel-inner\">";
        $elem .= self::$items;
        $elem .= "</div>";

        if( $this->options['controls'] == 'true' ){
            $elem .= "
                <a class=\"carousel-control-prev\" href=\"#{$this->bootstrap_name}\" role=\"button\" >
                    <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Previous</span>
                </a>";
            $elem .= "
                <a class=\"carousel-control-next\" href=\"#{$this->bootstrap_name}\" role=\"button\" data-slide=\"next\">
                    <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                    <span class=\"sr-only\">Next</span>
                </a>";
        }
        $elem .= "</div>";        
		echo $elem;
    }
}