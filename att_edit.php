<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$payment = $_POST['payment'];
$coupon_used = $_POST['coupon_used'];
$coupon_rec = $_POST['coupon_rec'];
$invoice = $_POST['invoice'];
$w_city = $_POST['w_city'];
$w_state = $_POST['w_state'];
$zip = $_POST['zip'];
$workshop = $_POST['workshop'];
$w_speaker = $_POST['w_speaker'];
$id = $_GET['att_ID'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$school = $_POST['school'];
$e_mail = $_POST['e_mail'];
$phone = $_POST['phone'];
$post_id = $_POST['post_id'];
$submit = $_POST['submit'];
$w_link = $_POST['w_link'];
$city_edit = $_POST['city_edit'];
$password = $_POST['password'];
/**********************************PASSWORD************************/
/*Look for password in db_conn.php file*/

/**********************************END PASSWORD*******************/

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
<?php if ($_POST['submit']) {
echo '<meta http-equiv="Refresh" content="0;url=workshop_db.php?order=last_name&list=contact&workshop=';
if (!$workshop || $workshop == "null") {
echo $w_link;
}
else {
echo $workshop;
}
echo '&submit=Go">';
}
?>
<title>Edit Attendee</title>
<link href="Database_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php


// form not yet submitted

// display initial form with values pre-filled

if (!$_POST['submit'])

{

 // open database connection
 
$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

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
/*echo '<input type="hidden" name="update_table"  value="';
echo "$table";
echo '">';*/


/*******Last Name******/
 echo '<p><input size="30" maxlength="250" type="text" name="last_name" value="';
 echo $row->last_name; 
 echo '"><label><font size="-1"> - Last Name</font></label></p>';
 echo "\n";

/*******First Name******/
echo '<p><input size="30" maxlength="250" type="text" name="first_name" value="';
echo $row->first_name;
echo '"><label><font size="-1"> - First Name</font></label></p>';
 echo "\n";

/*******School / District Name******/
echo '<p><input size="30" maxlength="250" type="text" name="school" value="';
echo $row->school;
echo '"><label><font size="-1"> - School/District Name</font></label></p>';
 echo "\n";

/*******e-Mail******/
echo '<p><input size="30" maxlength="250" type="text" name="e_mail" value="';
echo $row->e_mail;
echo '"><label><font size="-1"> - Contact e-Mail</font></label></p>';
 echo "\n";

/*******Phone Number******/
echo '<p><input size="30" maxlength="250" type="text" name="phone" value="';
echo $row->phone;
echo '"><label><font size="-1"> - Contact Phone number</font></label></p>';
 echo "\n";
 /*******Workshop Name ->Invoice #******/
echo '<p><input size="8" maxlength="8" type="text" name="invoice" value="';
echo $row->invoice;
echo '"><label><font size="-1"> - Invoice #</font></label></p>';
 echo "\n";
 /*******Workshop City******/
echo '<p><input size="30" maxlength="40" type="text" name="w_city" value="';
echo $row->w_city;
echo '"><label><font size="-1"> - City</font></label></p>';
 echo "\n";
 /*******Workshop State******/
echo '<p><input size="2" maxlength="2" type="text" name="w_state" value="';
echo $row->w_state;
echo '"><label><font size="-1"> - State</font></label></p>';
 echo "\n";
 /*******Workshop Date -> Zip******/
echo '<p><input size="5" maxlength="5" type="text" name="zip" value="';
echo $row->zip;
echo '"><label><font size="-1"> - Zip</font></label></p>';
 echo "\n";
 
 
 
 /*******Workshop Speaker -> Workshop******/
echo '<p>This person is signed up for: <br /><br /><strong>';

$my_query_current_workshop = "SELECT * FROM workshop WHERE ID = " . $row->w_id;
$result_current_workshop = mysql_query($my_query_current_workshop) or die(mysql_error());
$numofrows_current_workshop = @mysql_num_rows($result_current_workshop);
$workshop_row  = mysql_fetch_object($result_current_workshop);

echo $workshop_row->city;
echo ', ';
echo $workshop_row->state;
echo ', ';
echo $workshop_row->workshop_name;
echo ', ';
echo $workshop_row->wdate;
echo '</strong><br /><br /> See below if you need to change this.</p>';
 echo "\n";
 echo '<input type="hidden" name="w_link" value= ';
 echo $workshop_row->ID;
 echo ' />';
  
 
 
 
/*******Paid or Not******/
echo '<p><input type="checkbox" name="payment" value="1" ';
if ($row->paid == 1)
 { 
 echo 'checked';
 }
 echo '><label><font size="-1">Payment Status (Checked means this person has paid.)</font></label></p>';
 echo "\n";
   /*******Received a coupon or not******/
echo '<p><input type="checkbox" name="coupon_rec" value="1" ';
if ($row->coupon_rec == 1)
 { 
 echo 'checked';
 }
 echo '><label><font size="-1">Received Coupon Status (Checked means this person needs a coupon for early registration.)</font></label></p>';
 echo "\n";
 
 /*******Used a coupon or not******/
echo '<p><input type="checkbox" name="coupon_used" value="1" ';
if ($row->coupon_used == 1)
 { 
 echo 'checked';
 }
 echo '><label><font size="-1">Coupon Status (Checked means this peson has used the coupon.)</font></label></p>';
 echo "\n";
 


 /***********Workshop information query************/

$my_query_workshop_id = "SELECT * FROM workshop WHERE wdate >= NOW() ORDER BY city ASC ";
$result_workshop_id = mysql_query($my_query_workshop_id) or die(mysql_error());
$numofrows_workshop_id = @mysql_num_rows($result_workshop_id);
 
/***********************Workshop List****************************/

for($i = 0; $i < $numofrows_workshop_id; $i++){
$j=$i+1;
$row = @mysql_fetch_array($result_workshop_id);
$workshp_date = date('M d, Y', strtotime($row['wdate']));
echo("\n<input type=\"radio\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" /><!--<input type=\"hidden\" name=\"city_edit\" value=\"" . $row[city] . "\" />-->");
echo "<label class=\"wkshp\">";
echo ("$j" . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; ". "$row[workshop_name]" . " &bull; " . "$workshp_date" . ", " . "$row[speaker]" . "</label><br />");
}
echo $w_city;
 echo '<p><input size="30" maxlength="250" type="password" name="password"'; 
 echo '><label><font size="-1"> Password</font></label></p>';
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

 if (!$password) { $errorList[$error_count] = "I'm sorry, you have to be an authorized user of this database to delete any entrees."; $error_count++; }

 if ($password != $set_pass) { $errorList[$error_count] = "I'm sorry, you have entered an incorrect password. Please use the browser's back button and try again."; $error_count++; }
 

 // check for errors

 // if none found...

 if (sizeof($errorList) == 0)

 {

  // open database connection

 
$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/


 // select database

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/
// generate and execute query

if (!$workshop || $workshop == "null") {
$update_query = "UPDATE attendees SET last_name = '$last_name', first_name = '$first_name', school = '$school', e_mail = '$e_mail', phone = '$phone', paid= '$payment', coupon_rec= '$coupon_rec', coupon_used= '$coupon_used', invoice= '$invoice', w_city= '$w_city', w_state= '$w_state', zip= '$zip', w_speaker= '$w_speaker',  timestamp = NOW() WHERE id = '$post_id'";
 }
else {

$query_city_edit = "SELECT * FROM workshop WHERE ID= '$workshop'";
$result_city_edit = mysql_query($query_city_edit) or die(mysql_error());
//$numofrows_city_edit = @mysql_num_rows($result_city_edit);
$row_city_edit = mysql_fetch_object($result_city_edit);

$update_query = "UPDATE attendees SET last_name = '$last_name', first_name = '$first_name', school = '$school', e_mail = '$e_mail', phone = '$phone', w_id = '$workshop', paid= '$payment', coupon_rec= '$coupon_rec', coupon_used= '$coupon_used', invoice= '$invoice', w_city= '$row_city_edit->city', w_state= '$w_state', zip= '$zip', w_speaker= '$w_speaker',  timestamp = NOW() WHERE id = '$post_id'";
  }

  $update_result = mysql_query($update_query) or die ("Error in query: $query. " . mysql_error());
  
if (!$workshop || $workshop == "null") {
echo "<font size=-1>Update successful. <a href=workshop_db.php?order=last_name&list=contact&workshop=" . $w_link . "&submit=Go>Go back to the main list. </a></font>";
}
else {
  echo "<font size=-1>Update successful. <a href=workshop_db.php?order=last_name&list=contact&workshop=" . "$workshop" . "&submit=Go>Go back to the main list.</a></font>";
  }



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
