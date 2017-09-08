<?php
/**
 * Created by IntelliJ IDEA.
 * User: amalyuchik
 * Date: 9/7/2017
 * Time: 10:51 AM
 */
if($_GET['logout']==1){
    $past = time() - 100;
//this makes the time in the past to destroy the cookie
    setcookie(ID_LooseInTheLab, gone, $past);
    setcookie(Key_LooseInTheLab, gone, $past);
    header("Location: http://www.seriouslyfunnyscience.com/workshops/");
}
?>