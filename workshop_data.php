<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');

/**********Above, are the global variables.***********/

$table_att = 'attendees';
$table_city = 'workshop_cities';
$table_date = 'workshop_dates';
$table_w_name = 'workshop_names';
$table_state = 'workshop_states';
$table_speaker = 'speaker_names';
$table_data = 'workshop_details';
/***********Above, are the Form variables************/

$link = mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());
/*Connect variable $link created*/

mysql_select_db($db_n, $link) or die(mysql_error());
/******************Choose tyhe database******************/

$data_query = "SELECT * FROM " .$table_data. " ORDER BY city ASC";

$result_data = mysql_query($data_query) or die(mysql_error());

$numofrows_data = mysql_num_rows($result_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Workshop Details</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
	text-align: left;
	padding: 3px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #666666;
}
.hidden {
	display: none;
}
-->
</style>
</head>

<body>
<?php
//echo "$numofrows_data";
echo'<table>';
for($i = 0; $i < $numofrows_data; $i++) {
	
$row = mysql_fetch_array($result_data);
$j = $i+1;
if ($i % 2) 
		{ 
		echo '<tr class=php_tr bgcolor="#e5e5e5">';
		} 
	else 
		{ 
		echo '<tr class=php_tr bgcolor="#ffffff">';
		}
	echo ("<td>". "$j" . "</td><td class=hidden>". "$row[ID]" . "</td><td>" . "$row[name]" . "</td><td>". "$row[city]" . "</td><td>". "$row[state]" . "</td><td>". "$row[wdate]" . "</td><td>". "$row[speaker]" . "</td><td>" . "$row[h_name]" . "</td><td>" . "$row[h_address]" . "</td><td>" . "$row[h_city]" . ", " . "$row[h_state]" .", " . "$row[h_zip]" . "</td><td>" . "$row[h_contact]" . "</td><td>" . "$row[h_phone]" . "</td></tr>\n"); 
	}
	echo '</table>';
	?>
</body>
</html>
