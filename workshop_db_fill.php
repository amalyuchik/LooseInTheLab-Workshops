<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');

$table_city = 'workshop_cities';
$table_date = 'workshop_dates';
$table_w_name = 'workshop_names';
$table_state = 'workshop_states';
$table_speaker = 'speaker_names';
$season = 1;
$year = 2010;

/***********Above, are the Form variables************/


/**************Below are the variables from the Fill-in form to add attendees to the database***************/

$l_name = $_POST['last_name'];
$f_name = $_POST['first_name'];
$school = $_POST['school'];
$e_mail = $_POST['e_mail'];
$invoice = $_POST['invoice'];
$w_id = $_POST['workshop'];
$phone = $_POST['phone'];
$workshop_id = $_POST['workshop'];
$w_name = $_POST['w_name'];
$w_date = $_POST['w_date'];
//$w_state = $_POST['w_state'];
$zip = $_POST['zip'];
$w_speaker = $_POST['w_speaker'];
$pre_paid = $_POST['pre_paid'];
$coupon_rec = $_POST['coupon_rec'];
$submit = $_POST['submit'];



$table_query = "SELECT state FROM workshop WHERE ID = '$w_id' ";
echo $table_query;
$table_result = mysqli_query($link,$table_query) or die(mysql_error());
$table_numofrows = @mysqli_num_rows($table_result);
$table_row = mysqli_fetch_array($table_result);

$city_query = "SELECT city FROM workshop WHERE ID = '$w_id' ";
$city_result = mysqli_query($link,$city_query) or die(mysql_error());
$city_numofrows = mysqli_num_rows($city_result);
$city_row = mysqli_fetch_array($city_result);
$w_city = "$city_row[city]";

/**************Form Queries***********************/

$my_query_city = "SELECT * FROM " .$table_city . " ORDER BY city ASC ";//Just need to fix the query after I set up the table.
$my_query_w_name = "SELECT * FROM " .$table_w_name . " ORDER BY wname ASC ";
$my_query_date = "SELECT * FROM " .$table_date . " ORDER BY w_date ASC ";
$my_query_state = "SELECT * FROM " .$table_state . " ORDER BY state ASC ";
$my_query_speaker = "SELECT * FROM " .$table_speaker . " ORDER BY initials ASC ";
$my_query_workshop_id = "SELECT * FROM workshop WHERE wdate >= NOW() AND cancelled = 0 ORDER BY city ASC ";





$result_city = mysqli_query($link,$my_query_city) or die(mysql_error());
$result_w_name = mysqli_query($link,$my_query_w_name) or die(mysql_error());
$result_date = mysqli_query($link,$my_query_date) or die(mysql_error());
$result_state = mysqli_query($link,$my_query_state) or die(mysql_error());
$result_speaker = mysqli_query($link,$my_query_speaker) or die(mysql_error());
$result_workshop_id = mysqli_query($link,$my_query_workshop_id) or die(mysql_error());

/*MySQL query is made*/

$numofrows_city = mysqli_num_rows($result_city);
$numofrows_w_name = mysqli_num_rows($result_w_name);
$numofrows_date = mysqli_num_rows($result_date);
$numofrows_state = mysqli_num_rows($result_state);
$numofrows_speaker = mysqli_num_rows($result_speaker);
$numofrows_workshop_id = mysqli_num_rows($result_workshop_id);
/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add attendees to the Database.</title>
<style type="text/css">
<!--
#w_fill_form {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
	width: 550px;
}
-->
</style>
</head>

<body>
<?php
if (!$_POST['submit']) {
  echo '<div class=\"fill_form\"><form id=w_fill_form name="fill_form" method="POST" action="';
  echo $thispage;
  echo '">';
  echo '<p>Fill out these fields:</p><input name="last_name" type="text" size="20" maxlength="30" /><label> Last Name</label><br /><input name="first_name" type="text" size="20" maxlength="30" /><label> First Name</label><br /><input name="e_mail" type="text" size="20" maxlength="150" /><label> e-Mail</label><br /><input name="invoice" type="text" size="10" maxlength="10" /><label> Invoice/Receipt Number</label><br /><input name="school" type="text" size="20" maxlength="30" /><label> School / District</label><br /><input name="phone" type="text" size="20" maxlength="30" /><label> Contact Phone Number</label><br /><input name="zip" type="text" size="20" maxlength="30" /><label> School Zip Code</label><br /><hr />';

/***********************Fill - Dynamic Forms****************************/

for($i = 0; $i < $numofrows_workshop_id; $i++){
$j=$i+1;
$row = mysqli_fetch_array($result_workshop_id);
$workshp_date = date('M d, Y', strtotime($row['wdate']));
echo("\n<input type=\"checkbox\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" /><label>" . "$j" . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; ". "$row[workshop_name]" . " &bull; " . "$workshp_date" . ", " . "$row[speaker]" . "</label><br />");
}
	echo '<hr /><label><input name="pre_paid" type="checkbox" /> Check this if Pre-paid</label><br /><br />';
	echo '<label><input name="coupon_rec" type="checkbox" /> Check this if this person needs a coupon for early registration.</label>';
	echo '<hr /><input style="float: none; " class="button" type="submit" name="submit" value="Go" />';
	echo '</form></div>';

}
/*********************************************Second Part of the form ******************************/
else {

// set up error list array

$errorList = array();

$error_count = 0;

 // validate text input fields

 if (!$l_name) { $errorList[$error_count] = "You know you can't do anything without a Last Name. Go get it."; $error_count++; }

 if (!$f_name) { $errorList[$error_count] = "You know you can't do much without a First Name. Go get it."; $error_count++; }
 
 if (!$phone) { $errorList[$error_count] = "What's gonna happen if you need to call 'em? Go get a Phone Number!"; $error_count++; }
 
 if (!$zip) { $errorList[$error_count] = "You must enter a Zip Code For Future Marketing!"; $error_count++; }
 
 if (!$invoice) { $errorList[$error_count] = "You must enter an invoice number for reference with Quickbooks!"; $error_count++; }

 if (!$pre_paid)
 {$paid = 0; }
 else {$paid = 1; }
 
 if(!$coupon_rec){
  $coupon == 0;
   }
else {$coupon = 1;}

 // check for errors

 // if none found...

 if (sizeof($errorList) == 0)
 {
// generate and execute query
$state_check_fill_query = "SELECT * FROM workshop WHERE ID = $w_id";
$state_check_fill_result = mysqli_query($link,$state_check_fill_query) or die ("Error in query: $my_fill_query_attend. " . mysql_error());
$state_check_fill_row = mysqli_fetch_array($state_check_fill_result);
$confirm_date = date('M d, Y', strtotime($state_check_fill_row['wdate']));


$my_fill_query_attend = "INSERT INTO attendees (ID , last_name , first_name , school , e_mail , invoice , phone , w_name , w_id , w_date , w_city , w_state , zip , w_speaker, coupon_rec, pre_paid, paid, timestamp ) VALUES ( '' , '$l_name' , '$f_name' , '$school' , '$e_mail' , '$invoice' , '$phone' , '$w_name' , '$w_id' , '$w_date' , '$w_city' , '$state_check_fill_row[state]' , $zip , '$w_speaker' , '$coupon' , '$paid' , '$paid', NOW())";
 
  $attendee_fill_result_attend = mysqli_query($link,$my_fill_query_attend) or die ("Error in query: $my_fill_query_attend. " . mysql_error());
  // print result
  
  /***************Below are the e-mail variables***********/
$to = $e_mail;
$subject = "IMPORTANT: Loose in the Lab workshop attendance confirmation for $f_name $l_name ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Loose in the Lab Workshop Coordinator <workshops@looseinthelab.com>' . "\r\n";
/*******************************************************/
  /****************Confirmation e-Mail is being created*********************/
//$confirmation_e_mail_q = "SELECT * FROM attendees WHERE ID=(SELECT MAX(ID) FROM attendees) AND e_mail = '$e_mail' ";
//$confirmation_result = mysql_query($confirmation_e_mail_q) or die ("Error in query: $confirmation_e_mail_q. " . mysql_error());
//$numofrows = @mysql_num_rows($confirmation_result);
//$row = @mysql_fetch_array($confirmation_result);

$message = <<<EOMESSAGE
<p>Thank You for your interest in our hands-on science workshops.<br />
This is an e-mail to confirm that $f_name $l_name has been registered for our workshop in $w_city, $state_check_fill_row[state] on $confirm_date. </p>
<p>For reference, your invoice number is: <strong>$invoice</strong></p>
<p>For more information about this workshop please visit our website <a href="$state_check_fill_row[link]">here</a></p>
EOMESSAGE;
mail($to, $subject, $message, $headers);
  /*************************************************************************/
  
  
  //Woo Hoo, Attendant has been added
  
  echo '<p>The following person has been added to the database:<br /> ';
  echo '<strong>' . $l_name . '</strong>, <strong>' . $f_name . '</strong> for <strong>' . $w_city . '</strong> workshop on: <strong>' . $confirm_date ;
  echo '</strong></p>';
  
  if ($paid == 0 || !$pre_paid)
  {
  echo '<p>This person will need to be invoiced in the future.</p>';
  }
  
  else
  {
  echo '<p>This person has pre-paid for their workshop. Send a thank you note.</p>';
  }
    
  echo '<font size=-1>To see current attendance per workshop, <a href=workshop-info.php>click this link</a>.</font>';
  
  echo '<font size=-1>Or add more attendees below.</font>';
  
  echo '<div class=\"fill_form\"><form id=w_fill_form name="fill_form" method="POST" action="';
  echo $thispage;
  echo '">';
  
  echo '<p>Fill out these fields:</p><input name="last_name" type="text" size="20" maxlength="30" /><label> Last Name</label><br /><input name="first_name" type="text" size="20" maxlength="30" /><label> First Name</label><br /><input name="e_mail" type="text" size="20" maxlength="150" /><label> e-Mail</label><br /><input name="invoice" type="text" size="10" maxlength="10" /><label> Invoice/Receipt Number</label><br /><input name="school" type="text" size="20" maxlength="30" /><label> School / District</label><br /><input name="phone" type="text" size="20" maxlength="30" /><label> Contact Phone Number</label><br /><input name="zip" type="text" size="20" maxlength="30" /><label> School Zip Code</label><br /><hr />';

/***********************Fill - Dynamic Forms****************************/

for($i = 0; $i < $numofrows_workshop_id; $i++){
$j=$i+1;
$row = mysqli_fetch_array($result_workshop_id);
$workshp_date = date('M d, Y', strtotime($row['wdate']));
echo("\n<input type=\"checkbox\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" /><label>" . "$j" . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; " . "$row[workshop_name]" . " &bull; ". "$workshp_date" . ", " . "$row[speaker]" . "</label><br />");
}


	echo '<hr /><label><input name="pre_paid" type="checkbox" /> Check this if Pre-paid</label><br /><br />';
	echo '<label><input name="coupon_rec" type="checkbox" /> Check this if this person needs a coupon for early registration.</label>';
	echo '<hr /><input style="float: none; " class="button" type="submit" name="submit" value="Go" />';
	echo '</form></div>';


  // close database connection

  mysqli_close($link);
}

 else
 {

  // errors found

  // print as list

  echo "<font size=-1>The following errors were encountered: <br>";

  echo "<ul>";

  for ($error_count=0; $error_count < sizeof($errorList); $error_count++)
  {
   echo "<li>$errorList[$error_count]</li>";
  }
  echo "</ul></font>";
 }
}

?>

</body>
</html>
