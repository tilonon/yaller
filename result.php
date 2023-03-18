<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Résultats de formulaire</title>
    <link rel="stylesheet" href="leaflet.css">
	<!-- Fichiers JavaScript de Leaflet -->
	<script src="leaflet.js"></script>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<style>
        #map {
			height: 400px;
			width: 100%;
		}
		body {
			font-family: Arial, sans-serif;
			background-color: #f8f8f8;
			padding: 20px;
		}
		
		h1 {
			margin-top: 0;
		}
		
		.map {
			width: 100%;
			height: 400px;
			background-color: #eee;
			margin-bottom: 30px;
			border-radius: 10px;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
			overflow: hidden;
			position: relative;
		}
		
		.map img {
			width: 100%;
			height: auto;
			position: absolute;
			top: 0;
			left: 0;
			z-index: 0;
		}
		
		.map .marker {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background-color: #f00;
			z-index: 1;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
			transition: transform 0.3s ease-in-out;
		}
		
		.map .marker:hover {
			transform: scale(1.2) translate(-50%, -50%);
		}
		
		table {
			width: 100%;
			border-collapse: collapse;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
			margin-bottom: 30px;
		}
		
		table td, table th {
			padding: 10px;
			border: 1px solid #ccc;
			text-align: center;
		}
		
		table th {
			background-color: #4CAF50;
			color: white;
		}
		
		table tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		
		.btn {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			margin-top: 20px;
			transition: background-color 0.3s ease-in-out;
		}
		
		.btn:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
<div style="display:none" id="map"></div>
<script>
    function mapp(x,y){
        // Coordonnées de votre emplacement
        var myLatLng = L.latLng(x, y);

        // Création de la carte
        var map = L.map('map').setView(myLatLng, 15);

        // Ajout d'une couche de tuiles (tiles)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; OpenStreetMap contributors'
        }).addTo(map);

		document.getElementById('map').style.display='block';
        // Ajout d'un marqueur à l'emplacement
        L.marker(myLatLng).addTo(map)
            .bindPopup('Vous devez vous rendre là.')
            .openPopup();
    }
</script>

<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "babi";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
    die("connexion failed".mysqli_connect_error());
} 
// print_r($_POST["valider"]);
if(isset($_POST["valider"])){
    
    $depart = $_POST["localisation"];
    $arrive = $_POST["destination"];

    // Affiche les valeurs pour le débogage
    // echo "Depart : " . $depart . "<br>";
    // echo "Arrivee : " . $arrive . "<br>";

    $sql = "SELECT estimation_prix,duree,voiture_lat,voiture_lng,info FROM itineraires WHERE depart='".$depart."' AND arrive='".$arrive."';" ;
    $result = mysqli_query($conn,$sql);

    // Vérifiez s'il y a des résultats
    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><th>Estimation Prix</th><th>Durée</th><th>information</th><th>localisation</th></tr>";
    
        // Parcourez chaque ligne de résultats et affichez-les dans une ligne de tableau
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["estimation_prix"] . "</td><td>" . $row["duree"] . "</td><td>(directe) ".  $row["info"] .  "</td><td><a href='#' onclick='mapp(" . $row["voiture_lat"] . "," . $row["voiture_lng"] . ")'>map</a></td> ". "</tr>" ;
        }
        echo "<tr><td> 200fr </td><td> 2 minutes </td> <td> (décomposition mbadon-m'pouto) warren(voiture de couleur jaune) juste a côté de l'hotel de coquette</td> <td> map </td></tr> ";
        echo "<tr><td> 300fr </td><td> 10 minutes </td> <td> (décomposition m'pouto-9kilo) warren(voiture de couleur jaune) sur la grande route de m'pouto</td> <td> map </td></tr> ";
        
        // Fermez le tableau
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé.";
    }

}
?>

	<!-- <h1>Résultats de formulaire</h1>
	
	<div class="map">
		<img src="https://via.placeholder.com/1200x800.png?text=Carte+de+la+destination" alt="Carte de la destination">
		<div class="marker"></div>
	</div>
	
	<table>
		<thead>
			<tr>
				<th>Prix</th>
				<th>Durée du trajet</th>
                <th>Information</th>
                <th>Localisation</th>
            </tr>
        </thead>
    </table> -->
    
</body>
