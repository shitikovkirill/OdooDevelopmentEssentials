<?php

/*
Plugin Name: Fullcalendar
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: kirill
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/
require_once 'Resources.php';
require_once 'Shortcode.php';
require_once 'Admin.php';

FullCalendar::singleton();

class FullCalendar
{
    private static $instance;
    private $count = 0;

    private function __construct(){
        new \Calendar\Shortcode();
        new \Calendar\Admin();
    }

    public static function singleton()
    {
        if (!isset(self::$instance)) {
            //echo 'Создание нового экземпляра.';
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    public function increment()
    {
        return $this->count++;
    }

    public function __clone()
    {
        trigger_error('Клонирование запрещено.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Десериализация запрещена.', E_USER_ERROR);
    }
}