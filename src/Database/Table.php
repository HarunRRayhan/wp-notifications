<?php

namespace HarunRay\Notifications\Database;

class Table
{
	const NAME = 'notifications';

	public static function create()
	{
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = static::getTableName();
		$users_table     = $wpdb->prefix . 'users';

		$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
		  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  user_id bigint(20) unsigned NOT NULL,
		  subject varchar(255) NOT NULL,
		  slug varchar(255) NOT NULL,
		  description varchar(255) NOT NULL,
		  read_at datetime NULL,
		  created_at datetime DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (id),
		  INDEX (user_id),
		  INDEX (created_at),
		  INDEX (read_at),
		  CONSTRAINT foreign_key_user_id
		    FOREIGN KEY (user_id)
		    REFERENCES $users_table(id)
		        ON UPDATE CASCADE
		        ON DELETE CASCADE
		) $charset_collate;";


		return static::run( $sql );
	}

	public static function setIndex()
	{
		global $wpdb;
		$table_name = static::getTableName();
		$sql        = "
		CREATE INDEX user_id ON `{$table_name}` (user_id)
		CREATE INDEX read_at ON `{$table_name}` (read_at)
		CREATE INDEX created_at ON `{$table_name}` (read_at)
		";

		return $wpdb->query( $sql );
	}

	public static function setConstrain()
	{
		global $wpdb;
		$users_table = $wpdb->prefix . 'users';
		$table_name  = static::getTableName();

		$sql = "ALTER TABLE $table_name
               	ADD CONSTRAINT foreign_key_user_id
		    	FOREIGN KEY (user_id)
		    	REFERENCES $users_table(id)
		        	ON UPDATE CASCADE
		        	ON DELETE CASCADE";

		return $wpdb->query( $sql );
	}

	public static function drop()
	{
		global $wpdb;
		$table_name = static::getTableName();
		$sql        = "DROP TABLE IF EXISTS `{$table_name}`";

		return $wpdb->query( $sql );
//		return static::run( $sql );
	}

	public static function run( $sql )
	{
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		return dbDelta( $sql );
	}

	public static function getTableName()
	{
		global $wpdb;

		return $wpdb->prefix . static::NAME;
	}
}
