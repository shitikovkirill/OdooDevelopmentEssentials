<?php

namespace FullCalendar;

use Amostajo\WPPluginCore\Plugin;

/**
 * Main class.
 * Registers HOOKS used within the plugin.
 * Acts like a bridge or router of actions between Wordpress and the plugin.
 *
 * @link http://wordpress-dev.evopiru.com/documentation/main-class/
 * @version 1.0
 */
class Main extends Plugin
{
	/**
	 * Declares public HOOKS.
	 * - Can be removed if not used.
	 * @since 1.0
	 */
	public function init()
	{
		$this->add_shortcode( 'calendar', 'CalendarController@index');
	}

	/**
	 * Declares admin dashboard HOOKS.
	 * - Can be removed if not used.
	 * @since 1.0
	 */
	public function on_admin()
	{
		// i.e.
		// add_action( 'admin_init', [ &$this, 'admin_init' ] );
		// 
		// $this->add_action( 'admin_init', 'AdminController@init' );
	}
}