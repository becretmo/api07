<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bienvenue</title>
    </head>
    <body>
    
    <?php
		if (isset($_POST['login']) AND $_POST['login'] ==  "medecin" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "medecin") // Si login et le mot de passe sont OK
    {
    // On affiche la page
    ?>
        <h1>Bienvenue Médecin ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<p> <a href="./vaccinations.php">Vaccinations</a> </p>

		
        <?php
    }
	else if (isset($_POST['login']) AND $_POST['login'] ==  "infirmiere" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "infirmiere") {
	?>
		<h1>Bienvenue Infirmière ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<?php
	}
	else if (isset($_POST['login']) AND $_POST['login'] ==  "employe" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "employe") {
		?>
		<h1>Bienvenue Employé ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<?php
	}
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Mot de passe incorrect</p>';
    }
    ?>
    
        
    </body>
</html>