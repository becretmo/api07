<?php
session_start();

require "./vendor/autoload.php";
require "./src/bootstrap.php";

require_once './model/user.php';
require_once './model/dossier.php';

function echo_erreur(){
    echo '<p>Login et/ou mot de passe incorrect !</p>';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Bienvenue</title>
    </head>
    <body>
    
    <?php

    if(isset($_POST['login'])) $login = htmlspecialchars($_POST['login']);
    if(isset($_POST['pwd'])) $pwd = htmlspecialchars($_POST['pwd']);

    if(isset($login)){
    	if ($login ==  "medecin"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){
    			if(password_verify($pwd, $user->password)){
    				$_SESSION['user'] = $user->login;
    		}
    		else echo_erreur();
    	}
    	else echo_erreur();
    }
    elseif ($login ==  "infirmiere"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){
    			if(password_verify($pwd, $user->password)){
    				$_SESSION['user'] = $user;
			}
            else echo_erreur();
        }
        else echo_erreur();
	}
	elseif ($login ==  "employe"){
    		$user = $entityManager->getRepository('User')->find($login);
    		if(!is_null($user)){
    			if(password_verify($pwd, $user->password)){
    				$_SESSION['user'] = $user;
			}
            else echo_erreur();
        }
        else echo_erreur();
	}
}

    //On affiche la vue correspondante :
    if($_SESSION['user'] == "medecin"){
        ?>
        <h1>Bienvenue Médecin ! </h1>
        <p> <a href="./etat_civil.php">Etat civil</a> </p>
        <p> <a href="./coordonnees.php">Coordonnées</a> </p>
        <p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
        <p> <a href="./vaccinations.php">Vaccinations</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>
        <?php
    }
    elseif($_SESSION['user'] == "infirmiere"){
        ?>
        <h1>Bienvenue Infirmière ! </h1>
        <p> <a href="./etat_civil.php">Etat civil</a> </p>
        <p> <a href="./coordonnees.php">Coordonnées</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>
        <?php
    }
    if($_SESSION['user'] == "employe"){
        ?>
        <h1>Bienvenue Employé ! </h1>
        <p> <a href="./etat_civil.php">Etat civil</a> </p>
        <p> <a href="./coordonnees.php">Coordonnées</a> </p>
        <p> <a href="./antecedents.php">Antécédents médicaux</a> </p>
        <p> <a href="./vaccinations.php">Vaccinations</a> </p>
        <p> <a href="./logout.php">Déconnexion</a> </p>
        <?php
    }
    ?>
        
    </body>
</html>