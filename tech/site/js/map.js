
$(function() {
	var lat =50.433;
	var lon = 2.8279;
	var map = null;
	var infos=null;
	// Fonction d'initialisation de la carte
	function initMap() {
		// Créer l'objet "map" et l'insèrer dans l'élément HTML qui a l'ID "map"
		map = new google.maps.Map(document.getElementById("map"), {
			// Nous plaçons le centre de la carte avec les coordonnées ci-dessus
			center: new google.maps.LatLng(lat, lon), 	
			// Nous définissons le zoom par défaut
			zoom: 10, 
			// Nous définissons le type de carte (ici carte routière)
			mapTypeId: google.maps.MapTypeId.ROADMAP, 	
			// Nous activons les options de contrôle de la carte (plan, satellite...)
			mapTypeControl: true,
			// Nous désactivons la roulette de souris
			scrollwheel: false, 
			mapTypeControlOptions: {
				// Cette option sert à définir comment les options se placent
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR 
			},
			// Activation des options de navigation dans la carte (zoom...)
			navigationControl: true, 
			navigationControlOptions: {
				// Comment ces options doivent-elles s'afficher
				style: google.maps.NavigationControlStyle.ZOOM_PAN 
			}
		});
	}
	$.ajax({
		url : "recupInfos.php",
	}).done(function(json){ 
		window.infos = JSON.parse(json);
		initMap();
		for(adresse in window.infos){
			var marker = new google.maps.Marker({
				// parseFloat nous permet de transformer la latitude et la longitude en nombre décimal
				position: {lat: parseFloat(window.infos[adresse][0].latitude), lng: parseFloat(window.infos[adresse][0].longitude)},
				title: adresse,
				map: map
			});	
			
			google.maps.event.addListener(marker,'click', function() {
				$("#titre").html(this.title);
				$("#Stock").html("Stock :");
				$.ajax({
					url : "recupInfos.php",
				}).done(function(json){ 
					window.infos = JSON.parse(json);
					console.log(window.infos);
				});
				for(var i=0;i<6;i++){
					if(i<window.infos[this.title].length){
						$("label.poid"+i.toString()).html(window.infos[this.title][i].poid+"&nbsp;"+"grammes");
						$("label.aliment"+i.toString()).html(window.infos[this.title][i].aliment+' :'+"&nbsp;");
					}else{
						$("label.poid"+i.toString()).html("");
						$("label.aliment"+i.toString()).html("");
					}
				}
			});
		}
	});
	
});