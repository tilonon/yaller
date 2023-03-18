<?php
include('connexion_bdd.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de réservation de transport</title>
	<style>
		form {
			width: 500px;
			margin: auto;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 10px;
			background-color: #fff;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
			transition: box-shadow 0.3s ease-in-out;
		
		}
		form:hover {
			box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);
		}
		
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			transition: transform 0.3s ease-in-out;
		}
		label:hover {
			transform: scale(1.05);
		}
		
		select {
			width: 100%;
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
			transition: border-color 0.3s ease-in-out;
		}
		
		select:focus {
			border-color: #4CAF50;
			outline: none;
		}
		
		.checkboxes {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}
		
		.checkboxes {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}
		
		.checkboxes label {
			margin-right: 10px;
			transition: transform 0.3s ease-in-out;
		}
		
		.checkboxes label:hover {
			transform: scale(1.05);
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
		#la_forme{
			background-color: white;
		}
		body{
			background-color: #FF8C00;
		}
	</style>
</head>
<body>
	<form action="resultat.php" method="post" id="la_forme">
		<label for="localisation">Localisation :</label>

        <?php  
  
  $sql = "SELECT depart FROM itineraires";
  $result = mysqli_query($conn, $sql);

// Affichage des données dans une balise select

echo "<select name='localisation' >";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['depart'] . "'>" . $row['depart'] . "</option>";
}
echo "</select>";

// Fermeture de la connexion

?>

	<!--	<select id="localisation" name="localisation">
			<option value="">--Choisir une localisation--</option>
			<option value="Abidjan">Abidjan</option>
			<option value="Bouaké">Bouaké</option>
			<option value="Yamoussoukro">Yamoussoukro</option>
			<option value="Korhogo">Korhogo</option>
		</select>
		
		<label for="destination">Destination :</label>
		<select id="destination" name="destination">
			<option value="">--Choisir une destination--</option>
			<option value="Abidjan">Abidjan</option>
			<option value="Bouaké">Bouaké</option>
			<option value="Yamoussoukro">Yamoussoukro</option>
			<option value="Korhogo">Korhogo</option>
		</select> -->
        <label for="destination">Destination :</label>
        
  
  
  <?php  
  
  $sqll = "SELECT arrive FROM itineraires";
  $resultt = mysqli_query($conn, $sqll);

// Affichage des données dans une balise select

echo "<select name='destination'>";
while ($row = mysqli_fetch_assoc($resultt)) {
    echo "<option value='" . $row['arrive'] . "'>" . $row['arrive'] . "</option>";
}
echo "</select>";

// Fermeture de la connexion
mysqli_close($conn);
?>

		
		<div class="checkboxes">
			<label for="bus"><input type="checkbox" id="bus" name="transport" value="bus">Bus <span><img src="img/autobus.png" alt="" style="width: 60px;"></span></label>
			<label for="gbaka"><input type="checkbox" id="gbaka" name="transport" value="gbaka">Gbaka <span><img src="img/gbaka_icone.png" alt="" style="width: 90px;"></span></label>
			<label for="warren"><input type="checkbox" id="warren" name="transport" value="warren">Warren <span><img src="img/taxii.png" alt="" style="width: 60px;"></span></label>
		</div>
		
		<input type="submit" name="valider" value="Y-aller" class="btn" src="re">
	</form>
</body>
</html>
