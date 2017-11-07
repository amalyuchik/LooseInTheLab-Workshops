<?php
/**********************************************/

$db_h = 'mysql';
$db_u = 'mechelaar';
$db_p = 'malinois';
$db_n = 'looseinthelab';
$thispage = $_SERVER['PHP_SELF'];
$payment = $_POST['payment'];
$w_name = $_POST['w_name'];
$w_city = $_POST['w_city'];
$w_state = $_POST['w_state'];
$w_date = $_POST['w_date'];
$w_speaker = $_POST['w_speaker'];
$id = $_GET['att_ID'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$school = $_POST['school'];
$e_mail = $_POST['e_mail'];
$phone = $_POST['phone'];
$post_id = $_POST['post_id'];
$submit = $_POST['submit'];

/**********Above, are the global variables.***********/

$table = $_GET['table'];

/***********Above, are the Form variables************/

 // generate and execute query

$edit_query = "SELECT * FROM " . $table . " WHERE id= '$id'";//Just need to fix the query after I set up the table.




/***********End of functions and operators***************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Edit Attendee</title>
</head>

<body>
<?php


// form not yet submitted

// display initial form with values pre-filled

if (!$_POST['submit'])

{

 // open database connection
 
//$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/


 // select database

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/


$edit_result = mysql_query($edit_query) or die(mysql_error());

/*MySQL query is made*/

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

$numofrows = @mysql_num_rows($edit_result);
echo '<h4>You are editing record number: ';
echo $id;
echo ' from ';
echo $table;
echo '</h4>';

// if result is returned

// if ($numofrows == 1)
//
// {

  // turn it into an object

  $row = mysql_fetch_object($edit_result);

 // print form with values pre-filled


/*****************Cut form goes here************************/


echo '<div>';

echo '<form action="' . $PHP_SELF . '" method="POST">';
//echo $PHP_SELF; 
//echo '\" method="POST">';
 echo "\n";
echo '<input type="hidden" name="post_id"  value="';
echo "$id";
echo '">';
echo '<input type="hidden" name="update_table"  value="';
echo "$table";
echo '">';


/*******Last Name******/
 echo '<p><input size="30" maxlength="250" type="text" name="last_name" value="';
 echo $row->last_name; 
 echo '"><label><font size="-1">Last Name</font></label></p>';
 echo "\n";

/*******First Name******/
echo '<p><input size="30" maxlength="250" type="text" name="first_name" value="';
echo $row->first_name;
echo '"><label><font size="-1">First Name</font></label></p>';
 echo "\n";

/*******School / District Name******/
echo '<p><input size="30" maxlength="250" type="text" name="school" value="';
echo $row->school;
echo '"><label><font size="-1">School/District Name</font></label></p>';
 echo "\n";

/*******e-Mail******/
echo '<p><input size="30" maxlength="250" type="text" name="e_mail" value="';
echo $row->e_mail;
echo '"><label><font size="-1">Contact e-Mail</font></label></p>';
 echo "\n";

/*******Phone Number******/
echo '<p><input size="30" maxlength="250" type="text" name="phone" value="';
echo $row->phone;
echo '"><label><font size="-1">Contact Phone number</font></label></p>';
 echo "\n";
 /*******Workshop Name******/
echo '<p><input size="30" maxlength="250" type="text" name="w_name" value="';
echo $row->w_name;
echo '"><label><font size="-1">Workshop Name</font></label></p>';
 echo "\n";
 /*******Workshop City******/
echo '<p><input size="30" maxlength="250" type="text" name="w_city" value="';
echo $row->w_city;
echo '"><label><font size="-1">City</font></label></p>';
 echo "\n";
 /*******Workshop State******/
echo '<p><input size="30" maxlength="250" type="text" name="w_state" value="';
echo $row->w_state;
echo '"><label><font size="-1">State</font></label></p>';
 echo "\n";
 /*******Workshop Date******/
echo '<p><input size="30" maxlength="250" type="text" name="w_date" value="';
echo $row->w_date;
echo '"><label><font size="-1">Date</font></label></p>';
 echo "\n";
 /*******Workshop Speaker******/
echo '<p><input size="30" maxlength="250" type="text" name="w_speaker" value="';
echo $row->w_speaker;
echo '"><label><font size="-1">Speaker</font></label></p>';
 echo "\n";
/*******Paid or Not******/
echo '<p><input type="checkbox" name="payment" value="1" ';
if ($row->paid == 1)
 { 
 echo 'checked';
 }
 echo '><label><font size="-1">Payment Status</font></label></p>';
 echo "\n";


echo '<p><input type="Submit" name="submit" value="Update"></p>';

echo '</form>';

echo '</div>';



  // close database connection

  mysql_close($link);


 // no result returned

 // print graceful error message

// else
//
// {
//
//  echo "<font size=-1>That press release could not be located in our database.</font>";
//
// }
//
}

else

{

// form submitted

// start processing it



// set up error list array

$errorList = array();

$error_count = 0;

 // validate text input fields

 if (!$last_name) { $errorList[$error_count] = "You know you can't do anything without a Last Name. Go get it."; $error_count++; }

 if (!$first_name) { $errorList[$error_count] = "You know you can't do much without a First Name. Go get it."; $error_count++; }
 
 if (!$phone) { $errorList[$error_count] = "What's gonna happen if you need to call 'em? Go get a Phone Number!"; $error_count++; }


 // check for errors

 // if none found...

 if (sizeof($errorList) == 0)

 {

  // open database connection

 
//$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/


 // select database

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/

$update_table = $_POST['update_table'];

  // generate and execute query

  $update_query = "UPDATE " . $_POST['update_table'] . " SET last_name = '$last_name', first_name = '$first_name', school = '$school', e_mail = '$e_mail', phone = '$phone', paid= '$payment', w_name= '$w_name', w_city= '$w_city', w_state= '$w_state', w_date= '$w_date', w_speaker= '$w_speaker',  timestamp = NOW() WHERE id = '$post_id'";

  $update_result = mysql_query($update_query) or die ("Error in query: $query. " . mysql_error());

	$link_query = "SELECT * FROM " . $update_table . " WHERE ID = '$post_id'";
	$link_result = mysql_query($link_query) or die ("Error in query: $query. " . mysql_error());
	$link_numofrows = @mysql_num_rows($link_result);
	 $link_row = mysql_fetch_object($link_result);
	 
//	 echo $link_row->w_city;
//	 echo '<br />';
//	 
	 $link_city = $link_row->w_city;
//	
//	 echo $link_city;
//	  echo '<br />';
	 
	 if ($link_city == 'Kansas City') {
	 $link_city_out = 'Kansas+City'; }
	 elseif ($link_city == 'Grand Island') {
	 $link_city_out = 'Grand+Island'; }
	 elseif ($link_row->w_city == 'St Louis'){
	 $link_city_out = 'St+Louis'; }
	 elseif ($link_city == 'Ft Worth'){
	 $link_city_out = 'Ft+Worth'; }
	 elseif ($link_city == 'El Paso'){
	 $link_city_out = 'El+Paso'; }
	 elseif ($link_city == 'San Antonio'){
	 $link_city_out = 'San+Antonio'; }
	 elseif ($link_city == 'Las Vegas'){
	 $link_city_out = 'Las+Vegas'; }
	 elseif ($link_city == 'Baton Rouge'){
	 $link_city_out = 'Baton+Rouge'; }
	 elseif ($link_city == 'Rapid City'){
	 $link_city_out = 'Rapid+City'; }
	 elseif ($link_city == 'Sioux Falls'){
	 $link_city_out = 'Sioux+Falls'; }
	 else {
	 $link_city_out = $link_city; }
	 
	// echo $link_row->ID;
//	 echo $link_city;
//	 echo $link_row->ID;
//	 echo $link_city_out;
	 
	 
  // print result

  echo "<font size=-1>Update successful. <a href=workshop_db.php?order=last_name&list=contact&w_name=" . "$link_row->w_name" . "&cities=" . "$link_city_out" . "&table=" . "$update_table" . "&submit=Go>Go back to the main list.</a>.</font>";



  // close database connection

  mysql_close($link);

 }

 else

 {

  // errors occurred

  // print as list

  echo '<font size=-1>The following errors were encountered: <br>';

  echo '<ul>';

  for ($x=0; $x<sizeof($errorList); $x++)

  {

   echo "<li>$errorList[$x]";

  }

  echo "</ul></font>";

 }

}



?>


<!-- page footer - snip -->
</body>
</html>
