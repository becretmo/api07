<?php
session_start();
require_once "./vendor/autoload.php";
require "./src/bootstrap.php";

require_once './model/user.php';
require_once './model/dossier.php';

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bienvenue</title>
    </head>
    <body>
    
    <?php
		// if (isset($_POST['login']) AND $_POST['login'] ==  "medecin" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "medecin") // Si login et le mot de passe sont OK
  //   {
    // On affiche la page
    	if (isset($_POST['login']) && $_POST['login'] ==  "medecin"){
    		$user = $entityManager->getRepository('User')->find($_POST['login']);
    		if(!is_null($user)){
    			if(password_verify($_POST['pwd'], $user->password)){
    				$_SESSION['user'] = $user->login;
				
			
    		
    ?>
        <h1>Bienvenue Médecin ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<p> <a href="./vaccinations.php">Vaccinations</a> </p>

		
        <?php
    		}
    		else echo "erreur !";
    	}
    	else echo "utilisateur inconnu !";
    }
	// else if (isset($_POST['login']) AND $_POST['login'] ==  "infirmiere" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "infirmiere") {
    elseif (isset($_POST['login']) && $_POST['login'] ==  "infirmiere"){
    		$user = $entityManager->getRepository('User')->find($_POST['login']);
    		if(!is_null($user)){
    			if(password_verify($_POST['pwd'], $user->password)){
    				$_SESSION['user'] = $user;
	?>
		<h1>Bienvenue Infirmière ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<?php
			}
		}
	}
	// else if (isset($_POST['login']) AND $_POST['login'] ==  "employe" AND isset($_POST['pwd']) AND $_POST['pwd'] ==  "employe") {
	elseif (isset($_POST['login']) && $_POST['login'] ==  "employe"){
    		$user = $entityManager->getRepository('User')->find($_POST['login']);
    		if(!is_null($user)){
    			if(password_verify($_POST['pwd'], $user->password)){
    				$_SESSION['user'] = $user;
		?>
		<h1>Bienvenue Employé ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<p> <a href="./vaccinations.php">Vaccinations</a> </p>
		<?php
			}
		}
	}
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Erreur inconnue mais on ne sait pas laquelle ...</p>';
    }
    ?>
    
        
    </body>
</html>