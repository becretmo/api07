<?php

require_once "./vendor/autoload.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page de connexion</title>
    </head>
    <body>
        <p>Veuillez entrer vos identifiants de connexion :</p>
        <form action="accueil.php" method="post">
            <p>
			<LABEL for="login"> Login : </label>
			<input type="text" name="login" />
			<LABEL for="pwd"> Mot de passe : </label>
            <input type="password" name="pwd" />
            <input type="submit" value="Se connecter" />
            </p>
        </form>
        <p>Cette page est réservée aux employés du service de la médecine du travail ! ;-)</p>
    </body>
</html>