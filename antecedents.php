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
        <title>Coordonnées</title>
    </head>
    <body>
    
    <?php

    if(!isset($_SESSION['user'])){
    	echo "<h1>Vous devez être connecté pour accéder à cette page !</h1>";
    }
    else {
    $user = $_SESSION['user'];
    		
    ?>
        <h1>Modification des coordonnées : </h1>
        <form method='POST' action='./coordonnes.php'>
        <label>Sélectionner un utilisateur :</label>
        <select name="sel_user">
        	<?php
        	$users = $entityManager->getRepository('User')->findAll();
        	foreach ($users as $u) {
        		echo "<option value='".$u->login."'>".$u->login."</option>";
        	}
        	?>
            </select>
        	<input type="submit" value="Valider" />
        </form> 
<?php	
}
?>
    
        
    </body>
</html>