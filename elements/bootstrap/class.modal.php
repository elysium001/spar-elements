<?php
class SparBootstrapModal {
	private $btn_class = null;
	private $btn_text = null;
	private $title = null;
	private $content = null;
	private $options = null;
    private $bootstrap_name = '';
	private static $items = '';
    
    function __construct( $content, $options = null, $title, $btn_class, $btn_text ) {
        $this->title = $title;
        $this->content = $content;
        $this->btn_class = $btn_class;
        $this->btn_text = $btn_text;
        $this->options = parse_arr( $options );
		$this->bootstrap_name = 'spar-bootstrap-modal-'.uniqid();
    }

    /**
     * Bootstrap v4 docs:https://getbootstrap.com/docs/4.0/components/modal/
     */
    private function build_options(){
        $data_attributes = [];
        foreach( $this->options as $key => $value ){
            switch ($key) {
                case 'backdrop':
                    array_push($data_attributes, 'data-backdrop="'.$value.'"');
                    break;
                case 'keyboard':
                    array_push($data_attributes, 'data-keyboard="'.$value.'"');
                    break;
                case 'focus':
                    array_push($data_attributes, 'data-focus="'.$value.'"');
                    break;
                case 'show':
                    array_push($data_attributes, 'data-show="'.$value.'"');
                    break;
                
            }
        }
        return join(" ", $data_attributes);
    }

    public function render(){
        if( $this->content == null ) return;
		$empty_tags = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        $content = preg_replace($empty_tags, '', $this->content);
        $fade_class = $this->options['fade'] != 'false' ? 'fade':'';
        $v_center_class = $this->options['v-centered'] != 'false' ? 'modal-dialog-centered':'';
        $btn_class = !empty( $this->btn_class ) ? $this->btn_class:'btn-primary';

        $elem = '
            <!-- Button trigger modal -->
            <button type="button" class="btn '.$btn_class.'" data-toggle="modal" data-target="#'.$this->bootstrap_name.'">'.$this->btn_text.'</button>';

        $elem .= '
            <!-- Modal -->
            <div class="modal '.$fade_class.'" id="'.$this->bootstrap_name.'" tabindex="-1" role="dialog" aria-labelledby="'.$this->bootstrap_name.'Title" aria-hidden="true" '.$this->build_options().'>
            <div class="modal-dialog modal-'.$this->options['size'].' ' . $v_center_class .'" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="'.$this->bootstrap_name.'Title">'.$this->title.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">'.$content.'</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>';
		echo $elem;
    }
}