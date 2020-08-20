<?php


namespace HarunRay\Notifications\Commands;

use HarunRay\Notifications\Database\Faker\Fake;
use HarunRay\Notifications\Database\Query;
use HarunRay\Notifications\Database\Table;
use WP_CLI_Command;

/**
 * Database command for notifications table
 */
class DB extends WP_CLI_Command
{
	/**
	 * Create Database Table
	 *
	 * ## EXAMPLES
	 *
	 *     wp raynoti db create
	 *
	 * @when after_wp_load
	 */
	function create( $args, $assoc_args )
	{
		$db = Table::create();
		if ( ! is_wp_error( $db ) ) {
			\WP_CLI::success( '"' . Table::getTableName() . '" created successfully' );
		} else {
			\WP_CLI::error( "Something wrong. Please check your database configurations" );
		}
	}

	/**
	 * Drop Database Table
	 *
	 * ## EXAMPLES
	 *
	 *     wp raynoti db drop
	 *
	 * @when after_wp_load
	 * @alias delete
	 */
	function drop( $args, $assoc_args )
	{
		$db = Table::drop();
		if ( ! is_wp_error( $db ) ) {
			\WP_CLI::success( '"' . Table::getTableName() . '" dropped successfully' );
		} else {
			\WP_CLI::error( "Something wrong. Please check your database configurations" );
		}
	}

	/**
	 * Seed Notifications Table with Dummy Data
	 *
	 * ## OPTIONS
	 *
	 * [--count=<count>]
	 * : Total number of notifications you want to seed
	 * ---
	 * default: 100
	 *
	 * [--chunk=<chunk>]
	 * : Total number of notification want to add once
	 * ---
	 * default: 100
	 *
	 * ## EXAMPLES
	 *
	 *     wp raynoti db seed --count=100 --chunk=100
	 *
	 * @when after_wp_load
	 */
	function seed( $args, $assoc_args )
	{
		$users = get_users( [ 'fields' => 'ID' ] );
		if ( 0 === count( $users ) ) {
			\WP_CLI::error( "No user in the table. Please add some users first" );
		}
		$chunk = $assoc_args['chunk'];
		$count = $assoc_args['count'];
		$pages = ceil( $count / $chunk );

		$progress = \WP_CLI\Utils\make_progress_bar( 'Seeding dummy notifications', $pages );

		for ( $i = 1; $i <= $pages; $i ++ ) {
			$items = $i == $pages ? ( $count - ( ( $pages - 1 ) * $chunk ) ) : $chunk;
			$data  = Fake::notification( $items, $users );
			$db    = Query::insertRows( $data );
			$progress->tick();
		}
		$progress->finish();
		\WP_CLI::success( 'Seeding Successful' );
	}
}
