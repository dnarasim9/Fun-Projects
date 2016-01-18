	<html>
	<head>
		<title>Weather Forecast</title>

		<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

		<style type="text/css">

			#container {
				margin: 0 auto;
				width: 300px;				
			}

			label{		    
			    float: left;
			    clear: left;
			    width: 255px;
			    text-align: left;
			}

			.field {					
				float: right;			
			}

			select {
				float: right;
				width: 149px;
			}

			#submitfield {
				margin-left: 105px;
			}

			#forecastlink {
				margin-left: 110px;
			}

			#heading {
				margin: 0 auto;
				width: 200px;
				padding-left: 78px;
			}

			form {
				padding-left: 20px;
				padding-top: 15px;
				width: 300px;
				border: 3px solid black;
				margin-top: 8px;
			}

			table {
				margin: 0 auto;
				width: 395px;
				border: 3px solid black;
				padding-left: 18px;
				padding-right: 10px;
				margin-left: 485px;			
			}

			table th {
				padding-right: 40px;
			}

		</style>

		<script type="text/javascript">

			function formValidate() {
				var address_filled = city_filled = state_filled = false; 

				var blank="";

				var re=/^[a-zA-Z ]+$/;

			         if (document.myform.address.value != blank) address_filled=true; 

			         if (document.myform.city.value != blank) {
			         	if (!re.test(myform.city.value)) {
			         		alert("'City' field can only contain alphabets");
			         	}
			         	else {
			         		city_filled=true; 
			         	}
			         }

			         if (document.myform.state.value != blank) state_filled=true; 
			         
					 if ( (address_filled) && (city_filled) && (state_filled) )  { 
					 		return(true); 
					 	} 

	                 else {
	         			var alertstring="Please enter valid value/s for:\n"; 
	         			if (!address_filled) alertstring=alertstring + "Street Address\n"; 
	         			if (!city_filled) alertstring=alertstring + "City\n"; 
	         			if (!state_filled) alertstring=alertstring + "State\n";
	         			alert(alertstring); 
	         			return(false); 
	         		} 
	         		
			}

			function clearform() {				
				//window.open('http://localhost/homework6.php','_self');
				document.getElementById("inputaddress").value="";
				document.getElementById("inputcity").value="";
				document.getElementById("inputstate").value="";				
				document.getElementById("inputdegreef").checked="true";
				document.getElementById("phpdiv").innerHTML="";
			}

		</script>

	</head>

	<body>

		<h3 id="heading">Forecast Search</h3>

		<div id="container">			

			<form id="form" name="myform" method="GET">
			
				<label>Street Address:* <input class="field" id="inputaddress" type="text" name="address" width="200px" align="right" /></label><br /> <br />
				<label>City:* <input class="field" id="inputcity" type="text" name="city" align="right" /></label><br /> <br />
				<label>State:* <select id="inputstate" name="state" align="right">
					<option value="">Select your state...</option>
	                    <option value="AL">Alabama</option>
	                    <option value="AK">Alaska</option>
	                    <option value="AZ">Arizona</option>
	                    <option value="AR">Arkansas</option>
	                    <option value="CA">California</option>
	                    <option value="CO">Colorado</option>
	                    <option value="CT">Connecticut</option>
	                    <option value="DE">Delaware</option>
	                    <option value="DC">District Of Columbia</option>
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
	            </label><br /><br />

	            <label>Degree:* &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" id="inputdegreef" name="degree" value="us" checked="true" />Fahrenheit
	           	<input type="radio" id="inputdegreec" name="degree" value="si" <?php if(isset($_GET["submit"])) if($_GET["degree"] =='si') echo "checked"; ?> />Celsius</label><br /><br />	            

	            <span id="submitfield" ><input type="submit" name="submit" value="Search" onclick="formValidate(this.form)" />
	            <input type="button" value="Clear" onclick="clearform()" /></span><br />

	            <p>* - <i>Mandatory fields.</i></p>

	            <p id="forecastlink"><a href="http://forecast.io/" target="_blank">Powered by Forecast.io </a></p>	            
				
			</form>

			<br />

			<script type="text/javascript">

					document.getElementById('inputaddress').value = "<?php echo $_GET['address'];?>";
					document.getElementById('inputcity').value = "<?php echo $_GET['city'];?>";
					document.getElementById('inputstate').value = "<?php echo $_GET['state'];?>";					
					
			</script>

		</div>

	</body>
	</html>

	<html>
	<body>

		<div id="phpdiv">	

		<?php

			ini_set('display_errors', 'Off');

		    $address = $_GET["address"];
		    $city = $_GET["city"];
		    $state = $_GET["state"];
		    $degree = $_GET["degree"];

		    if(!empty($address) && (!empty($city)) && ($state!="")) {
		    	$YOUR_API_KEY = "AIzaSyCV6oXSJR-Ciq2COngvL-Q-IUVf5dK91X0";
		        $url = "https://maps.google.com/maps/api/geocode/xml?address=".urlencode($address).",".urlencode($city).",".urlencode($state)."&key=".$YOUR_API_KEY;
		        //echo $url;

		        $result = simplexml_load_file($url);        
		        
		        $lat = $result->result->geometry[0]->location->lat;
		        $lng = $result->result->geometry[0]->location->lng;
		        //echo $lat;        
		       	//echo $lng;

		       	$url2 = "https://api.forecast.io/forecast/00197840e92740a03db25e4a6c08ea31/".$lat.",".$lng."?units=".$degree."&exclude=flags";		    	
		    	//echo $url2; 	

		    	$json = file_get_contents($url2);
		    	$data = json_decode($json, true);
		    	//echo '<pre>' . print_r($data, true) . '</pre>';

		    	if ($degree=='us') {
		    		$degreeNotation = "F";
		    		$precipitationValue = $data['currently']['precipIntensity'];		    		
		    		$visibilityValue = $data['currently']['visibility'];
		    		$visibility = round($visibilityValue).' '.'mi';		    		
		    		$dewPointValue = $data['currently']['dewPoint'];
		    		$dewPoint = round($dewPointValue).'&deg;'." ".$degreeNotation;
		    		$windSpeedValue = $data['currently']['windSpeed'];
		    		$windSpeed = round($windSpeedValue).' '.'mph';
		    	}

		    	else if ($degree=='si') {
		    		$degreeNotation = "C";
		    		$precipitationValue = $data['currently']['precipIntensity'];
		    		$precipitationValue = $precipitationValue*0.0393701;		    		
		    		$visibilityValue = $data['currently']['visibility'];		    		
		    		$visibility = $visibilityValue*0.621371;
		    		$visibility = round($visibility).' '.'mi';	    		
		    		$dewPointValue = $data['currently']['dewPoint'];
		    		$dewPoint = round($dewPointValue).'&deg;'." ".$degreeNotation;
		    		$windSpeedValue = $data['currently']['windSpeed'];		    		
		    		$windSpeed = $windSpeedValue*2.23694;
		    		$windSpeed = round($windSpeed).' '.'mph';
		    	}

		    	$weatherCondition = $data['currently']['summary'];

		    	$weatherTemperatureValue = $data['currently']['temperature'];
		    	$weatherTemperature = round($weatherTemperatureValue).'&deg;'." ".$degreeNotation;

		    	$weatherIcon = $data['currently']['icon'];		    	

		    	$rainProbabilityValue = $data['currently']['precipProbability'];
		    	$chanceOfRain = $rainProbabilityValue*'100'.'%';		    	

		    	$humidityValue = $data['currently']['humidity'];
		    	$humidity = $humidityValue*'100'.'%';		    	

		    	$daily=$data['daily'];
				$dailydata=$daily['data'];
		    	$timezone=$data['timezone'];
				date_default_timezone_set($timezone);
				$time=$dailydata[0];

				$sunrise=date('h:i A',$time['sunriseTime']);
				$sunset=date('h:i A',$time['sunsetTime']);

				//$sunriseValue = $data['daily']['data'][0]['sunriseTime'];
		    	//$sunsetValue = $data['daily']['data'][0]['sunsetTime'];
				//$sunrise=strftime("%I:%M %p",$sunriseValue);
				//$sunset=strftime("%I:%M %p",$sunsetValue);

		    	if ($weatherIcon=='clear-day') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/clear.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='clear-night') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/clear_night.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='rain') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/rain.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='snow') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/snow.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='sleet') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/sleet.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='wind') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/wind.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='fog') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/fog.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='cloudy') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/cloudy.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='partly-cloudy-day') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/cloud_day.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	else if ($weatherIcon=='partly-cloudy-night') {
		    		$icon = "<img src='http://cs-server.usc.edu:45678/hw/hw6/images/cloud_night.png' title='$weatherCondition' alt='$weatherCondition' />";
		    	}

		    	if ($precipitationValue>=0 && $precipitationValue<0.002) {
		    		$precipitation = "None";
		    	}

		    	else if ($precipitationValue>=0.002 && $precipitationValue<0.017) {
		    		$precipitation = "Very Light";
		    	}

		    	else if ($precipitationValue>=0.017 && $precipitationValue<0.1) {
		    		$precipitation = "Light";
		    	}

		    	else if ($precipitationValue>=0.1 && $precipitationValue<0.4) {
		    		$precipitation = "Moderate";
		    	}

		    	else if ($precipitationValue>0.4) {
		    		$precipitation = "Heavy";
		    	}  

		    	$resultsTable = '<table>';
		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '<th>'.$weatherCondition.'</th>';		    	
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '<th>'.$weatherTemperature.'</th>';		    	
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '<th>'.$icon.'</th>';		    	
		    	$resultsTable .= '<th>'.'</th>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Precipitation:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$precipitation.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Chance of Rain:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$chanceOfRain.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Wind Speed:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$windSpeed.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Dew Point:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$dewPoint.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Humidity:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$humidity.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Visibility:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$visibility.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Sunrise:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$sunrise.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .= '<tr>';
		    	$resultsTable .= '<td>'.'Sunset:'.'</td>';
		    	$resultsTable .= '<td>'.'</td>';		    	
		    	$resultsTable .= '<td>'.$sunset.'</td>';
		    	$resultsTable .= '</tr>';

		    	$resultsTable .='</table>';
		    	print $resultsTable;

		    }
	 	?>

	 	</div>

	 </body>
	 </html>





	 

	 
	 
