<?php
/**
 * Created by IntelliJ IDEA.
 * User: amalyuchik
 * Date: 9/6/2017
 * Time: 12:29 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
//include($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');
//include($_SERVER['DOCUMENT_ROOT'].'/queries.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>User Registration</title>
</head>

<body>
<?php
//This code runs if the form has been submitted
if (isset($_POST['submit'])) {

//This makes sure they did not leave any fields blank
    if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
        die('You did not complete all of the required fields');
    }

// checks if the username is in use
    if (!get_magic_quotes_gpc()) {
        $_POST['username'] = addslashes($_POST['username']);
    }
    $usercheck = $_POST['username'];
    $check = mysql_query("SELECT username FROM user_auth WHERE username = '$usercheck'")
    or die(mysql_error());
    $check2 = mysql_num_rows($check);

//if the name exists it gives an error
    if ($check2 != 0) {
        die('Sorry, the username '.$_POST['username'].' is already in use.');
    }

// this makes sure both passwords entered match
    if ($_POST['pass'] != $_POST['pass2']) {
        die('Your passwords did not match. ');
    }

// here we encrypt the password and add slashes if needed
    $_POST['pass'] = hash(sha256, $_POST['pass']."Add the following salt:".$_POST['email'], false);
    //$_POST['pass'] = md5($_POST['pass']);
    if (!get_magic_quotes_gpc()) {
        $_POST['pass'] = addslashes($_POST['pass']);
        $_POST['username'] = addslashes($_POST['username']);
    }

// now we insert it into the database
    $insert = "INSERT INTO user_auth (username,user_first_name,user_last_name,user_email, password)
VALUES ('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."', '".$_POST['pass']."')";
    $add_member = mysql_query($insert);
    ?>
    <h1>Registered</h1>
    <p>Thank you, you have registered - you may now login</a>.</p>
    <?php
}
else
{
    ?>


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table border="0">
            <tr><td>First Name:</td><td>
                    <input type="text" name="firstname" maxlength="60">
                </td></tr>
            <tr><td>Last Name:</td><td>
                    <input type="text" name="lastname" maxlength="60">
                </td></tr>
            <tr><td>E-mail:</td><td>
                    <input type="text" name="email" maxlength="60">
                </td></tr>
            <tr><td>Username:</td><td>
                    <input type="text" name="username" maxlength="60">
                </td></tr>
            <tr><td>Password:</td><td>
                    <input type="password" name="pass" maxlength="50">
                </td></tr>
            <tr><td>Confirm Password:</td><td>
                    <input type="password" name="pass2" maxlength="50">
                </td></tr>
            <tr><th colspan=2><input type="submit" name="submit" value="Register"></th></tr> </table>
    </form>

    <?php
}


?>
</body>
</html>