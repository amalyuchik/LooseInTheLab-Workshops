<?php
/**********************************************/

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wkshp-insrt-frm.php');
include($_SERVER['DOCUMENT_ROOT'].'/workshops/workshop_hotel_variables.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Loose in the Lab | Add New Workshop</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body><main style="margin-left:20px; margin-right:20px;">
<?php
if (!$_POST['submit']) {
echo $wkshp_insrt_frm;
echo "<strong>Speaker:</strong><br /><br /><select name=\"speaker\" id=\"day\"><option selected=\"selected\" value=\"\">Choose a Speaker</option>";
for($i = 0; $i < $numofrows_speaker_query; $i++){
$s_name_row = mysql_fetch_array($result_speaker_query);
echo '<option value=';
echo "\"$s_name_row[s_name]\"";
echo '>';
echo "$s_name_row[s_name]";
echo '</option> ';
}

echo "</select><p><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" /></p></form>";
}

/*****************************Second Part of the Form (After the Button has been pressed)*********************************/
else {

$my_fill_query_wkshp = "INSERT INTO workshop (ID , season , year , state , city , workshop_name , wdate , speaker , cancelled , link ) VALUES ( '' , '$w_i_season' , '$w_i_year' , '$w_i_state' , '$w_i_city' , '$w_i_workshop_name' , '$w_i_date' , '$w_i_speaker' , '$w_i_cancelled' , '$w_i_link')";
 
  $wkshp_fill_result = mysql_query($my_fill_query_wkshp) or die ("Error in query: $my_fill_query_wkshp. " . mysql_error());
  // print result
  
  //Woo Hoo, Attendant has been added
  
  echo '<p>The following workshop has been added to the database: <br />';
  echo $w_i_workshop_name . ', in ' . $w_i_city . ', ' . $w_i_state . ' on: ' . $w_i_date ;
  echo '</p>';
  echo $wkshp_insrt_frm;
  echo "<strong>Speaker:</strong><br /><br /><select name=\"speaker\" id=\"day\"><option selected=\"selected\" value=\"\">Choose a Speaker</option>";
for($i = 0; $i < $numofrows_speaker_query; $i++){
$s_name_row = mysql_fetch_array($result_speaker_query);
echo '<option value=';
echo "\"$s_name_row[s_name]\"";
echo '>';
echo "$s_name_row[s_name]";
echo '</option> ';

}
echo "</select><p><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" /></p></form>";
} 

?>
</main></body>
</html>
