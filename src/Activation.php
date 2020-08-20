<?php


namespace HarunRay\Notifications;

use HarunRay\Notifications\Database\Table;
use HarunRay\Notifications\Traits\Singleton;

final class Activation
{
	use Singleton;

	/**
	 * @return void
	 */
	public static function activate()
	{
		Table::create();
	}

	/**
	 * @return void
	 */
	public static function deactivate()
	{
		Table::drop();
	}
}
