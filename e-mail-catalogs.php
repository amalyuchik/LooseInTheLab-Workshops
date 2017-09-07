<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/db_conn.php');
//$city = $_GET['cities'];
//$wname = $_GET['w_name'];
//$order = $_GET['order'];
//$list = $_GET['list'];
//$last_name = $_GET['last_name'];
//$first_name = $_GET['first_name'];
//$payment = $_POST['payment'];
//$pay_id = $_POST['pay_ID'];

/**********Above, are the global variables.***********/
$table = 'catalog_requests_imported';

/***********Above, are the Form variables************/

$cat_my_query = "SELECT DISTINCT e_mail FROM catalog_requests_imported ";//Just need to fix the query after I set up the table.

$link = @mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/

$cat_result = mysql_query($cat_my_query) or die(mysql_error());

/*MySQL query is made*/
$cat_numofrows = @mysql_num_rows($cat_result);

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Marketing e-mail</title>
</head>

<body><a href="mailto:
<?php
//echo '';
for($i = 0; $i < $cat_numofrows; $i++) 
	{
$row = @mysql_fetch_array($cat_result);
if ($row[e_mail] != 'null') {
	echo ("$row[e_mail]" . ",\n");
	}
		}
//		else {
//	echo (",\n");
//		}
	
?>
?subject=IMPORTANT INFORMATION from Loose in the Lab. Home of Seriously Funny Science.">E-Mail Link. </a><p>Click this link to e-mail everyone who signed up for a catalog.</p><p>Total of <strong>
<?php
echo " $cat_numofrows ";
?>
</strong>e-mails will be sent using the link above.</p>
</body>
</html>
