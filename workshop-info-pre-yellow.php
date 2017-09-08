<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$d = date('Y-m-d');
$season_logic = date('n');

/**********Above, are the global variables.***********/

$table_city = 'workshop_cities';
$table_date = 'workshop_dates';
$table_w_name = 'workshop_names';

/***********Above, are the Form variables************/
if ($season_logic >= 1 && $season_logic < 5) {
$season = "1";
}
elseif ($season_logic >= 5 && $season_logic < 8) {
$season = "2";
}
elseif ($season_logic >= 8 && $season_logic < 13) {
$season = "3";
}
if (!$_GET['Choose']) {
$year = date('Y');
}
else {
$season = $_GET['season'];
$year = $_GET['year'];
}
/*************************Querie Variables*****************************************/

$my_query_workshop_id = "SELECT * FROM workshop WHERE year = $year AND season = $season AND cancelled = 0 ORDER BY city, wdate ASC ";

$link = mysql_connect($db_h, $db_u, $db_p) or die(mysql_error());

/*Connect variable $link created*/

mysql_select_db($db_n, $link) or die(mysql_error());

/*database is chosen*/
$result_workshop_id = mysql_query($my_query_workshop_id) or die(mysql_error());

/*MySQL query is made*/

$numofrows_workshop_id = mysql_num_rows($result_workshop_id);

/*$numofrows variable created to tell PHP how many rows are there in the query output*/

/***********End of functions and operators***************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Loose in the Lab | Workshop Info Query Page<?php 
if ($season == 1) {
print ' ---> For Winter/Spring ';
}
elseif ($season == 2) {
print ' ---> For Summer ';
}
elseif ($season == 3) {
print ' .: ---> For Fall/Winter ';
}
print $year;
print ' <--- :.';
?>
</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style type="text/css">
<!--
.init_form {
	font-family: Verdana, Myriad, Calibri, Helvetica, sans-serif;
	font-size: 14px;
	color: #333333;
	width: 650px;
}
.happened {
	color: #FFFFFF;
	background-color: #990000;
	text-align: left;
	font-size: 12px;
	font-weight: normal;
}
.gonnaHappen {
	background-color: #66FF99;
	text-align: left;
	font-weight: normal;
	}
@media print { .noPrint { display: none; } }
-->
</style>
</head>

<body>


 <?php
echo '<div class="init_form"><p class="noPrint" style="width:200px; float: none;">Please select a SEASON, YEAR and a City of the workshop.</p>';
?>

<form class="noPrint" method="get" action="<?php "$thispage" ?>" name="workshop_choice">
  <p>
    <label>
    <input type="radio" name="season" value="1" id="Season_0" />
     Winter/Spring</label>
    <br />
    <label>
    <input type="radio" name="season" value="2" id="Season_1" />
      Summer</label>
    <br />
    <label>
    <input type="radio" name="season" value="3" id="Season_2" />
      Fall/Winter</label>
    <br />
  </p>
  
  <select name="year" id="year">
    <option>2008</option>
    <option>2009</option>
    <option>2010</option>
    <option>2011</option>
  </select><br /><br />
  <input name="Choose" type="submit" value="Submit" />
</form>

<?php
if ($season == 1){
$last_season = $season + 2;
$next_season = $season + 1;
$last_year = $year - 1;
$next_year = $year;
}
elseif ($season == 2) {
$last_season = $season - 1;
$next_season = $season + 1;
$last_year = $year;
$next_year = $year;
}
elseif ($season == 3) {
$last_season = $season - 1;
$next_season = $season - 2;
$last_year = $year;
$next_year = $year + 1;
}
	echo '<p><a href="';
	echo 'http://www.seriouslyfunnyscience.com/workshops/workshop-info.php?season=' . "$next_season" . '&year=' . "$next_year" . '&Choose=Submit';
	echo '">Next Season</a></p>';
	echo '<p><a href="';
	echo "http://www.seriouslyfunnyscience.com/workshops/workshop-info.php";
	echo '">Current Season</a></p>';

	echo '<p><a href="';
	echo 'http://www.seriouslyfunnyscience.com/workshops/workshop-info.php?season=' . "$last_season" . '&year=' . "$last_year" . '&Choose=Submit';
	echo '">Previous Season</a></p>';
echo '<form id=selfrmtxt name="form_city" method="GET" action="workshop_db.php">';?>
<p class="noPrint">Sort By:</p><input class="noPrint" name="order" type="radio" value="last_name" checked /><label class="noPrint">Name</label><br /><input class="noPrint" name="order" type="radio" value="school" /><label class="noPrint">School</label><hr class="noPrint" />
<?php
/***********************list form****************************/


//  echo "$d";
  echo '<p class="noPrint">Choose the type of list you want to see: </p><input class="noPrint" name="list" type="radio" value="sign_in" checked /><label class="noPrint">Attendance</label><br /><input class="noPrint" name="list" type="radio" value="contact" /><label class="noPrint">Contact</label><hr class="noPrint" />';
  echo "<p style=\"width: 75px; display: block; padding: 3px; text-align: center;\" class=\"happened\">Happened</p><p style=\"width: 95px; display: block; padding: 3px; text-align: center;\" class=\"gonnaHappen\">Yet to Happen</p>";
echo "<table cellspacing=\"0\" width=\"750\">";
for($i = 0; $i < $numofrows_workshop_id; $i++){
$j = $i+1;
$row = mysql_fetch_array($result_workshop_id);
$count_query = "SELECT COUNT(*) FROM attendees WHERE w_id = " .$row[ID] ." AND deleted = 0";
$result_count = mysql_query($count_query) or die(mysql_error());
$count_row = mysql_fetch_row($result_count);
echo "\n<tr ";
if ($row[wdate] <= $d)
{
echo "class=\"happened\"";
}
else {
echo "class=\"gonnaHappen\"";
}
echo ("><div></td><td align=\"center\"> <a style=\"font-size:10px;\" href=\"http://www.seriouslyfunnyscience.com/workshops/workshops-hotel.php?workshop=" . "$row[ID]" . "\">Hotel</a> | <a style=\"font-size:10px;\" href=\"http://www.seriouslyfunnyscience.com/workshops/workshops-edit.php?workshop=" . "$row[ID]" . "\">Edit</a><td width=\"35px\" align=\"center\" border=\"0\"><strong>" . "$count_row[0]" . "</td><td>" . "<label>" . "<input class=\"noPrint\" type=\"radio\" name=\"workshop\" id=\"Workshop\" value=\"" . "$row[ID]" . "\" />" . "$j " . " &bull; " . "$row[city]" . ", " . "$row[state]" . " &bull; ". "$row[workshop_name]" . " &bull; ");
print date('M d, Y', strtotime($row['wdate']));
echo (", " . "$row[speaker]" . "</label>" . "</td></tr></div>");
}
echo "</table>";
/**Query below joins the two tables (attendees and workshop) and counts all the attendees which have "zero" in their deleted field and w_id field within range of the current season and year and not in a cancelled workshop.**/
$att_count_query = "SELECT COUNT(*) FROM attendees INNER JOIN workshop ON attendees.w_id=workshop.ID AND attendees.deleted=0 WHERE workshop.season = '$season' AND workshop.year = '$year' AND cancelled = 0";
$att_result_count = mysql_query($att_count_query) or die(mysql_error());
$att_count_row = mysql_fetch_row($att_result_count);
echo "<p>We have <strong style=\"color: #900000;\"> $att_count_row[0] </strong> attendees registered this season.</p>";
echo "<p>Average attendees per workshop: <strong style=\"color: #900000;\"> ";
$avg_att = $att_count_row[0]/$j;
$avg_round_off = round($avg_att, 2);
echo $avg_round_off;
echo " </strong> </p>";
	echo '<input style="float: none; " class="button" type="submit" name="submit" value="Go" />';
	echo '</form></div>';
?>
<h3 class="noPrint">This form is used to search the Attendees database using last and first names.</h3>

<form class="noPrint" action="workshop_db.php" method="GET" name="search">
<input name="last_name" type="text" size="20" maxlength="50" /><label>Last Name</label><br /><br />
<input name="first_name" type="text" size="20" maxlength="50" /><label>First Name</label><br /><br />
<input name="search" type="hidden" value="1" /><br /><br />
<input name="submit" type="submit" value="Search" />
  
</form>


</body>
</html>
