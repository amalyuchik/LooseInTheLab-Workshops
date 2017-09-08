<?php
/**********************************************/
if(!isset($_COOKIE['ID_LooseInTheLab'])){
    header("Location: http://www.seriouslyfunnyscience.com/workshops/login.php");
}
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
$d = date('Y-m-d');
$season_logic = date('n');

$w_id = $_GET['workshop'];
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/workshop_id_query.php');
include($_SERVER['DOCUMENT_ROOT'].'/workshops/workshop_hotel_variables.php');
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wkshp-insrt-frm.php');
$workshop_id = $_GET['workshop'];
//$w_update_season = 
//$w_update_year = 
//$w_update_state = 
//$w_update_wdate =
if (isset($_POST['submit'])){
    $edit_season = $_POST['season'];
    $edit_year = $_POST['year'];
    $edit_month = $_POST['month'];
    $edit_day = $_POST['day'];
    $edit_city = trim($_POST['city']);
    $edit_state = $_POST['state'];
    $edit_workshop_name = trim($_POST['w-name']);
    $edit_link = trim($_POST['link']);
    $edit_speaker_id_fk = $_POST['speaker_id_fk'];
}


/******************Workshop information invocation from database to pre-fill the form***************************/



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Loose in the Lab | Add New Workshop</title>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
    <?php echo $bootstrapLink;
    echo $jQueryLink;
    echo $fontAwesomeLink;?>
</head>

<body><main style="margin-left:20px; margin-right:20px;">
<?php
if (!$_POST['submit']) {
$w_update_query = "SELECT * FROM workshop WHERE ID = $workshop_id";
$w_update_result = mysql_query($w_update_query) or die ("Error in query: $w_update_query. " . mysql_error());
$w_update_row = mysql_fetch_array($w_update_result);

if ("$w_update_row[cancelled]" == 0) {
$cancel_status = 1;
}
else {
$cancel_status = 0;
}
if ("$cancel_status" ==1){
$delete_undelete = 'Delete';
}
else {
$delete_undelete = 'Undelete';
}
//echo "<p> This is a test: $cancel_status :L $w_update_row[cancelled]</p>";
    $checked = "checked=\"checked\"";
    ?>
<form id="workshop-add" name="workshop-add" action="http://www.seriouslyfunnyscience.com/workshops/workshops-edit.php?workshop=<?php echo $w_id; ?>" method="post">
<p><strong>Season:<?php echo $w_update_row['season']; ?></strong><br />
    <label>
    <input type="radio" name="season" value="1" id="season_0" <?php echo ($w_update_row['season'] == 1 ? $checked : ''); ?> />
      Spring (Jan - May)</label>
    <br />
    <label>
    <input type="radio" name="season" value="2" id="season_1" <?php echo ($w_update_row['season'] == 2 ? $checked : ''); ?> />
      Summer (Jun - Aug)</label>
    <br />
    <label>
    <input type="radio" name="season" value="3" id="season_2" <?php echo ($w_update_row['season'] == 3 ? $checked : ''); ?> />
      Fall (Sep - Dec)</label>
    <br />
  </p>
    <?php
    $month_selected = substr("$w_update_row[wdate]", -5, 2);
    $months_dropdown = new select_input($months_array,"Month","month",$month_selected);
    echo $dropdown = $months_dropdown->create_select_field(false);
    ?>
<p></p>
  
 </p>
  
  <strong>Day:</strong>
  <select class="form-control" style="width: 75px;" name="day" id="day">
  <option><?php echo substr("$w_update_row[wdate]", -2, 2); ?></option>
    <option>01</option>
    <option>02</option>
    <option>03</option>
    <option>04</option>
    <option>05</option>
    <option>06</option>
    <option>07</option>
    <option>08</option>
    <option>09</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
    <option>16</option>
    <option>17</option>
    <option>18</option>
    <option>19</option>
    <option>20</option>
    <option>21</option>
    <option>22</option>
    <option>23</option>
    <option>24</option>
    <option>25</option>
    <option>26</option>
    <option>27</option>
    <option>28</option>
    <option>29</option>
    <option>30</option>
    <option>31</option>
  </select>
  <br /><p>
  <p><strong>Year:</strong>
  <select class="form-control" style="width: 125px;" name="year" id="year"><option><?php echo substr("$w_update_row[wdate]", 0, 4); ?></option><option>2010</option><option>2017</option><option>2018</option><option>2019</option><option>2020</option><option>2021</option></select>
  <br />
 </p><strong>City:</strong><br />
  <input name="city" type="text" size="15" maxlength="26" value="<?php echo $w_update_row[city]; ?>" />
  <p><strong>State:</strong><br />
  <select class="form-control" style="width: 75px;" tabindex="4" name="state">
<option selected="selected" value="<?php echo "$w_update_row[state]"; ?>"><?php echo "$w_update_row[state]"; ?></option>
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
  <p><strong>Workshop Name:
  </strong>
    <br />
  <input name="w-name" type="text" size="26" maxlength="26" value=" <?php echo "$w_update_row[workshop_name]"; ?>" />
  <p><strong>Link (have to have this for automatic e-mails):</strong><br />
  <input name="link" type="text" size="50" maxlength="255" value=" <?php echo "$w_update_row[link]"; ?>" /></p>
  
 <?php
//echo $wkshp_insrt_frm;
//echo "<strong>Speaker:</strong><br /><br /><select class=\"form-control\" style=\"width: 250px;\" name=\"speaker\" id=\"day\"><option selected=\"selected\" value=\"\">Choose a Speaker</option>";
$speakers_array = array();
for($i = 0; $i < $numofrows_speaker_query; $i++){
$s_name_row = mysql_fetch_array($result_speaker_query);
//echo '<option value=';
//echo "\"$s_name_row[s_name]\"";
$speaker_detail = array("ID"=>"$s_name_row[ID]","data"=>$s_name_row[s_name]);
//echo '>';
//echo "$s_name_row[s_name]";
//echo '</option> ';
array_push($speakers_array,$speaker_detail);
}
?>
</select>

<?php
$speaker_selected = $w_update_row['speaker_id_fk'];
$speaker_dropdown = new select_input($speakers_array,"Speaker","speaker_id_fk",$speaker_selected);
echo $dropdown = $speaker_dropdown->create_select_field(false);
?><p><input type="submit" name="submit" id="submit" value="Submit" /></p></form>
<?php 
}

/*****************************Second Part of the Form (After the Button has been pressed)*********************************/
else {
$edit_date = "$edit_year-$edit_month-$edit_day";

$update_query_wkshp = "UPDATE workshop SET season = '$edit_season',wdate = '$edit_date',city = '$edit_city',state = '$edit_state',year = '$edit_year',workshop_name = '$edit_workshop_name',link = '$edit_link',speaker_id_fk = '$edit_speaker_id_fk',updated = '$current_date' where ID = $w_id";

$wkshp_update_result = mysql_query($update_query_wkshp) or die ("Error in query: $my_fill_query_wkshp. " . mysql_error());
  // print result
  
  echo '<p>The following workshop has been added to the database: <br />';
  echo $w_i_workshop_name . ', in ' . $w_i_city . ', ' . $w_i_state . ' on: ' . $w_i_date ;
  echo '</p>';
  

}

?>
<a href="http://www.seriouslyfunnyscience.com/workshops/workshop-edit-mark.php?workshop=<?php echo "$workshop_id". "&"; ?>cancelled=<?php echo "$cancel_status"; ?>"><?php echo "$delete_undelete"; ?></a>
</main></body>
</html>