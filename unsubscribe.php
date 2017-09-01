<?php

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$state = $_POST['state'];
$table = "e_mails_" . "$state";
$email = $_POST['unsubscribe_email'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Unsubscribe from Loose in the Lab's e-mail database.</title>
<style type="text/css">
<!--
div {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #333333;
	background-color: #FFFFCC;
	width: 420px;
	margin-right: auto;
	margin-left: auto;
	padding: 10px;
	border: 1px solid #333333;
	margin-top: 100px;
}
-->
</style>
</head>

<body>
<?php
if (!$_POST['submit']) {
?>
<div><form id="unsubscribe" name="unsubscribe" method="post" action="<?php echo $thispage; ?>"><label><select tabindex="4" name="state">
<option selected="selected" value="">Choose Your State</option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DC">D.C.</option>
<option value="DE">Delaware</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
</select> 
What state are you in?</label><br /><br /><label><input name="unsubscribe_email" type="text" size="30" maxlength="60" /> e-Mail Address</label><p><input type="submit" name="submit" id="submit" value="Submit" /></p></form></div><?php
}
else {
$e_mail_confirmation_query = "SELECT * FROM $table WHERE e_mail = '$email'";
$e_mail_confirmation_result = mysql_query($e_mail_confirmation_query) or die(mysql_error());
$e_mail_confirmation_numofrows = mysql_num_rows($e_mail_confirmation_result);
$e_mail_confirmation_row = mysql_fetch_array($e_mail_confirmation_result);
if (!$e_mail_confirmation_row[ID]) {

?>
<div>
  <p>I'm sorry. This e-mail was not found in our system. You chose <strong><?php echo "$state"; ?></strong> as your state. Please check if you chose the correct state and/or e-mails address.</p>
  <p>Keep in mind, if your e-mail address has recently changed, we may have an older version of it which may forward our communication to your new one.</p>
  <form id="unsubscribe" name="unsubscribe" method="post" action="<?php echo $thispage; ?>"><label><input name="unsubscribe_email" type="text" size="30" maxlength="60" value="<?php echo "$email"; ?>" /> e-Mail Address</label><input type="hidden" name="state" value="<?php echo "$state"; ?>" /><p><input type="submit" name="submit" id="submit" value="Submit" /></p></form></div>
<?php
}
else {
$unsubscribe_query = "UPDATE looselabwork.$table SET subscribed = 1 WHERE $table.ID = $e_mail_confirmation_row[ID] LIMIT 1";
$unsubscribe_query_result = mysql_query($unsubscribe_query) or die(mysql_error());
?>
<div><p>You have been successfully unsubscribed.</p></div>
<?php
}
}

?>
<script type="text/javascript" src="../sites/default/files/js/js_50c1725c7e2d76fbe790394d47c7be19.js"></script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
//--><!]]>
</script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
try{var pageTracker = _gat._getTracker("UA-7200880-3");pageTracker._trackPageview();} catch(err) {}
//--><!]]>
</script>
</body>
</html>
