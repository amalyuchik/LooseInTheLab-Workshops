<?php
//session_start();
/**
 * Created by IntelliJ IDEA.
 * User: amalyuchik
 * Date: 8/31/2017
 * Time: 1:11 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/auth/user_authentication.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/db_conn.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/kit_db/includes/form_element_classes/select_input.php');
require_once($_SERVER['DOCUMENT_ROOT']."/kit_db/includes/site_nav.php");
$bootstrapLink = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
$angularJSLink = '<script data-require="angular.js@1.6.1" data-semver="1.6.1" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js"></script>';
$angularRouteLink = '<script data-require="angular-route@1.3.0" data-semver="1.3.0" src="https://code.angularjs.org/1.3.0/angular-route.js"></script>';
$jQueryLink = '<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>';
$fontAwesomeLink = '<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">';
$port = 3306;
$cssLink = '<link rel="stylesheet" href="http://www.seriouslyfunnyscience.com/kit_db/css/nav_style.css" />';
$thispage = $_SERVER['PHP_SELF'];
$current_date = date("Y-m-d H:i:s");
$months_array = array(array("ID"=>"01","data"=>"January"),
    array("ID"=>"02","data"=>"February"),
    array("ID"=>"03","data"=>"March"),
    array("ID"=>"04","data"=>"April"),
    array("ID"=>"05","data"=>"May"),
    array("ID"=>"06","data"=>"June"),
    array("ID"=>"07","data"=>"July"),
    array("ID"=>"08","data"=>"August"),
    array("ID"=>"09","data"=>"September"),
    array("ID"=>"10","data"=>"October"),
    array("ID"=>"11","data"=>"November"),
    array("ID"=>"12","data"=>"December"));