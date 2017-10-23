<?php
/**********************************************/

if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
require_once($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');

$city = $_GET['cities'];
$wname = $_GET['w_name'];
$order = $_GET['last_name'];
$list = $_GET['list'];
$payment = $_POST['payment'];
$pay_id = $_POST['pay_ID'];

/**********Above, are the global variables.***********/
$table = 'attendees';

/***********Above, are the Form variables************/

$my_query = "SELECT * FROM attendees";//Just need to fix the query after I set up the table.

$result = mysqli_query($link, $my_query) or die(mysqli_error($link));

/*MySQL query is made*/

$numofrows = mysqli_num_rows($result);

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Total records in the database.</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--<style type="text/css">

    h1 {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 2em;
        color: #333333;
        text-decoration: underline;
    }
    p {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 14px;
        color: #333333;
    }

    </style>-->

    <?php
    echo $bootstrapLink;
    echo $jQueryLink;
    echo $fontAwesomeLink;
    echo $cssLink;
    ?>
</head>

<body>
<div class="container">
    <section>
        <?php
        echo '<h1>There are ';
        echo $numofrows;
        echo ' records in the Attendees table.</h1>';
        ?>
        <p>
            <a href="http://www.seriouslyfunnyscience.com/workshops/workshop-info.php">Workshop attendance by city.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/workshop_db_fill.php">Add attendees to the database.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/workshop_db_fill_past.php">Add attendees to the database to the previous workshops.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/prepayment_coupon_generator.php">Print "Prepayment" coupons for each workshop</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/workshop_data.php">Workshop Details.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/workshops-add.php">Add a New workshop to the Database.</a><br />
            <a href="http://seriouslyfunnyscience.com/workshops/workshop_hotel_edit.php">View Existing Hotels and edit Hotel Information.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/hotel_data_fill.php">Add a New hotel to the Database.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/state_e-mail.html">e-Mail by State to our attendees.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/email/marketing-e-mail-form.html">Mass e-mail.</a><br />
            <!--<a href="http://www.seriouslyfunnyscience.com/workshops/e-mail1.php">Mass E-mail to all attendees of the workshops which have already happened.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/e-mail2.php">Mass E-mail to all attendees of the workshops which have NOT YET happened.</a><br />
            <a href="http://www.seriouslyfunnyscience.com/workshops/e-mail-catalogs.php">Mass E-mail to everyone who signed up to receive a catalog.</a>-->
        </p></section>
    <?php echo $navigation = new site_nav(); ?>
    <footer>
        <p><?php
            if (!$_SESSION)
            {}else {
                echo $_SESSION['user']->user_first_name . " " . $_SESSION['user']->user_last_name . " is logged in as " . $_SESSION['user']->username . ".";
                var_dump($_SESSION);
                echo session_id();
            }
            ?></p>
        <p>Copyright 2017 Loose in the Lab</p>
        <div id="testing"></div>
    </footer>
</div>
</body>
</html>
