<?php


namespace HarunRay\Notifications\Database\Faker;


use Faker\Factory;

class Fake
{
	public static function notification( $amount = 100, $user_ids = [] )
	{
		if ( 0 === count( $user_ids ) ) {
			return null;
		}

		$data = [];

		for ( $i = 1; $i <= $amount; $i ++ ) {
			$faker  = Factory::create();
			$data[] = [
				'user_id'     => $faker->randomElement( $user_ids ),
				'subject'     => $faker->text,
				'slug'        => $faker->slug,
				'description' => $faker->text( rand( 150, 250 ) ),
				'read_at'     => $faker->randomElement( [ null, current_time( 'mysql' ) ] )
			];
		}

		return $data;
	}
}
