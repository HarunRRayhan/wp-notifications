<?php

namespace HarunRay\Notifications\Commands;

use WP_CLI_Command;

/**
 * Ray Notifications Plugin Commands
 */
class Command extends WP_CLI_Command
{
	/**
	 * Prints a greeting.
	 *
	 * ## OPTIONS
	 *
	 * <name>
	 * : The name of the person to greet.
	 *
	 * [--type=<type>]
	 * : Whether or not to greet the person with success or error.
	 * ---
	 * default: success
	 * options:
	 *   - success
	 *   - error
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp raynoti hello Rayhan
	 *
	 * @when after_wp_load
	 */
	function hello( $args, $assoc_args )
	{
		list( $name ) = $args;

		// Print the message with type
		$type = $assoc_args['type'];
		\WP_CLI::$type( "Hello, $name!" );
	}
}
