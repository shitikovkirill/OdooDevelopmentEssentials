<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 14.09.16
 * Time: 23:10
 */

namespace FullCalendar\Controllers;


use Amostajo\LightweightMVC\Controller;

class CalendarController extends Controller
{
    public function index(){
        add_action( 'wp_head' , [$this, 'add_jquery_to_head'] );
        add_action( 'wp_footer', [$this, 'myscript'], 1000 );
        $this->addCss();
        $this->addJs();

        return $this->view->get('calendar');
    }

    private function addCss(){
        wp_enqueue_style (
            $handle ='fullcalendar.print',
            $src = plugins_url(BASE_PATH . '/assets/fullcalendar/dist/fullcalendar.print.css'),
            $deps = array(),
            $ver = false,
            $media = 'print'
        );
        wp_enqueue_style (
            'fullcalendar',
            plugins_url(BASE_PATH . '/assets/fullcalendar/dist/fullcalendar.css')
        );
    }

    private function addJs(){

        if(WP_DEBUG){
            wp_enqueue_script(
                'fullcalendar',
                plugins_url( 'assets/fullcalendar/dist//fullcalendar.js', BASE_PATH ),
                array( 'jquery',  'moment', )
            );
        } else {
            wp_enqueue_script(
                'fullcalendar',
                plugins_url( 'assets/fullcalendar/dist/fullcalendar.min.js', BASE_PATH ),
                array( 'jquery',  'moment', )
            );
        }

        wp_enqueue_script(
            'moment',
            plugins_url( '/assets/moment/moment.js', BASE_PATH ),
            array( 'jquery' )
        );
        wp_enqueue_script(
            'gcal',
            plugins_url( '/assets/fullcalendar/dist/gcal.js', BASE_PATH ),
            array( 'jquery' )
        );
    }


    public function myscript(){
        ?>
        <script>
            jQuery(document).ready(function() {
                jQuery('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    // THIS KEY WON'T WORK IN PRODUCTION!!!
                    // To make your own Google API key, follow the directions here:
                    // http://fullcalendar.io/docs/google_calendar/
                    googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',

                    // US Holidays
                    events: 'usa__en@holiday.calendar.google.com',

                    eventClick: function(event) {
                        // opens events in a popup window
                        window.open(event.url, 'gcalevent', 'width=700,height=600');
                        return false;
                    },

                    loading: function(bool) {
                        jQuery('#loading').toggle(bool);
                    }
                });
            });
        </script>
        <?php
    }

    public function add_jquery_to_head(){
        wp_enqueue_script( 'jquery' );
    }
}