<?php
/**
 * Plugin Name:     Ray Notifications
 * Plugin URI:      https://harunrrayhan.com
 * Description:     A notifications plugin to optimize database for wp projects
 * Author:          Harun R Rayhan
 * Author URI:      https://harunrrayhan.com
 * Text Domain:     ray-notifications
 * Domain Path:     /languages
 * Version:         0.2.0
 *
 * @package         Ray_Notifications
 */

use HarunRay\Notifications\Activation;
use HarunRay\Notifications\Initialize;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define( 'RAY_NOTIFICATIONS_FILE', __FILE__ );
define( 'RAY_NOTIFICATIONS_PATH', plugin_dir_path( __FILE__ ) );

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

register_activation_hook( RAY_NOTIFICATIONS_FILE, [ Activation::class, 'activate' ] );
register_deactivation_hook( RAY_NOTIFICATIONS_FILE, [ Activation::class, 'deactivate' ] );

Initialize::instance();
