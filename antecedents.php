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
    // echo "user : ".isset($_SESSION['user'])?$_SESSION['user']:"null";
    // echo "sel_user : ".isset($_GET['sel_user'])?$_GET['sel_user']:"null";
    // echo "antc : ".isset($_GET['antc'])?$_GET['antc']:"null";
    // echo "login : ".isset($_GET['login'])?$_GET['login']:"null";

    if(isset($_GET['sel_user'])){ // Si on a sélectionné un utilisateur à visualier/modifier
        $selected_user = $entityManager->getRepository('User')->find($_GET['sel_user']);
    }

    if(isset($_GET['antc'])){ // On a envoyé une modification
        $selected_user = $entityManager->getRepository('User')->find($_GET['login']);
        if($selected_user == null) echo "c'est null !!!!!!";
    }
    else

    if(!isset($_SESSION['user'])){ // Si l'utilisateur n'est pas connecté
    	echo "<h1>Vous devez être connecté pour accéder à cette page !</h1>";
    }
    else {  // Si il est connecté
    $user = $_SESSION['user'];
    		
    ?>
        <h1>Modification des antécédants médicaux : </h1>
        <p>Connecté en tant que : <?php echo $user ?> => <a href='./logout.php'>Déconnexion</a></p>
        <form method='GET' action='./antecedents.php'>
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
        <br><br>
        <form method="GET" action="./antecedents.php">
            <label>Antécédents de <?php if(isset($selected_user)) echo $selected_user->login; ?> :</label>
            <input type="text" name="antc" value=<?php if(isset($selected_user)) echo "'".$selected_user->dossier->antc."'"; if($user != 'medecin') echo "disabled"; ?> ></value>
            <input type="hidden" name="login" value=<?php if(isset($selected_user)) echo "'".$selected_user->login."'"; ?> />
            <?php if($user == 'medecin') echo "<input type='submit' />"; else echo "<br>Vous n'avez pas le droit de modifier les antécédants médicaux"; ?>
        </form>
<?php	
}

    if(isset($_GET['antc'])){ // On a envoyé une modification
        $selected_user = $entityManager->getRepository('User')->find($_GET['login']);
        $selected_user->dossier->antc = $_GET['antc'];
        $entityManager->flush();

        echo "<p> Mise à jour réussie ! <a href='./accueil.php'>Revenir à l'accueil</a></p>";
    }
?>
    
        
    </body>
</html>