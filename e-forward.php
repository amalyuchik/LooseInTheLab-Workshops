<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$e_mail_date = $_GET['dtid'];
$e_mail_state  = $_GET['stid'];
$e_forward_id = $_GET['fid'];
$forward_query = "SELECT * FROM e_mail_forward WHERE ID = $e_forward_id";
$forward_result = mysql_query($forward_query) or die ("Error in query: $my_fill_query_wkshp. " . mysql_error());
$forward_row = mysql_fetch_object($forward_result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Refresh" content="0;url=<?php echo $forward_row->url; ?>">

<title>Loose in the Lab | Add New Workshop</title>
</head>

<body>
<?php
$my_tracking_query_email = "INSERT INTO e_mail_tracking (ID , state , email_date , timestamp , fid ) VALUES ( '' , '$e_mail_state' , '$e_mail_date' , NOW() , '$e_forward_id' )";
 
$email_tracking_result = mysql_query($my_tracking_query_email) or die ("Error in query: $my_tracking_query_email. " . mysql_error());
?>
</body>
</html>
