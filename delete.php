<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$payment = $_POST['payment'];
$invoice = $_POST['invoice'];
$w_city = $_POST['w_city'];
$w_state = $_POST['w_state'];
$zip = $_POST['zip'];
$workshop = $_POST['workshop'];
$w_speaker = $_POST['w_speaker'];
$id = $_GET['att_ID'];
$password = $_POST['password'];
/**********************************PASSWORD************************/
/*Look for password in db_conn.php file*/

/**********************************END PASSWORD*******************/
$school = $_POST['school'];
$e_mail = $_POST['e_mail'];
$phone = $_POST['phone'];
$post_id = $_POST['post_id'];
$submit = $_POST['submit'];
$w_link = $_POST['w_link'];
$delete = "1";

/**********Above, are the global variables.***********/

$table = "attendees";

/***********Above, are the Form variables************/

 // generate and execute query

$att_delete_query = "SELECT * FROM " . $table . " WHERE id= '$id'";//Just need to fix the query after I set up the table.


/***********End of functions and operators***************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Delete Attendee</title>
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


$att_delete_result = mysql_query($att_delete_query) or die(mysql_error());

/*MySQL query is made*/

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

$numofrows = @mysql_num_rows($att_delete_result);
echo '<h4>You are trying to delete record number: ';
echo $id;
echo ' from ';
echo $table;
echo '</h4>';
echo '<h1>This action is permanent!</h1>';

// if result is returned

// if ($numofrows == 1)
//
// {

  // turn it into an object

  $att_delete_row = mysql_fetch_object($att_delete_result);

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
 echo '<p><strong>Last Name: </strong>';
 echo $att_delete_row->last_name; 
 echo '</p>';
 echo "\n";

/*******First Name******/
echo '<p><strong>First Name: </strong>';
echo $att_delete_row->first_name;
echo '</p>';
 echo "\n";

/*******School / District Name******/
echo '<p><strong>School: </strong>';
echo $att_delete_row->school;
echo '</p>';
 echo "\n";

/*******e-Mail******/
echo '<p><strong>E-Mail: </strong>';
echo $att_delete_row->e_mail;
echo '</p>';
 echo "\n";

/*******Phone Number******/
echo '<p><strong>Phone Number: </strong>';
echo $att_delete_row->phone;
echo '</p>';
 echo "\n";
 /*******Workshop Name ->Invoice #******/
echo '<p><strong>Invoice #: </strong>';
echo $att_delete_row->invoice;
echo '</p>';
 echo "\n";
 /*******Workshop City******/
echo '<p><strong>City: </strong>';
echo $att_delete_row->w_city;
echo '</p>';
 echo "\n";
 /*******Workshop State******/
echo '<p><strong>State: </strong>';
echo $att_delete_row->w_state;
echo '</p>';
 echo "\n";
 /*******Workshop Date -> Zip******/
echo '<p><strong>Zip: </strong>';
echo $att_delete_row->zip;
echo '</p>';
 echo "\n";
 
 /*******Workshop Speaker -> Workshop******/
echo '<p>This person is signed up for: <br /><br /><strong>';

$my_query_current_workshop = "SELECT * FROM workshop WHERE ID = " . $att_delete_row->w_id;
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
echo '</strong><br /><br /><!-- See below if you need to change this.--></p>';
 echo "\n";
 echo '<input type="hidden" name="w_link" value= ';
 echo $workshop_row->ID;
 echo '>';
 
 
 
/*******Paid or Not******
echo '<p><input type="checkbox" name="payment" value="1" ';
if ($row->paid == 1)
 { 
 echo 'checked';
 }
 echo '><label><font size="-1">Payment Status</font></label></p>';
 echo "\n";
 
 /***********Workshop information query************

$my_query_workshop_id = "SELECT * FROM workshop WHERE year = 2008 AND season = 2 ORDER BY city ASC ";
$result_workshop_id = mysql_query($my_query_workshop_id) or die(mysql_error());
$numofrows_workshop_id = @mysql_num_rows($result_workshop_id);
 
/***********************Workshop List****************************/
/*
for($i = 0; $i < $numofrows_workshop_id; $i++){
$j=$i+1;
$row = @mysql_fetch_array($result_workshop_id);
echo("\n<input type=\"radio\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" /><label>" . "$j" . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; ". "$row[workshop_name]" . " &bull; " . "$row[wdate]" . ", " . "$row[speaker]" . "</label><br />");
}*/
echo '<p><input size="30" maxlength="250" type="password" name="password"'; 
 echo '><label><font size="-1"> Password</font></label></p>';
 echo "\n";
 
echo '<p><input type="Submit" name="submit" value="DELETE"></p>';

echo '</form>';

echo '</div>';

/****************************************************************/

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
/**For marketing purposes we will no longer delete people's entrees after they have cancelled their attendance at a workshop we will go ahead and keep their e-mail addresses for further advertizing.**/

$delete_query = "UPDATE attendees SET deleted = '$delete',  timestamp = NOW() WHERE id = '$post_id'";

//$delete_query = "DELETE FROM attendees WHERE id = '$post_id' LIMIT 1";

$delete_result = mysql_query($delete_query) or die ("Error in query: $query. " . mysql_error());
  /***************Below are the e-mail variables***********
$to = $e_mail;
$subject = "IMPORTANT: Loose in the Lab workshop attendance confirmation for $f_name $l_name ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Loose in the Lab Workshop Coordinator <workshops@looseinthelab.com>' . "\r\n";
/*******************************************************
  /****************Confirmation e-Mail is being created*********************
//$confirmation_e_mail_q = "SELECT * FROM attendees WHERE ID=(SELECT MAX(ID) FROM attendees) AND e_mail = '$e_mail' ";
//$confirmation_result = mysql_query($confirmation_e_mail_q) or die ("Error in query: $confirmation_e_mail_q. " . mysql_error());
//$numofrows = @mysql_num_rows($confirmation_result);
//$row = @mysql_fetch_array($confirmation_result);

$message = <<<EOMESSAGE
<p>This is an e-mail to confirm that $f_name $l_name has been removed from our workshop in $w_city, $w_state. </p>
EOMESSAGE;
mail($to, $subject, $message, $headers);
  /*************************************************************************/
  
echo "<font size=-1>You have successfully deleted this attendee. <a href=workshop_db.php?order=last_name&list=contact&workshop=" . $w_link . "&submit=Go>Go back to the main list. </a></font>";


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
