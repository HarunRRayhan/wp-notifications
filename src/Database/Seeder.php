<?php


namespace HarunRay\Notifications\Database;


class Seeder
{
	public static function run( $count = 100, $table_name = null )
	{
		if ( ! $table_name ) {
			$table_name = Table::getTableName();
		}

	}
}
