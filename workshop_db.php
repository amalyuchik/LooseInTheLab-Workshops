<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
//include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/wksp_includes/workshop_id_query.php');

$w_id = $_GET['workshop'];
$city = $_GET['cities'];
$wname = $_GET['w_name'];
$order = $_GET['order'];
$list = $_GET['list'];
$last_name = $_GET['last_name'];
$first_name = $_GET['first_name'];
$payment = $_POST['payment'];
$pay_id = $_POST['pay_ID'];
$submit = $_GET['submit'];
$search = $_GET['search'];
$state == $_GET['state'];

/************************Quick Query to gwt the $table variable*****************************/
$table = 'attendees';
/**********Above, are the global variables.***********/

$table_img = 'images';

/***********Above, are the Form variables************/




//$my_query = "SELECT * FROM " . $table . " WHERE w_city= '$city' AND w_name= '$wname' ORDER BY '$order' ASC ";//Just need to fix the query after I set up the table.


/***********End of functions and operators***************/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Workshop DB</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
<!--
.attendees {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
	border: 1px solid #000000;
	width: 880px;
	padding-top: 5px;
	padding-bottom: 5px;
}
@media print {
.sign_in {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11pt;
	color: #000000;
	border: 1px solid #000000;
	width: 850px;
	padding-top: 5px;
	padding-bottom: 5px;
}
.no_print {
	display: none;
	}
}
@media screen {
.sign_in {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
	border: 1px solid #000000;
	width: 850px;
	padding-top: 0px;
	padding-bottom: 1px;
}
}
.php_tr {
	background: #FF6600;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	padding-top: 3px;
	padding-top: 3px;
}
.sig {
	width: 35%;
}

.school {
	color: #000000;
	padding-left: 3px;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #000000;
}
td {
	padding-left: 3px;
	border-bottom-style: solid;
	padding-top: 8px;
	padding-bottom: 2px;
	text-align: left;
	border-bottom-width: 1px;
	border-bottom-color: #333333;
}
.name {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	padding-left: 5px;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #000000;
}
h4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 1.00em;
	color: #000000;
	text-decoration: underline;
	background-color: #FF6600;
	width: 100%;
	text-align: center;
	margin: 0px;
	padding: 0px;
}
.not_paid {
	background-color: #CC0000;
	width: 20px;
}
.paid {
	background-color: #006600;
	width: 20px;
}
.no_coupon {
	width: 10px;
}
.coupon_rec {
	background-color: #FF9900;
	width: 10px;
}
h5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 0.75em;
	margin-left: 30px;
}
-->
</style>
</head>

<body>

 <?php
// echo "$order";
/******************Troubleshooting order issues*********************/


 if ($submit == 'Go') {
 $my_query = "SELECT * FROM attendees WHERE w_id= '$w_id' AND deleted= 0 ORDER BY " . $order . " ASC";//Just need to fix the query after I set up the table.

$result = mysql_query($my_query) or die(mysql_error());


/*MySQL query is made*/
$numofrows = mysql_num_rows($result);
$extra_numofrows = $numofrows + 7;

/*$numofrows variable created to tell PHP how many rows are there in the query output*/
 if ($_GET['list'] == sign_in) {
 include('workshop_id_query.php');
 echo '<h5>Please sign this attendance list for: ';
 echo $workshop_q_row->workshop_name;
 echo ' in ';
 echo $workshop_q_row->city;
 echo ', ';
 echo $workshop_q_row->state;
 echo ' on ';
 echo $workshop_q_row->wdate;
 echo '</h5>';
 echo '<table class="sign_in">';
 echo '<tr class=php_tr><td class=name><h4>Names</h4></td><td class=school><h4>School or District</h4></td><td class=sig><h4>Signature</h4></td></tr>';
for($i = 0; $i < $extra_numofrows; $i++) 
	{
	if($i % 2) 
		{ 
		echo '<tr bgcolor="#e5e5e5">';
		} 
	else 
		{ 
		echo '<tr bgcolor="#ffffff">';
		}
	$row = mysql_fetch_array($result);
		echo ("<td class=name>". "$row[last_name]". ", ". "$row[first_name]". "<td class=school>". "$row[school]" . "</td>" . "<td class=sig>" . "</td>" . "</tr>\n");
		
		} 
		echo '</table>';
//include($_SERVER['DOCUMENT_ROOT'].'/new_out.inc');
}
else {
include('workshop_id_query.php');
$workshp_date = date('M d, Y', strtotime($workshop_q_row->wdate));
echo '<h5>This list contains teachers\' ';
 echo "$list";
 echo ' information for ';
 echo $workshop_q_row->city;
 echo ', ';
 echo $workshop_q_row->state;
 echo ' ';
  echo $workshop_q_row->workshop_name;
 echo ' workshop on ';
 echo $workshp_date;
 echo '.</h5>';
 echo '<table class="sign_in">';
 echo '<tr class=php_tr bgcolor="#ff6600"><td><h4>ID</h4></td><td class=\"name\"><h4>Names</h4></td><td class=\"school\"><h4>School or District</h4></td><td class=\"name\"><h4>e-Mail</h4></td><td class=\"name\"><h4>Phone #</h4></td><td class=\"name\"><h4>Paid</h4></td><td class=\"name\"><h4>Cpn</h4></td><td><h4 class=\"name\">Invoice</h4></td><td class=\"no_print\"><h4>Edit</h4></td><td class=\"no_print\"><h4>Delete</h4></td></tr>';
 
for($i = 0; $i < $numofrows; $i++) 
	{
	if($i % 2) 
		{ 
		echo '<tr bgcolor="#e5e5e5">';
		} 
	else 
		{ 
		echo '<tr bgcolor="#ffffff">';
		}
	$row = mysql_fetch_array($result);
	if ($row[paid] == 0)
	{
	$paid = 'not_paid';
	}
	else
	{
	$paid = 'paid';
	}
	if ($row[coupon_rec] == 0)
	{
	$coupon_rec = 'no_coupon';
	}
	else
	{
	$coupon_rec = 'coupon_rec';
	}
	if ($row[coupon_used] == 1)
	{
	$cpn_used = 'style="background-image: url(\'http://www.seriouslyfunnyscience.com/workshops/cpn_used.gif\'); background-position: bottom center; background-repeat: no-repeat;"';
	}
	else {
	$cpn_used = ' ';
	}
	$j = $i +1;
//	if ($row[paid] == 0) {
		echo ("<td>" . "$j" . "</td>" . "<td class=\"name\">". "$row[last_name]". ", ". "$row[first_name]". "<td class=\"school\">". "$row[school]" . "</td>" . "<td class=\"name\">" . "<a href=\"mailto:$row[e_mail]?subject=IMPORTANT: Loose in the Lab ( " . "$row[w_city]" . " ) workshop related information for " . "$row[first_name]" . " " . "$row[last_name]" . ".\" title=\"Click this link to send an e-mail\">$row[e_mail]</a>" . "</td>" . "<td class=\"name\">" . "$row[phone]" . "</td>" . "<td class=" . "$paid" . "><input type=\"hidden\" name=\"att_ID\" value=" . "$row[ID]" . "/></td><td " . "$cpn_used" . " class=" . "$coupon_rec" . "></td><td class=\"name\">"."$row[invoice]"."</td><td class=\"no_print\">" . "<a href=\"att_edit.php?table=" . "$table" . "&att_ID=" . "$row[ID]" . "\">edit</a></td><td class=\"no_print\"><a href=\"delete.php?table=" . "$table" . "&att_ID=" . "$row[ID]" . "\">delete</a></td>" . "</tr>\n");
	/*	}
		else {
		echo ("<td>" . "$j" . "</td>" . "<td class=name>". "$row[last_name]". ", ". "$row[first_name]". "<td class=school>". "$row[school]" . "</td>" . "<td class=name>" . "<a href=\"mailto:$row[e_mail]?subject=IMPORTANT: Loose in the Lab ( " . "$row[w_city]" . " ) workshop related information for " . "$row[first_name]" . " " . "$row[last_name]" . ".\" title=\"Click this link to send an e-mail\">$row[e_mail]</a>" . "</td>" . "<td class=name>" . "$row[phone]" . "</td>" . "<td class=" . "$paid" . "><input type=\"hidden\" name=\"att_ID\" value=" . "$row[ID]" . "/></td><td class=no_print>" . "<a href=\"att_edit.php?table=" . "$table" . "&att_ID=" . "$row[ID]" . "\">edit</a></td><td class=no_print><a href=\"delete.php?table=" . "$table" . "&att_ID=" . "$row[ID]" . "\">delete</a></td>" . "</tr>\n");
		
		}*/
		
		} 
		echo '</table>';
//include($_SERVER['DOCUMENT_ROOT'].'/new_out.inc');
}
}
elseif ($search == 1) {

$search_query = "SELECT * FROM $table WHERE last_name = '$last_name' OR first_name = '$first_name' ORDER BY last_name";


$search_result = mysql_query($search_query) or die(mysql_error());

$search_numofrows = mysql_num_rows($search_result);


 echo '<table class="sign_in">';
 echo '<tr class=php_tr bgcolor="#ff6600"><td><h4>ID</h4></td><td class=name><h4>Names</h4></td><td class=school><h4>School or District</h4></td><td class=name><h4>e-Mail</h4></td><td class=name><h4>Phone #</h4></td><td class=name><h4>Paid</h4></td><td class=name><h4>Cpn</h4></td><td>Wkshp Name</td><td>City</td><td>State</td><td>Date</td><td>Spkr</td><td class=no_print><h4>Edit</h4></td><td class=no_print><h4>Delete</h4></td></tr>';
 
for($i = 0; $i < $search_numofrows; $i++) 
	{
	if($i % 2) 
		{ 
		echo '<tr bgcolor="#e5e5e5">';
		} 
	else 
		{ 
		echo '<tr bgcolor="#ffffff">';
		}
	$row = mysql_fetch_array($search_result);
	if ($row[paid] == 0)
	{
	$paid = 'not_paid';
	}
	else
	{
	$paid = 'paid';
	}
	if ($row[coupon_rec] == 0)
	{
	$coupon_rec = 'no_coupon';
	}
	else
	{
	$coupon_rec = 'coupon_rec';
	}
	
	if ($row[coupon_used] == 1)
	{
	$cpn_used = 'style="background-image: url(\'http://www.seriouslyfunnyscience.com/workshops/cpn_used.gif\'); background-position: bottom center; background-repeat: no-repeat;"';
	}
	else {
	$cpn_used = ' ';
	}
	$j = $i +1;
	//if ($row[paid] == 0) {
		echo ("<td>" . "$row[ID]" . "</td>" . "<td class=name>". "$row[last_name]". ", ". "$row[first_name]". "<td class=school>". "$row[school]" . "</td>" . "<td class=name>" . "<a href=\"mailto:$row[e_mail]?subject=IMPORTANT: Loose in the Lab ( " . "$row[w_city]" . " ) workshop related information " . "$row[first_name]" . " " . "$row[last_name]" . ".\" title=\"Click this link to send an e-mail\">$row[e_mail]</a>" . "</td>" . "<td class=name>" . "$row[phone]" . "</td>" . "<td class=" . "$paid" . "><input type=\"hidden\" name=\"att_ID\" value=" . "$row[ID]" . "></td><td " . "$cpn_used" . " class=" . "$coupon_rec" . "></td><td>" . "$row[w_name]" . "</td><td>" . "$row[w_city]" . "</td><td>" . "$row[w_state]" . "</td><td>" . "$row[w_date]" . "</td><td>" . "$row[w_speaker]" . "</td><td class=no_print>" . "<a href=\"att_edit.php?att_ID=" . "$row[ID]" . "&table=" . "$table" . "\">edit</a></td><td class=no_print><a href=\"delete.php\">delete</a></td>" . "</tr>\n");
/*		}
		else {
		echo ("<td>" . "$row[ID]" . "</td>" . "<td class=name>". "$row[last_name]". ", ". "$row[first_name]". "<td class=school>". "$row[school]" . "</td>" . "<td class=name>" . "<a href=\"mailto:$row[e_mail]?subject=IMPORTANT: Loose in the Lab ( " . "$row[w_city]" . " ) workshop related information " . "$row[first_name]" . " " . "$row[last_name]" . ".\" title=\"Click this link to send an e-mail\">$row[e_mail]</a>" . "</td>" . "<td class=name>" . "$row[phone]" . "</td>" . "<td class=" . "$paid" . "><input type=\"hidden\" name=\"att_ID\" value=" . "$row[ID]" . "></td><td>" . "$row[w_name]" . "</td><td>" . "$row[w_city]" . "</td><td>" . "$row[w_state]" . "</td><td>" . "$row[w_date]" . "</td><td>" . "$row[w_speaker]" . "<td class=no_print>" . "<a href=\"att_edit.php?att_ID=" . "$row[ID]" . "&table=" . "$table" . "\">edit</a></td><td class=no_print><a href=\"delete.php\">delete</a></td>" . "</tr>\n");
		
		}
	*/	
		} 
		echo '</table>';
}
?>
<p style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;"><a style="text-shadow:#666666; color:#000000;" href="http://www.seriouslyfunnyscience.com/workshops/workshop-info.php">Back to search menu.</a></p>
</body>
</html>
