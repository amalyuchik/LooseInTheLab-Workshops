<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$d = date('Y-m-d');
$season_logic = date('n');

/**********Above, are the global variables.***********/
$w_id = $_GET['workshop'];
$table_city = 'workshop_cities';
$table_date = 'workshop_dates';
$table_w_name = 'workshop_names';

/***********Above, are the Form variables************/
if ($season_logic >= 1 && $season_logic < 5) {
$season = "1";
}
elseif ($season_logic >= 5 && $season_logic < 8) {
$season = "2";
}
elseif ($season_logic >= 8 && $season_logic < 13) {
$season = "3";
}
if (!$_GET['Choose']) {
$year = date('Y');
}
else {
$season = $_GET['season'];
$year = $_GET['year'];
}
/*************************Querie Variables*****************************************/

$my_query_workshop_id = "SELECT * FROM workshop WHERE wdate >= NOW() AND cancelled = 0 ORDER BY city, wdate ASC ";

//$link = mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/

mysqli_select_db($link,$db_n) or die(mysql_error());

/*database is chosen*/
$result_workshop_id = mysqli_query($link,$my_query_workshop_id) or die(mysql_error());

/*MySQL query is made*/

$numofrows_workshop_id = mysqli_num_rows($result_workshop_id);

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Prepayment coupon generator</title>
<style type="text/css">
<!--
.init_form {
	font-family: Verdana, Myriad, Calibri, Helvetica, sans-serif;
	font-size: 14px;
	color: #333333;
	width: 650px;
}
.happened {
	color: #FFFFFF;
	background-color: #990000;
	text-align: left;
	font-size: 12px;
	font-weight: normal;
	
}
.gonnaHappen {
	background-color: #66FF99;
	text-align: left;
	font-weight: normal;
	}
p {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
}
h3 {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:24px;
text-align:center;
margin-bottom: -10px;
margin-top: -15px;
}
@media print { .noPrint { display: none; } }
.style1 {
	font-size: 14px;
	margin-top: -5px;
}
.style2 {font-size: 12px}
.style3 {
	font-size: 10px;
}
-->
</style>
</head>

<body>
<?php
if (!$_GET['submit']) {
echo '<form class=init_form name="form_city" method="GET" action="prepayment_coupon_generator.php">';

/***********************Contact - Sign-in list form****************************/
echo "<table cellspacing=\"0\">";
for($i = 0; $i < $numofrows_workshop_id; $i++){
$j = $i+1;
$row = mysql_fetch_array($result_workshop_id);
$count_query = "SELECT COUNT(*) FROM attendees WHERE w_id = " .$row[ID] ." AND deleted = 0";
$result_count = mysql_query($count_query) or die(mysql_error());
$count_row = mysql_fetch_row($result_count);
echo "\n<tr ";
if ($row[wdate] <= $d)
{
echo "class=\"happened\"";
}
else {
echo "class=\"gonnaHappen\"";
}
echo ("><div><td width=\"35px\" align=\"center\" border=\"0\"><strong>" . "$count_row[0]" . "</td><td>" . "<label>" . "<input class=\"noPrint\" type=\"radio\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" />" . "$j " . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; ". "$row[workshop_name]" . " &bull; ");
print date('M d, Y', strtotime($row['wdate']));
echo (", " . "$row[speaker]" . "</label></td></tr></div>");
}
echo "</table>";
/**Query below joins the two tables (attendees and workshop) and counts all the attendees which have "zero" in their deleted field and w_id field within range of the current season and year and not in a cancelled workshop.**/
$att_count_query = "SELECT COUNT(*) FROM attendees INNER JOIN workshop ON attendees.w_id=workshop.ID AND attendees.deleted=0 WHERE workshop.season = '$season' AND workshop.year = '$year' AND cancelled = 0";
$att_result_count = mysqli_query($link,$att_count_query) or die(mysql_error());
$att_count_row = mysqli_fetch_row($att_result_count);
echo "<p>We have <strong style=\"color: #900000;\"> $att_count_row[0] </strong> attendees registered this season.</p>";
echo "<p>Average attendees per workshop: <strong style=\"color: #900000;\"> ";
if($i > 0)
    $avg_att = $att_count_row[0]/$j;
else
    $avg_att = 0;
$avg_round_off = round($avg_att, 2);
echo $avg_round_off;
echo " </strong> </p>";
	echo '<input style="float: none; " class="button" type="submit" name="submit" value="Go" />';
	echo '</form></div>';
	}
else {
?>
<div style="width:820px;">
<?php

$my_query = "SELECT * FROM attendees WHERE w_id= '$w_id' AND deleted= 0 AND coupon_rec= 1 ORDER BY last_name ASC";

$result = mysql_query($my_query) or die(mysql_error());

/*MySQL query is made*/
$numofrows = mysql_num_rows($result);
$date_query = "SELECT wdate FROM workshop WHERE ID = $w_id";
$result_date = mysql_query($date_query) or die(mysql_error());
$date_row = mysql_fetch_row($result_date);
$date_w = $date_row[0];
for($i = 0; $i < $numofrows; $i++) {
$row = mysql_fetch_array($result);
	echo "<div style=\"margin-right:10px; margin-bottom:10px; width:400px; float:left;\"><table width=\"400\" style=\"border:medium dashed #333333;\"><td width=\"128\"><p style=\"text-align:center;\"><img src=\"http://www.seriouslyfunnyscience.com/coupon_stuff/LL_guy_GS.png\" /><br />www.looseinthelab.com<br />9462 S 560 W<br />Sandy, UT 84070<br />Tel: 888-403-1189<br />Fax: 801-568-9586</p></td><td width=\"209\"><table width=\"100%\" style=\"background-image: url(http://www.seriouslyfunnyscience.com/coupon_stuff/coupon_bg.png); background-position:bottom right; background-repeat:no-repeat; border-left:thin dotted #999999;\"><tr><td width=\"201\" height=\"37\" style=\"text-align:center; font-family:Georgia, Times New Roman, Times, serif; font-weight:bold; font-size:18px\"> " . $row[first_name] . " " . $row[last_name] . "</td></tr><tr><td valign=\"top\" style=\"padding:5px;\"><p align=\"center\" class=\"style1\">Here is Your</p><h3>$20.00</h3><p align=\"center\" class=\"style2\">Workshop prepayment bonus.</p><p align=\"center\" class=\"style3\">Please use this at your convenience<br />within 2 months of the date below.<br /><br /><strong style=\"font-size:16px;\">";
 print date('M d, Y', strtotime($date_row['0']));
	 echo "</strong></p></td></tr></table></td></table></div>";
	echo "\n";
	}
	}
?>
</div></body>
</html>
