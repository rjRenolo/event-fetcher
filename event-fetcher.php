<?php 

/**
 * @package WebEventFetcher
 */
 /*
 Plugin Name: Web Event Fetcher 2.0
 Plugin URI: http://notyetmade.com/plugin
 Description: Custom Event plugin fetcher using api JSON
 Version: 0.6.9
 Author: ricky
 Author URI: http://notyetmade.com/author
 License: GPLv2 or Later
 Text Domain: web-event-fetcher 
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

function addScriptss() {   
    // 
  
    
    // wp_enqueue_script( "axios", 'https://unpkg.com/axios/dist/axios.min.js' , array('jquery') );
    wp_enqueue_script( "vue", 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js' , array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'addScriptss' );


function zxc(){
    $conf = get_option('event_conf');
    $confs = unserialize($conf['option_value']);
    $OAuth_url = $confs['event_url'];
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $OAuth_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ",
            "x-rapidapi-key: "
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
      $objevent = json_decode($response);
    //   var_dump($objevent);
    }


    $OAuth_url2 = "http://api.eventful.com/json/events/search?app_key=Vsw2p5hBJfkPRZ4M&where=27.994402,-81.760254&within=1000?oauth_consumer_key=819e35b34e2086058569&oauth_nonce=16680057&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1585705754&oauth_version=1.0&oauth_signature=sho1odEu%2Ft%2FNLHQnIawte2%2BZbJU%3D";
    // $OAuth_url2 = "http://api.eventful.com/rest/events/search?app_key=Vsw2p5hBJfkPRZ4M&=&oauth_nonce=16680057&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1585705754&oauth_version=1.0&oauth_signature=sho1odEu%2Ft%2FNLHQnIawte2%2BZbJU%3D&ex_category";

    $cur2 = curl_init();
    
    curl_setopt_array($cur2, array(
        CURLOPT_URL => $OAuth_url2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ",
            "x-rapidapi-key: "
        ),
    ));
    
    $response2 = curl_exec($cur2);
    $err = curl_error($cur2);
    curl_close($cur2);


    $ticketmaster = json_decode($response);
    $ticketmaster = $ticketmaster->_embedded->events;
    $ticketmaster = json_encode($ticketmaster);

    $eventful = json_decode($response2);
    $eventful = $eventful->events->event;
    $eventful = json_encode($eventful);

echo "<script>var ticketmaster = $ticketmaster; var eventful = $eventful</script>";
wp_localize_script( 'load_script_fetcher', 'fetcher_AjaxAdmin', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'nonce' =>   wp_create_nonce('ajax-nonce')));
}
add_action('wp_head', 'zxc', 999);



function featuredEvents(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-featured-events.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('featured_events', 'featuredEvents');

function secondFeaturedEvents(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-second-featured-events.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('second_featured_events', 'secondFeaturedEvents');


function seemoreEvents(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-seemore-events.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('see_more', 'seemoreEvents');

function cityFilter(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-city-filter.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('city_filter', 'cityFilter');


function categoryPage(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-category-page.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('category_page', 'categoryPage');


function getSingleEvent(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-single-event.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('event', 'getSingleEvent');

function landingSearch(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-landing-search.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('landing_search', 'landingSearch');

function searchPage(){
    ob_start();
    include(plugin_dir_path(__FILE__).'/templates/template-search-page.php');
    $out = ob_get_clean();
    return $out;
}
add_shortcode('search_page', 'searchPage');








function test_req(){
    $respond = array();
    $respond["success"] = true;

    $class =   $_POST["categ"];



    $OAuth_url2 = "http://api.eventful.com/json/events/search?app_key=Vsw2p5hBJfkPRZ4M&where=27.994402,-81.760254&within=65550&oauth_nonce=16680057&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1585705754&oauth_version=1.0&oauth_signature=sho1odEu%2Ft%2FNLHQnIawte2%2BZbJU%3D&category=".$class."&oauth_consumer_key=819e35b34e2086058569";
    $cur2 = curl_init();    
    curl_setopt_array($cur2, array(
        CURLOPT_URL => $OAuth_url2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ",
            "x-rapidapi-key: "
        ),
    ));
    
    $response2 = curl_exec($cur2);
    $err = curl_error($cur2);
    curl_close($cur2);


    $eventful = json_decode($response2);
    $eventful = $eventful->events->event;
    echo json_encode($eventful);
    die();
}
add_action( 'wp_ajax_test_req', 'test_req' );
add_action('wp_ajax_nopriv_test_req', 'test_req');


function single_event(){
    $respond = array();
    $respond["success"] = true;

    $id =   $_POST["id"];



    $OAuth_url2 = "http://api.eventful.com/json/events/get?app_key=Vsw2p5hBJfkPRZ4M&id=".$id;
    $cur2 = curl_init();    
    curl_setopt_array($cur2, array(
        CURLOPT_URL => $OAuth_url2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ",
            "x-rapidapi-key: "
        ),
    ));
    
    $response2 = curl_exec($cur2);
    $err = curl_error($cur2);
    curl_close($cur2);


    $eventful = json_decode($response2);
    // $eventful = $eventful->events->event;
    echo json_encode($eventful);
    die();
}
add_action( 'wp_ajax_single_event', 'single_event' );
add_action('wp_ajax_nopriv_single_event', 'single_event');


function search_event(){
    $respond = array();
    $respond["success"] = true;

    $keyword =   $_POST["keyword"];
    $city =   $_POST["city"];
    $date = $_POST["date"];

    $respond["keyword"] = $keyword;
    $respond["city"] = $city;
    // $date["date"]  = $date;
    



    $OAuth_url2 = "http://api.eventful.com/json/events/search?app_key=Vsw2p5hBJfkPRZ4M&keyword=".$keyword."&location=".$city."&page_size=20"."&date=".$date;
    $cur2 = curl_init();    
    curl_setopt_array($cur2, array(
        CURLOPT_URL => $OAuth_url2,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ",
            "x-rapidapi-key: "
        ),
    ));
    
    $response2 = curl_exec($cur2);
    $err = curl_error($cur2);
    curl_close($cur2);


    $eventful = json_decode($response2);
    // $eventful = $eventful->events->event;
    echo json_encode($eventful);
    // echo json_encode($respond);
    die();
}
add_action( 'wp_ajax_search_event', 'search_event' );
add_action('wp_ajax_nopriv_search_event', 'search_event');




?>