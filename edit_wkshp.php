<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$thispage = $_SERVER['PHP_SELF'];
$id = $_GET['id'];
$h_name = $_POST['h_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$contact = $_POST['contact'];
$phone = $_POST['phone'];
$post_id = $_POST['post_id'];
$submit = $_POST['submit'];

/**********Above, are the global variables.***********/

$table = 'workshop_details';
$h_name = $_POST['h_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$contact = $_POST['contact'];
$phone = $_POST['phone'];

/***********Above, are the Form variables************/

 // generate and execute query

$edit_query = "SELECT * FROM " . $table . " WHERE id= '$id'";//Just need to fix the query after I set up the table.

/***********End of functions and operators***************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Workshop</title>
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

echo '<p>You are editing <strong>';
echo "$row->name";
echo '</strong> workshop at <strong>';
echo "$row->city";
echo '</strong>, <strong>';
echo "$row->state";
echo '</strong> on <strong>';
echo "$row->date";
echo '</strong> presented by <strong>';
echo "$row->speaker";
echo '</strong>';
echo '<form action="' . $PHP_SELF . '" method="POST">';
//echo $PHP_SELF; 
//echo '\" method="POST">';
 echo "\n";
echo '<input type="hidden" name="post_id"  value="';
echo "$id";
echo '">';


/*******Hotel Name******/
 echo '<p><input size="30" maxlength="250" type="text" name="h_name" value="';
 echo $row->h_name; 
 echo '"><label><font size="-1"> - Hotel Name</font></label></p>';
 echo "\n";

/*******Hotel Address******/
echo '<p><input size="30" maxlength="250" type="text" name="address" value="';
echo $row->h_address;
echo '"><label><font size="-1"> - Hotel Address</font></label></p>';
 echo "\n";

/*******Hotel City******/
echo '<p><input size="30" maxlength="250" type="text" name="city" value="';
echo $row->h_city;
echo '"><label><font size="-1"> - Hotel City</font></label></p>';
 echo "\n";

/*******Hotel State******/
echo '<p><input size="2" maxlength="2" type="text" name="state" value="';
echo $row->h_state;
echo '"><label><font size="-1"> - Hotel State (2 letter abbreviation)</font></label></p>';
 echo "\n";

/*******Hotel Zip******/
echo '<p><input size="5" maxlength="5" type="text" name="zip" value="';
echo $row->h_zip;
echo '"><label><font size="-1"> - Hotel Zip</font></label></p>';
 echo "\n";
 /*******Contact Name******/
echo '<p><input size="30" maxlength="250" type="text" name="contact" value="';
echo $row->h_contact;
echo '"><label><font size="-1"> - Contact Name</font></label></p>';
 echo "\n";
 /*******Phone Number******/
echo '<p><input size="30" maxlength="250" type="text" name="phone" value="';
echo $row->h_phone;
echo '"><label><font size="-1"> - - - Contact Phone number: 999-999-9999</font></label></p>';
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

//$error_count = 0;
//
// // validate text input fields
//
// if (!$last_name) { $errorList[$error_count] = "You know you can't do anything without a Last Name. Go get it."; $error_count++; }
//
// if (!$first_name) { $errorList[$error_count] = "You know you can't do much without a First Name. Go get it."; $error_count++; }
// 
// if (!$phone) { $errorList[$error_count] = "What's gonna happen if you need to call 'em? Go get a Phone Number!"; $error_count++; }
//
//
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


  // generate and execute query

  $update_query = "UPDATE ".$table." SET h_name = '$h_name', h_address = '$address', h_city = '$city', h_state = '$state', h_zip = '$zip', h_contact = '$contact', h_phone = '$phone' WHERE id = '$post_id'";

  $update_result = mysql_query($update_query) or die ("Error in query: $query. " . mysql_error());


	$link_query = "SELECT * FROM ".$table." WHERE ID= '$post_id'";
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

  echo "<font size=-1>Update successful. <a href=workshop_data.php>Go Back to the workshop details list</a>.</font>";

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
</body>
</html>
