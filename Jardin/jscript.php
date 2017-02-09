
<?php
include('./partials/head.html');
include('./partials/navbar.php');
if (empty($pdo))
{
include("lepdo.php");
$pdo = lepdo::getPdo();

}
?>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="iso-8859-1">
        <title>Carte des jardins</title>
			
		<style>
			

			#map_canvas {
				height: 800px;
				width: 1200px;
				margin:50px auto;
			}
        </style>
		
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD66AjMws5qMvHwtkynsgTFrerjc9-zbZQ"></script>

        
        
        <script>
		
        function initialize() 
		{
			
			
            var mapOptions = 
			{
                zoom: 13,
                center: new google.maps.LatLng(43.296482,5.4),
                
            }
            var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			setMarkers(map);
		}
			
		function setMarkers(map)
		{
			var image = 'repere.jpg';

			<?php
				
				$lesjardins= $pdo->getTerrains();
				$cpt = 0;
				while ($enregistrement = $lesjardins->fetch(PDO::FETCH_OBJ)) {
				
			?>	
	
			var coord<?php echo($cpt);?> = new google.maps.LatLng(<?php echo($enregistrement->latitude);?>, <?php echo($enregistrement->longtitude);?>);	
			var infoWindow<?php echo($cpt);?> = new google.maps.InfoWindow();
			var marker<?php echo($cpt);?> = new google.maps.Marker
			({
				position: coord<?php echo($cpt);?>,
				map: map,
				animation: google.maps.Animation.DROP,
				icon: image
			});
			google.maps.event.addListener(marker<?php echo($cpt);?>, "click", function() {
			
				infoWindow<?php echo($cpt);?>.close();
				infoWindow<?php echo($cpt);?>.setContent
				(
					"<div id='boxcontent' style='font-family:Calibri'><strong style='color:green'>"
					+
					"</strong><br /><span style='font-size:12px;color:#333'>Hotel</span></div>"
					
				);
				infoWindow<?php echo($cpt);?>.open(map, this);
			});			
			
			<?php	
					$cpt++;
				}
			 		
			?>
		} //on ferme
        
        </script>
		
    </head>
	
    <body onload="initialize()">
        <div id="map_canvas"></div>
    </body>
</html>