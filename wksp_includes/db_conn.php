<?php
$db_h = 'looselabwork.db.3766381.hostedresource.com';
$db_u = 'looselabwork';
$db_p = 'Workshops9462';
$db_n = 'looselabwork';
$thispage = $_SERVER['PHP_SELF'];
/*Connect variable $link created*/
$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());
date('m/d/Y');
/*database is chosen*/
/*Password for att_edit and delete pages*/
$set_pass = "Sn1cK3r$";

mysql_select_db($db_n, $link) or die(mysql_error());

/**********Above, are the global variables.***********/
?>