<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
//$city = $_GET['cities'];
//$wname = $_GET['w_name'];
//$order = $_GET['order'];
//$list = $_GET['list'];
//$last_name = $_GET['last_name'];
//$first_name = $_GET['first_name'];
//$payment = $_POST['payment'];
//$pay_id = $_POST['pay_ID'];
$state = $_GET['state'];

/**********Above, are the global variables.***********/
$table = 'attendees';

/***********Above, are the Form variables************/

//$my_query = "SELECT DISTINCT e_mail FROM attendees WHERE w_date <= NOW() ";//Just need to fix the query after I set up the table.
if (!$state || $state == null) {
$my_query = "SELECT DISTINCT e_mail FROM attendees ORDER BY e_mail ASC"; }
else {
$my_query = "SELECT DISTINCT e_mail FROM attendees WHERE w_state = '$state' "; }

$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/

$result = mysql_query($my_query) or die(mysql_error());

/*MySQL query is made*/
$numofrows = @mysql_num_rows($result);

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Marketing e-mail</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body><main style="margin-left:20px; margin-right:20px;">
<p>
<?php
//echo '';
for($i = 0; $i < $numofrows; $i++) 
	{
$row = @mysql_fetch_array($result);
if ($row[e_mail] != 'null') {
	echo ("$row[e_mail]" . ",<br />\n");
	}
		}
//		else {
//	echo (",\n");
//		}
	
?>
</p><p>Total of <strong>
<?php
echo " $numofrows ";
?>
</strong>e-mails will be sent using the link above.</p>
</main></body>
</html>
