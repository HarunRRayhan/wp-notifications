<?php


namespace HarunRay\Notifications\Database;


class Query
{
	public static function insertRows( $rows = array(), $table = null )
	{
		global $wpdb;

		if ( ! $table ) {
			$table = Table::getTableName();
		}

		$table = esc_sql( $table );
		// Setup arrays for Actual Values, and Placeholders
		$values        = array();
		$place_holders = array();
		$query         = "";
		$query_columns = "";

		$query .= "INSERT INTO `{$table}` (";
		foreach ( $rows as $count => $row_array ) {
			foreach ( $row_array as $key => $value ) {
				if ( $count == 0 ) {
					if ( $query_columns ) {
						$query_columns .= ", " . $key . "";
					} else {
						$query_columns .= "" . $key . "";
					}
				}

				$values[] = $value;

				$symbol = "%s";
				if ( is_numeric( $value ) ) {
					if ( is_float( $value ) ) {
						$symbol = "%f";
					} else {
						$symbol = "%d";
					}
				}
				if ( isset( $place_holders[ $count ] ) ) {
					$place_holders[ $count ] .= ", '$symbol'";
				} else {
					$place_holders[ $count ] = "( '$symbol'";
				}
			}
			// mind closing the GAP
			$place_holders[ $count ] .= ")";
		}

		$query .= " $query_columns ) VALUES ";

		$query .= implode( ', ', $place_holders );


		$sql = $wpdb->prepare( $query, $values );
		if ( $wpdb->query( $sql ) ) {
			return true;
		} else {
			return false;
		}
	}
}
