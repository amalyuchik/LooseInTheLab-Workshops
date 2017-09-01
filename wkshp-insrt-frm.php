<?php 
$table_speaker_name = 'speaker_names';
$query_speaker_names = "SELECT * FROM $table_speaker_name ORDER BY s_name ASC";
$result_speaker_query = mysql_query($query_speaker_names) or die(mysql_error());
$numofrows_speaker_query = mysql_num_rows($result_speaker_query);

$wkshp_insrt_frm = <<<EOINSRTFRM
<form id="workshop-add" name="workshop-add" action="http://www.seriouslyfunnyscience.com/workshops/workshops-add.php" method="post">
<p><strong>Season:</strong><br />
    <label>
    <input type="radio" name="season" value="1" id="season_0" />
      Spring (Jan - May)</label>
    <br />
    <label>
    <input type="radio" name="season" value="2" id="season_1" />
      Summer (Jun - Aug)</label>
    <br />
    <label>
    <input type="radio" name="season" value="3" id="season_2" />
      Fall (Sep - Dec)</label>
    <br />
  </p>
  <p><strong>Month:</strong>
  <select name="month" id="month">
  <option selected="selected" value="">Month</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
  
 </p>
  
  <strong>Day:</strong>
  <select name="day" id="day">
  <option value="">Day</option>
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
  <select name="year" id="year"><option value="">Year</option><option>2010</option><option>2011</option><option>2012</option><option>2013</option><option>2014</option><option>2015</option><option>2016</option><option>2017</option><option>2018</option><option>2019</option><option>2020</option></select>
  <br />
 </p><strong>City:</strong><br />
  <input name="city" type="text" size="15" maxlength="26" />
  <p><strong>State:</strong><br />
  <select tabindex="4" name="state">
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
  <p><strong>Workshop Name:
  </strong>
    <br />
  <input name="w-name" type="text" size="26" maxlength="26" />
  <p><strong>Link (have to have this for automatic e-mails):</strong><br />
  <input name="link" type="text" size="50" maxlength="255" /></p>
EOINSRTFRM;
?>