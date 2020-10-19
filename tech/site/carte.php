<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mes distributdeurs</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    	<link rel="stylesheet" href="css/map.css">
		<link rel="stylesheet" media="screen and (max-width: 1280px)" href="css/mapTel.css" />
	</head>
	<body>
			<h1 >Mes distributeurs</h1>
			<div class="grid">
				<div class="infos" >

				<h3 id='titre'>Veuillez selectionner un marqueur sur la carte!</h3></br>
				<label id="Stock"></label></br>
				<label class="aliment0"></label><label> </label><label class="poid0"></label></br>
				<label class="aliment1"></label><label class="poid1"></label></br>
				<label class="aliment2"></label><label class="poid2"></label></br>
				<label class="aliment3"></label><label class="poid3"></label></br>
				<label class="aliment4"></label><label class="poid4"></label></br>
				<label class="aliment5"></label><label class="poid5"></label>
				</div>
				
				<div class="map" id="map" ></div>
			</div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyAU03Nrfs9sIVX7SLbZB9pdPX0zgYZXphQ" type="text/javascript"></script>
		<script src="js/map.js" async type="text/javascript"></script>
	</body>
</html>