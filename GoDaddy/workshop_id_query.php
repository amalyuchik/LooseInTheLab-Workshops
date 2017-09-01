<?php
$workshop_id_query = "SELECT * FROM workshop WHERE ID = '$w_id' ";
$workshop_q_result = mysql_query($workshop_id_query) or die(mysql_error());
$workshop_id_numofrows = @mysql_num_rows($workshop_q_result);
$workshop_q_row = mysql_fetch_object($workshop_q_result);
?>