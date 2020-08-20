<?php
/**
 * @author HarunRRayhan/HRXPlugins
 * @url http://hrxplugins.com/
 * @version 1.0
 * File: Singleton.php
 * @FileVersion: 1.0
 * Created On: 20/8/20:3:08 pm 08/20/2020
 * Updated On: 20/8/20:3:08 pm 08/20/2020
 * @package: @awesome-logo-slider-pro
 */

namespace HarunRay\Notifications\Traits;


trait Singleton
{
	protected static $_instance = null;

	public static function instance()
	{
		if ( is_null( static::$_instance ) ) {
			static::$_instance = new static();
		}

		return static::$_instance;
	}
}
