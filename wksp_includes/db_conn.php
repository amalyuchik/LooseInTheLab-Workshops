<?php
$db_h = 'looselabwork.db.3766381.hostedresource.com';
$db_u = 'looselabwork';
$db_p = 'Workshops9462';
$db_n = 'looselabwork';
$thispage = $_SERVER['PHP_SELF'];
/*Connect variable $link created*/
$link = new mysqli($db_h, $db_u, $db_p, $db_n);
date('m/d/Y');
/*database is chosen*/
/*Password for att_edit and delete pages*/
$set_pass = "Sn1cK3r$";

//mysqli_select_db($db_n, $link) or die(mysqli_error());

/**********Above, are the global variables.***********/
?>