<?php
   header("Access-Control-Allow-Origin: *");  
 ?>

<?php
	$address = "";
	$city = "";
	$state = "";
	$degree = "";

	if (isset($_GET["address"]) && !empty($_GET["address"])) {
		$address = urlencode($_GET["address"]);
	}

	if (isset($_GET["city"]) && !empty($_GET["city"])) {
		$city = urlencode($_GET["city"]);
	}

	if (isset($_GET["state"]) && !empty($_GET["state"])) {
		$state = urlencode($_GET["state"]);
	}

	if (isset($_GET["degree"]) && !empty($_GET["degree"])) {
		$degree = $_GET["degree"];
	}

	$geocodeAddress = $address . "," . $city . "," . $state;
	$geocodeApiKey = "AIzaSyCV6oXSJR-Ciq2COngvL-Q-IUVf5dK91X0";
	$geocodeApiUrl = "https://maps.googleapis.com/maps/api/geocode/xml?address=" . $geocodeAddress . "&key=" . $geocodeApiKey;

	$xmlDoc = new SimpleXMLElement($geocodeApiUrl, NULL, TRUE);
	if ($xmlDoc->status == "OK") {
		$lattitude = "";
		$longitude = "";

		$i = 0;
		foreach ($xmlDoc->result[0]->geometry[0]->location[0]->children() as $child) {
			if($i == 0) {$lattitude = $child;}
			if($i == 1) {$longitude = $child;}
			$i++;
		}

		$forecastApiKey = "00197840e92740a03db25e4a6c08ea31";

		$forecastApiUnitMeasure = "";

		if($degree == "Fahrenheit") {
			$forecastApiUnitMeasure = "us";
		}
		if($degree == "Celsius") {
			$forecastApiUnitMeasure = "si";
		}

		$forecastApiUrl = "https://api.forecast.io/forecast/" . $forecastApiKey . "/" . $lattitude . "," . $longitude . "?units=" . $forecastApiUnitMeasure . "&exclude=flags";

		$jsonobj = json_decode(file_get_contents($forecastApiUrl));

		echo json_encode($jsonobj);
	}
?>

