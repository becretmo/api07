<?php
session_start();


require "./vendor/autoload.php";

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

    $login = htmlspecialchars($_POST['login']);
    $pwd = htmlspecialchars($_POST['pwd']);
		// if (isset($login) AND $login ==  "medecin" AND isset($pwd) AND $pwd ==  "medecin") // Si login et le mot de passe sont OK
  //   {
    // On affiche la page
    	if (isset($login) && $login ==  "medecin"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){

    			if(password_verify($_POST['pwd'], $user->password)){
    				$_SESSION['user'] = $user->login;
				
			
    		
    ?>
        <h1>Bienvenue Médecin ! <?php echo $_SESSION['user']; ?> </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<p> <a href="./vaccinations.php">Vaccinations</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>

		
        <?php
    		}
    		else echo "erreur !";
    	}
    	else echo "utilisateur inconnu !";
    }
	// else if (isset($login) AND $login ==  "infirmiere" AND isset($pwd) AND $pwd ==  "infirmiere") {
    elseif (isset($login) && $login ==  "infirmiere"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){
    			if(password_verify($pwd, $user->password)){
    				$_SESSION['user'] = $user;
	?>
		<h1>Bienvenue Infirmière ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>
		<?php
			}
		}
	}
	// else if (isset($login) AND $login ==  "employe" AND isset($pwd) AND $pwd ==  "employe") {
	elseif (isset($login) && $login ==  "employe"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){
    			if(password_verify($pwd, $user->password)){
    				$_SESSION['user'] = $user;
		?>
		<h1>Bienvenue Employé ! </h1>
		<p> <a href="./etat_civil.php">Etat civil</a> </p>
		<p> <a href="./coordonnees.php">Coordonnées</a> </p>
		<p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
		<p> <a href="./vaccinations.php">Vaccinations</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>
		<?php
			}
		}
	}
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Login et/ou mot de passe incorrect !</p>';
    }
    ?>
    
        
    </body>
</html>