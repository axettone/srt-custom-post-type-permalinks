<?php
/**
 * Plugin Name: Custom Post Type Permalinks - Forked by PNG
 * Plugin URI: https://github.com/axettone/srt-custom-post-type-permalinks
 * Description:  Add post archives of custom post type and customizable permalinks.
 * Author: Paolo N. Giubelli
 * Author URI: https://www.itestense.it
 * Version: 3.5.3
 * Text Domain: custom-post-type-permalinks
 * License: GPL2 or later
 * Domain Path: /language/
 * Requires at least: 6.1
 * Requires PHP: 7.4
 *
 * @package Custom_Post_Type_Permalinks
 * @version 3.5.3
 */

define( 'CPTP_PLUGIN_FILE', __FILE__ );
define( 'CPTP_DEFAULT_PERMALINK', '/%postname%/' );

$cptp_data = get_file_data(
	__FILE__,
	array(
		'Name'        => 'Plugin Name',
		'PluginURI'   => 'Plugin URI',
		'Version'     => 'Version',
		'Description' => 'Description',
		'Author'      => 'Author',
		'AuthorURI'   => 'Author URI',
		'TextDomain'  => 'Text Domain',
		'DomainPath'  => 'Domain Path',
		'Network'     => 'Network',
	)
);

define( 'CPTP_VERSION', $cptp_data['Version'] );
define( 'CPTP_DOMAIN_PATH', $cptp_data['DomainPath'] );
define( 'CPTP_TEXT_DOMAIN', $cptp_data['TextDomain'] );

unset( $cptp_data );


/**
 * Autoloader for CPTP.
 *
 * @since 1.0.0
 *
 * @param string $class_name class name.
 */
function cptp_class_loader( $class_name ) {
	$file_name = __DIR__ . '/' . str_replace( '_', '/', $class_name ) . '.php';
	if ( is_readable( $file_name ) ) {
		include $file_name;
	}
}

spl_autoload_register( 'cptp_class_loader' );

/**
 * CPTP init.
 */
function cptp_init() {
	$custom_post_type_permalinks = CPTP::get_instance();
	$custom_post_type_permalinks->init();
}

cptp_init();

/**
 * Activation hooks.
 */
register_activation_hook( CPTP_PLUGIN_FILE, array( CPTP::get_instance(), 'activate' ) );
