
<?php
include('./partials/head.html');
include('./partials/navbar.php');
if (empty($pdo))
{
include("./pdo/lepdo.php");
$pdo = lepdo::getPdo();

}


//var_dump($pdo->getTerrains());
?>

<html lang="fr">

	<head>
		<title>Tutoriel Google Maps</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<!-- Elément Google Maps indiquant que la carte doit être affiché en plein écran et
		qu'elle ne peut pas être redimensionnée par l'utilisateur -->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<!-- Inclusion de l'API Google MAPS -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD66AjMws5qMvHwtkynsgTFrerjc9-zbZQ&callback"></script>
		<script type="text/javascript">
			function initialiser() {
				
				//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
				//de définir des options d'affichage de notre carte
				var options = {
					  zoom: 10,
                                          center: new google.maps.LatLng(43.396482,5.4),
					  mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				//création du marqueur
                                    
				//constructeur de la carte qui prend en paramêtre le conteneur HTML
				//dans lequel la carte doit s'afficher et les options
				var carte = new google.maps.Map(document.getElementById("carte"), options);
                            
                                setMarqueur(carte);
                                
                                 }
                                 
                                 
                                
                                function setMarqueur(carte) {
                                    
                                    <?php
                                  $lesjardins= $pdo->getTerrains();
                                  $cpt = 0;
                                  
				  foreach ($lesjardins as $value) {
                                      
                                  
                                 ?>
                                    
                                var marqueur<?php echo($cpt);?> = new google.maps.Marker({
                                            position: new google.maps.LatLng(<?php echo($value['latitude']);?>, <?php echo($value['longtitude']);?>),
                                            map: carte,
                                            title: 'Marseille'
                                    });

                                var infowindow<?php echo($cpt);?> = new google.maps.InfoWindow({
                                  content: "<?php echo($value['nom_terrain']);?>"
                                });

                                
                                marqueur<?php echo($cpt);?>.addListener('click', function() {
                                  infowindow<?php echo($cpt);?>.open(carte, marqueur<?php echo($cpt);?>);
                                });
                                
                                <?php
                                $cpt++;
                                  }
                                ?>
                                    
			}
		</script>
	</head>

	<body onload="initialiser()">
		<div id="carte" style="width:100%; height:100%"></div>
	</body>
</html>
