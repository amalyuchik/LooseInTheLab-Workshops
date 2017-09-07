<?php

include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/globals.php');
//include($_SERVER['DOCUMENT_ROOT'].'/workshops/workshop_hotel_variables.php');
include($_SERVER['DOCUMENT_ROOT'].'/workshops/wksp_includes/workshop_id_query.php');

$d = date('Y-m-d');

/**********Above, are the global variables.***********/


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add a hotel | Loose in the Lab</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
<!--
form {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: normal;
}
label {
    font-weight:normal;
}
-->
</style>
</head>

<body><main style="margin-left:20px; margin-right:20px;">
<?php
if (!$_POST['submit']) {
echo '<p><strong>Please fill out the form below to add a new hotel to the database.</strong></p>';
}
else {

$my_add_query_hotel = "INSERT INTO hotels (hotels_id , hotels_name , hotels_address , hotels_city , hotels_state , hotels_zip , hotels_position , hotels_contact , hotels_cat_phone , hotels_main_phone , hotels_fax , hotels_email , hotels_meet_room_price , hotels_meet_room_sq_ft , hotels_meet_room_max_sq_ft , hotels_sleep_room_price , hotels_danish , hotels_coffee , hotels_lav , hotels_parking , hotels_service_chrg , hotels_tax , hotels_link , hotels_dir_link , hotels_shipping_info , hotels_shipping_fee , hotels_notes ) VALUES ( '' , '$hotels_name' , '$hotels_address' , '$hotels_city' , '$hotels_state' , '$hotels_zip' , '$hotels_position' , '$hotels_contact' , '$hotels_cat_phone' , '$hotels_main_phone' , '$hotels_fax' , '$hotels_email' , '$hotels_meet_room_price' , '$hotels_meet_room_sq_ft' , '$hotels_meet_room_max_sq_ft' , '$hotels_sleep_room_price' , '$hotels_danish' , '$hotels_coffee' , '$hotels_lav' , '$hotels_parking' , '$hotels_service_chrg' , '$hotels_tax' , '$hotels_link' , '$hotels_dir_link' , '$hotels_shipping_info' , '$hotels_shipping_fee' , '$hotels_notes')";
 
  $hotel_add_result = mysql_query($my_add_query_hotel) or die ("Error in query: $my_add_query_hotel. " . mysql_error());
  // print result
  
  //Woo Hoo, Attendant has been added
  
  echo '<p>The following hotel has been added to the database: <br />';
  echo "$hotels_name" . '<br />' . "$hotels_address" . '<br />' . "$hotels_city" . ' ' . "$hotels_state" . ' , ' . "$hotels_zip" ;
  echo '</p>';

}
?>
<form id="hotels" name="hotel" method="post" action="<?php echo $thispage; ?>">
<label><input name="hotels_name" type="text" size="60" maxlength="60" /> Hotel Name</label>
<br />
<br />
<label><input name="hotels_address" type="text" size="60" maxlength="60" /> Hotel Address</label>
<br />
<br />
<label><input name="hotels_city" type="text" size="20" maxlength="20" /> City</label>&nbsp;&nbsp;&nbsp; 
<label><select tabindex="4" name="hotels_state">
<option selected="selected" value="">Choose a State</option>
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
State </label>&nbsp;&nbsp;&nbsp; <label><input name="hotels_zip" type="text" size="7" maxlength="5" /> Zip</label>&nbsp;&nbsp;&nbsp; <label><input name="hotels_position" type="text" size="10" maxlength="20" /> 
Hotel position in city (N, S, E, W, Center, Airport, etc...)</label>
<br />
<br />
<label>Front Desk Phone # <input name="hotels_main_phone" type="text" size="15" maxlength="25" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label>Catering Phone # <input name="hotels_cat_phone" type="text" size="15" maxlength="25" /> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label>Fax # <input name="hotels_fax" type="text" size="15" maxlength="25" /></label>
<br /><br /><label><input name="hotels_contact" type="text" size="30" maxlength="30" /> Hotel Contact</label>
 Name<br />
 <br /><label><input name="hotels_email" type="text" size="60" maxlength="150" /> Contact e-Mail</label>
 <br /><br /><label><input name="hotels_link" type="text" size="60" maxlength="255" /> Hotel website link</label>
  <br /><br /><label><input name="hotels_dir_link" type="text" size="60" maxlength="255" /> 
  Hotel directions / Google map link</label>
  <br /><br /><label>Meeting Room Size: <input name="hotels_meet_room_sq_ft" type="text" size="7" maxlength="5" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Max Size Meeting Room Available: 
  <input name="hotels_meet_room_max_sq_ft" type="text" size="7" maxlength="5" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <label>Meeting Room Price: <input name="hotels_meet_room_price" type="text" size="7" maxlength="5" /></label>
  <br /><br /><label>Sleeping Room Price: <input name="hotels_sleep_room_price" type="text" size="7" maxlength="5" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Danish Price: $<input name="hotels_danish" type="text" size="7" maxlength="5" /> /Dozen</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Coffee Price: $<input name="hotels_coffee" type="text" size="7" maxlength="5" /> /Gallon</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Lav. Price: $<input name="hotels_lav" type="text" size="7" maxlength="5" /></label>
  
  <br /><br /><label>Parking Fee: $<input name="hotels_parking" type="text" size="7" maxlength="5" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Service Charge: <input name="hotels_service_chrg" type="text" size="7" maxlength="5" /> %</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Sales Tax: <input name="hotels_tax" type="text" size="7" maxlength="5" /> %</label><br /><br />
  
  <textarea name="hotels_shipping_info" cols="35" rows="5"></textarea>
  
  Shipping information &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input name="hotels_shipping_fee" type="text" size="7" maxlength="5" /> Shipping Fees</label>
  <p>
    <label>
    <textarea name="notes" id="notes" cols="45" rows="5"></textarea> General Notes
    </label>
  </p>
  <p><input type="submit" name="submit" id="submit" value="Submit" /></p>
</form>
</main></body>
</html>
