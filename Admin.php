<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 30.03.16
 * Time: 21:01
 */

namespace Calendar;


class Admin
{
    public function __construct(){
        add_action('admin_menu', array($this, 'addMenu'));
    }

    public function addMenu(){
        add_menu_page( 'Calendar', 'Calendar', 'manage_options','full_calendar', array($this, 'adminPageMain') );
        //add_submenu_page('limited_mm','Users list', 'Users list',  'administrator', 'limited_mm_list_page', array($this, 'admin_page_list') );

    }

    public function adminPageMain(){

    }
}