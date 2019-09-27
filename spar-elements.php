<?php
/**
 * @package spar_elements
 * @version 1.0.0
 */
/*
Plugin Name: Spar Elements
Plugin URI: http://github.com/elysium001/spar_elements
Description: Helper shortcodes for popular elements
Author: Andres O. Serrano
Version: 1.0.0
Author URI: http://github.com/elysium001
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Sorry, can\'t access me directly.';
	exit;
}

define( 'SPAR_ELEMENTS_VERSION', '1.0.0' );
define( 'SPAR_ELEMENTS_MINIMUM_WP_VERSION', '4.0' );
define( 'SPAR_ELEMENTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SPAR_ELEMENTS_DELETE_LIMIT', 100000 );

require_once( SPAR_ELEMENTS_PLUGIN_DIR . 'class.spar.php' );
require_once( SPAR_ELEMENTS_PLUGIN_DIR . 'elements/carousel/class.owl.php' );

add_action( 'init', array( 'Spar', 'init' ) );
add_action( 'init', array( 'SparOwl', 'init' ) );

// if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
// 	require_once( SPAR_ELEMENTS_PLUGIN_DIR . 'class.spar-elem-admin.php' );
// 	add_action( 'init', array( 'spar-elem_Admin', 'init' ) );
// }
