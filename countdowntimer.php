<?php
/** 
 * Plugin Name: Weekly Countdown Timer by Mir Ashiful Karim
 * Author: Mir Ashiful Karim   
 * Author URI: https://mirkarim.herokuapp.com/
 * Version: 1.0.0
 * Text Domain: countdowntimer
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
    echo "Sorry! You are not allowed to visit this page!";
    exit;
}


class countdowntimer {

    public function __construct() 
    {
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));
        add_shortcode("countdowntimer", array($this, 'wcdt'));
    }

    public function wcdt($atts) {
        // Fix timezone to local timezone
        date_default_timezone_set(timezone_name_from_abbr("EST"));
        
        // Get current Time
        $curr_date = date('Y-m-d');

        // Get Current day of this week
        $curr_dayofweek = date('w', $curr_date);

        // a variable to calculate number of days to add initial = 0
        $daystoadd = 0;

        // get attribute params in an array
        $a = shortcode_atts(array(
            'dayofweek'=>'Sunday',
            'hour'=>'23',
            'min'=>'59',
            'sec'=>'59'
        ), $atts);

        // Set a variable to its default state : hour, minute and second
        $hr = '23';
        $min = '59';
        $sec = '59';

        // get hour input validated
        if ((int)$a['hour'] && (int)$a['hour'] < 24 && (int)$a['hour'] >= 0)
        {
            $hr = $a['hour'];
        }

        // get Min input validated
        if ((int)$a['min'] && (int)$a['min'] < 60 && (int)$a['min'] >= 0)
        {
            $min = $a['min'];
        }


        // get Min input validated
        if ((int)$a['sec'] && (int)$a['sec'] < 60 && (int)$a['sec'] >= 0)
        {
            $sec = $a['sec'];
        }

        // Set hour:min:sec in a string
        $setTime = " " . $hr . ":" . $min . ":" . $sec;

        // get user provided day of the week, assume its the next day
        // initial to 0

        $user_dayOfWeek = 0;

        // validate user input for dayofweek
        // convert all inputs for dayofweek to lowercase 
        // set the default to 7
        // set $user_dayOfWeek to validated user input for dayofweek 


        switch (strtolower($a['dayofweek'])) 
        {
            case "sunday": 
                $user_dayOfWeek = 1;
                break;
            case "monday": 
                $user_dayOfWeek = 2;
                break;
            case "tuesday": 
                $user_dayOfWeek = 3;
                break;
            case "wednesday": 
                $user_dayOfWeek = 4;
                break;
            case "thursday": 
                $user_dayOfWeek = 5;
                break;
            case "friday": 
                $user_dayOfWeek = 6;
                break;
            case "saturday": 
                $user_dayOfWeek = 7;
                break;
            default: 
                $user_dayOfWeek = 7;
        }

        if ($user_dayOfWeek > $curr_dayofweek) {
            // if next day is greater than current day
            $daystoadd = 7 - $user_dayOfWeek;
        } else {
            //remaining day on this week + number of next days in the next week
            $daystoadd = (5 - $curr_dayofweek) + $user_dayOfWeek ; 
        }
 
        $enddate = date('Y-m-d', strtotime("+$daystoadd days", strtotime($curr_date))) . $setTime;
        ?>
        <div id="get_time" hidden> <?php echo $enddate ?> </div>

        <div class="cdMainDiv">
            <div class="cdInnerDiv">
                <div class="slotDiv">
                    <h1 id="dayVal"></h1>
                    <p id="dayTitle"></p>
                </div>
                <div class="slotDiv">
                    <h1 id="hrsVal"></h1>
                    <p id="hrsTitle"></p>
                </div>
                <div class="slotDiv">
                    <h1 id="minVal"></h1>
                    <p id="minTitle"></p>
                </div>
                <div class="slotDiv">
                    <h1 id="secVal"></h1>
                    <p id="secTitle"></p>
                </div>
            </div>
        </div>
        

        <?php

    }

    public function load_assets() 
    {
        wp_enqueue_style(
            'countdown-main-style', 
            plugin_dir_url( __FILE__ ) . 'css/style.css',
            array(),
            1.2, 
            'all'
        );

        wp_enqueue_style(
            'google-fonts', 
            'https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap',
            array(),
            1, 
            'all'
        );

        wp_enqueue_script(
            'countdown-main-script',
            plugin_dir_url( __FILE__ ) . 'js/main.js',
            array('jquery'),
            1.3,
            'true'
        );
    }

    

}

new countdowntimer;