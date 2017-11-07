<?php

/***************************************************************************************************************/
$workshop_id_query = "SELECT * FROM workshop WHERE ID = '$w_id' ";
$workshop_q_result = mysqli_query($link,$workshop_id_query) or die(mysql_error());
//$workshop_q_result = mysql_query($workshop_id_query) or die(mysql_error());
$workshop_id_numofrows = mysqli_num_rows($workshop_q_result);
$workshop_q_row = mysqli_fetch_object($workshop_q_result);
/********The above code is needed in workshops_db.php and workshops-edit.php files for the workshop name and date header line and to prefill the workshop edit form.**********/

/***************************************************************************************************************/
$hotel_id_query = "SELECT * FROM hotels WHERE hotels_state = '$workshop_q_row->state' AND hotels_city = '$workshop_q_row->city' ORDER BY hotels_city ASC, hotels_rating DESC ";
$hotel_q_result = mysqli_query($link,$hotel_id_query) or die(mysql_error());
$hotel_id_numofrows = mysqli_num_rows($hotel_q_result);
//$hotel_q_row = mysql_fetch_object($hotel_q_result);
/********The above code is needed in workshops-edit.php file to get all of the hotels for the given state to pair them up with the workshop.**********/

/***************************************************************************************************************/
$hotel_id_fk_query = "SELECT * FROM hotels WHERE hotels_id = '$workshop_q_row->hotels_id_fk' ORDER BY hotels_city ASC, hotels_rating DESC ";
$hotel_q_fk_result = mysqli_query($link,$hotel_id_fk_query) or die(mysql_error());
$hotel_id_fk_numofrows = mysqli_num_rows($hotel_q_fk_result);

/********The above code is needed in workshops-edit.php file to get all of the hotels for the given state to pair them up with the workshop.**********/

/****************************************************************************************************/
$hotels_name = $_POST['hotels_name'];
$hotels_address = $_POST['hotels_address'];
$hotels_city_post = $_POST['hotels_city_post'];
$hotels_state_post = $_POST['hotels_state_post'];
$hotels_zip = $_POST['hotels_zip'];
$hotels_main_phone = $_POST['hotels_main_phone'];
$hotels_cat_phone = $_POST['hotels_cat_phone'];
$hotels_contact = $_POST['hotels_contact'];
$hotels_email = $_POST['hotels_email'];
$hotels_link = $_POST['hotels_link'];
$hotels_dir_link = $_POST['hotels_dir_link'];
$hotels_meet_room_sq_ft = $_POST['hotels_meet_room_sq_ft'];
$hotels_meet_room_max_sq_ft = $_POST['hotels_meet_room_max_sq_ft'];
$hotels_meet_room_price = $_POST['hotels_meet_room_price'];
$hotels_sleep_room_price = $_POST['hotels_sleep_room_price'];
$hotels_danish = $_POST['hotels_danish'];
$hotels_coffee = $_POST['hotels_coffee'];
$hotels_lav = $_POST['hotels_lav'];
$hotels_parking = $_POST['hotels_parking'];
$hotels_service_chrg = $_POST['hotels_service_chrg'];
$hotels_tax = $_POST['hotels_tax'];
$hotels_shipping_info = $_POST['hotels_shipping_info'];
$hotels_shipping_fee = $_POST['hotels_shipping_fee'];
$hotels_fax = $_POST['hotels_fax'];
$hotels_position = $_POST['hotels_position'];
$hotels_notes = $_POST['notes'];

/**************The above code is used in the hotel insert form in hotel_data_fill.php file*************/
?>