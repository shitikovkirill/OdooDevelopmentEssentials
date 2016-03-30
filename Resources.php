<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 29.03.16
 * Time: 9:15
 */

namespace Calendar;


class Resources
{
    public function __construct(){
        $this->addCss();
        $this->addJs();
    }

    private function addCss(){
        wp_enqueue_style (
            $handle ='fullcalendar.print',
            $src = plugins_url('/fullcalendar/css/fullcalendar.print.css'),
            $deps = array(),
            $ver = false,
            $media = 'print'
        );
        wp_enqueue_style (
            'fullcalendar',
            plugins_url('/fullcalendar/css/fullcalendar.css')
        );
    }

    private function addJs(){

        if(WP_DEBUG){
            wp_enqueue_script(
                $handle = 'jquery',
                $src = plugins_url( '/js/jquery.min.js', __FILE__ ),
                $deps = array(),
                $ver = '2.2.1',
                $in_footer = false
            );
            wp_enqueue_script(
                'fullcalendar',
                plugins_url( '/js/fullcalendar.js', __FILE__ ),
                array( 'jquery',  'moment', )
            );
            wp_enqueue_script(
                'knockout',
                plugins_url( '/js/knockout/lib/knockout-3.4.0.debug.js', __FILE__ ),
                array( 'jquery' )
            );
        } else {
            wp_enqueue_script(
                $handle = 'jquery',
                $src = plugins_url( '/js/jquery.min.js', __FILE__ ),
                $deps = array(),
                $ver = '2.2.1',
                $in_footer = false
            );
            wp_enqueue_script(
                'fullcalendar',
                plugins_url( '/js/fullcalendar.min.js', __FILE__ ),
                array( 'jquery',  'moment', )
            );
            wp_enqueue_script(
                'knockout',
                plugins_url( '/js/knockout/lib/knockout-3.4.0.js', __FILE__ ),
                array( 'jquery' )
            );
        }

        wp_enqueue_script(
            'moment',
            plugins_url( '/js/moment.min.js', __FILE__ ),
            array( 'jquery' )
        );
        wp_enqueue_script(
            'gcal',
            plugins_url( '/js/gcal.js', __FILE__ ),
            array( 'jquery' )
        );
        wp_enqueue_script(
            'knockout_mapping',
            plugins_url( '/js/knockout/lib/knockout.mapping-latest.js', __FILE__ ),
            array( 'jquery' )
        );
        wp_enqueue_script(
            'user',
            plugins_url( '/js/knockout/user.js', __FILE__ ),
            array( 'jquery' )
        );
    }
}