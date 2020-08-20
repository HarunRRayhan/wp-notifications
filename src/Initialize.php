<?php


namespace HarunRay\Notifications;

use HarunRay\Notifications\Commands\Command;
use HarunRay\Notifications\Commands\DB;
use HarunRay\Notifications\Traits\Singleton;

final class Initialize
{
	use Singleton;

	public function __construct()
	{
		$this->registerCommands();
		$this->registerFilters();
	}

	public function registerFilters()
	{
	}

	public function registerCommands()
	{
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			\WP_CLI::add_command( 'raynoti', Command::class );
			\WP_CLI::add_command( 'raynoti db', DB::class );
		}
	}
}
