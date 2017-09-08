<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
//include($_SERVER['DOCUMENT_ROOT'].'/global_variables.php');
//include($_SERVER['DOCUMENT_ROOT'].'/queries.php');
//Checks if there is a login cookie
if(isset($_COOKIE['ID_LooseInTheLab']))
{
    //if there is, it logs you in and directs you to the members page
    $username = $_COOKIE['ID_LooseInTheLab'];
    $pass = $_COOKIE['Key_LooseInTheLab'];
    $check = mysql_query("SELECT * FROM user_auth WHERE username = '$username'")or die(mysql_error());
    while($info = mysql_fetch_array( $check ))
    {
        if ($pass != $info['password'])
        {
            header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
        }
        else
        {
            header("Location: http://www.seriouslyfunnyscience.com/workshops/");

        }
    }
}

//if the login form is submitted
if (isset($_POST['submit']))
{ // if form has been submitted
    // makes sure they filled it in
    if(!$_POST['username'] | !$_POST['pass'])
    {
        die('You did not fill in a required field.');
    }
    // checks it against the database

    if (!get_magic_quotes_gpc())
    {
        $_POST['email'] = addslashes($_POST['email']);
    }
    $check = mysql_query("SELECT * FROM user_auth WHERE username = '".$_POST['username']."'")or die(mysql_error());

    //Gives error if user dosen't exist
    $check2 = mysql_num_rows($check);
    if ($check2 == 0)
    {
        die('That user does not exist in our database. Try again or contact <a href="mailto:andrei.malyuchik@gmail.com?subject=I need help registering on Loose in the Lab admin site.">Andrei.</a>');
    }
    while($info = mysql_fetch_array( $check ))
    {
        $_POST['pass'] = stripslashes($_POST['pass']);
        $info['password'] = stripslashes($info['password']);
        $_POST['pass'] = hash(sha256, $_POST['pass']."Add the following salt:".$info['user_email'], false);


        //gives error if the password is wrong
        if ($_POST['pass'] != $info['password'])
        {
            header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php?wp=1");
            //die('Incorrect password, please try again.');
        }
        else
        {
            // if login is ok then we add a cookie
            $_POST['username'] = stripslashes($_POST['username']);
            $hour = time() + 3600;
            setcookie(ID_LooseInTheLab, $_POST['username'], $hour);
            setcookie(Key_LooseInTheLab, $_POST['pass'], $hour);

            //then redirect them to the members area
            header("Location: http://www.seriouslyfunnyscience.com/workshops/");
        }
    }
}
else
{
// if they are not logged in
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php
    echo $bootstrapLink;
    echo $jQueryLink;
    echo $fontAwesomeLink;
    echo $cssLink;
    ?>
    <title>Loose in the Lab Admin Login</title>
</head>

<body>
<div class="form-group" style="width:320px; margin-top:50px; display:block; margin-left:auto; margin-right:auto;"><form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <table border="0">
            <tr><td colspan=2><h1>Loose in the Lab Admin Login</h1></td></tr>
            <tr><td>Username:</td><td>
                    <input type="text" name="username" <?php if ($_GET['wp'] == 1) { echo " class=\"login_failed\" ";} ?> maxlength="40">
                </td></tr>
            <tr><td>Password:</td><td>
                    <input type="password" name="pass" <?php if ($_GET['wp'] == 1) { echo " class=\"login_failed\" ";} ?> maxlength="50">
                </td></tr>
            <tr><td colspan="2" align="right">
                    <input type="submit" name="submit" value="Login">
                </td></tr>
        </table>
    </form></div>
<?php
}

?>

</body>
</html>