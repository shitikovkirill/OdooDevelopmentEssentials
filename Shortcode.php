<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 29.03.16
 * Time: 11:37
 */

namespace Calendar;


class Shortcode
{
    public function __construct(){
        add_shortcode('calendar', [$this, 'calendarGoogle']);
    }

    public function calendarGoogle(){
        add_action( 'wp_head' , [$this, 'add_jquery_to_head'] );
        add_action( 'wp_footer', [$this, 'myscript'], 1000 );
        new \Calendar\Resources();

        $html="
        <div>
            <div id='loading'>loading...</div>
            <div id='calendar'></div>
        </div>
        ";
        return $html;
    }

    public function myscript() {
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

    public function add_jquery_to_head() {
        wp_enqueue_script( 'jquery' );
    }
}