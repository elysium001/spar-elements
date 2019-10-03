<?php
class SparAdmin
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Spar Elements Settings', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'spar_library_toggle_option' );
        ?>
        <div class="wrap">
            <h1>Spar Elements Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'spar_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'spar_group', // Option group
            'spar_library_toggle_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'bootstrap_css', // ID
            'Bootstrap v4 CSS', // Title 
            array( $this, 'bootstrap_css_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'bootstrap_js', // ID
            'Bootstrap v4 JS', // Title 
            array( $this, 'bootstrap_js_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'owl_js', 
            'Owl JS', 
            array( $this, 'owl_js_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['bootstrap_css'] ) )
            $new_input['bootstrap_css'] = $input['bootstrap_css'];
        
        if( isset( $input['bootstrap_js'] ) )
            $new_input['bootstrap_js'] = $input['bootstrap_js'];

        if( isset( $input['owl_js'] ) )
            $new_input['owl_js'] = $input['owl_js'];

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Disable desired libraries below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function bootstrap_css_callback()
    {
        printf(
            '<input type="checkbox" id="bootstrap_css" name="spar_library_toggle_option[bootstrap_css]" %s />',
            isset( $this->options['bootstrap_css'] ) ? 'checked' : ''
        );
    }

    public function bootstrap_js_callback()
    {
        printf(
            '<input type="checkbox" id="bootstrap_js" name="spar_library_toggle_option[bootstrap_js]" %s />',
            isset( $this->options['bootstrap_js'] ) ? 'checked' : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function owl_js_callback()
    {
        printf(
            '<input type="checkbox" id="owl_js" name="spar_library_toggle_option[owl_js]" %s />',
            isset( $this->options['owl_js'] ) ? 'checked' : ''
        );
    }
}