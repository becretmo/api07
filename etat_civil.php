<?php

session_start();
require_once './model/user.php';
require_once './model/dossier.php';
require_once "./vendor/autoload.php";
require "./src/bootstrap.php";
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Etat civil</title>
    </head>
    <body>
    	<?php
    	if(!isset($_SESSION['user'])){ // Si l'utilisateur n'est pas connecté
    		echo "<h1>Vous devez être connecté pour accéder à cette page !</h1>";
    	}
    	else {  // Si il est connecté
    		$user = $_SESSION['user'];
    	?>

    	<h1>Etat civil et coordonnées : </h1>
        <p>Connecté en tant que : <?php echo $user ?> => <a href='./logout.php'>Déconnexion</a></p>
    
    <?php
		//echo $_SESSION['user'];
    	if ($user ==  "medecin"){
    		$users = $entityManager->getRepository('User')->findAll();
	?>
			<form action="./etat_civil.php" method="POST" >
				<select id="selectbasic" name="selectbasic" class="form-control">
					<option value="0"> -- Sélectionner un employé -- </option>
					<?php				
						foreach ($users as $user) {
							echo "<option value='".$user->login."'>".$user->login." </option>";
						}				
					?>					
				</select>
				<INPUT TYPE="submit" NAME="valider" VALUE="valider"> 
			</form>
			<a href="./accueil.php">Retour</a> </p>
	<?php
			if(isset($_POST['selectbasic'])) {
				$seluser = $entityManager->getRepository('User')->find($_POST['selectbasic']);
				echo "Infos de :".$_POST['selectbasic']."<br>";
				echo "Etat civil :".$seluser->dossier->etat_civil."<br>";
				
				echo "Adresse :'".$seluser->dossier->coords."'";
			}
		}


    	else if ($user ==  "infirmiere"){
    		$users = $entityManager->getRepository('User')->findAll();
	?>
			<form method="POST" action="./etat_civil.php">
				<select id="selectbasic2" name="selectbasic2" class="form-control">
					<option value="0"> -- Sélectionner un employé -- </option>
					<?php
						foreach ($users as $u) {
							echo "<option value='".$u->login."'>".$u->login." </option>";
						}
					?>
					
				</select>
				<INPUT TYPE="submit" NAME="valider" VALUE="valider"> 
			</form>
			<a href="./accueil.php">Retour</a> </p>
	<?php
			if(isset($_POST['selectbasic2'])) {
				$seluser = $entityManager->getRepository('User')->find($_POST['selectbasic2']);
			?>
				<form method="POST" action="./etat_civil.php">
				<label>Infos de <?php echo $seluser->login; ?> :</label>
				<select id="modif" name="modif" class="form-control">
					<option value="0"> -- Etat civil -- </option>
					<option value="M" <?php if(isset($seluser->dossier->etat_civil) && $seluser->dossier->etat_civil=="M") echo "selected"; ?>> -- M. -- </option>
					<option value="Mme" <?php if(isset($seluser->dossier->etat_civil) && $seluser->dossier->etat_civil=="Mme") echo "selected"; ?>> -- Mme -- </option>
				</select>
				<input type="text" name="coord" value="<?php echo $seluser->dossier->coords; ?>">
				<INPUT TYPE="submit" NAME="modifier" VALUE="modifier"> 
				<input type="hidden" name="login" value=<?php echo "'".$seluser->login."'"; ?> > 
			</form>
	<?php
			}
		} 



    	else if($user ==  "employe"){
    		$seluser = $entityManager->getRepository('User')->find($_SESSION['user']);
	?>
				<form method="POST" action="./etat_civil.php">
				<label>Infos de <?php echo $seluser->login; ?> :</label>
				<select id="modifemp" name="modif" class="form-control">
					<option value="0"> -- Etat civil -- </option>
					<option value="M" <?php if($seluser->dossier->etat_civil=="M") echo "selected"; ?>> -- M -- </option>
					<option value="Mme" <?php if($seluser->dossier->etat_civil=="Mme") echo "selected"; ?>> -- Mme -- </option>
				</select>
				<input type="text" name="coord" value="<?php echo $seluser->dossier->coords; ?>">
				<input type="hidden" name="login" value=<?php echo "'".$seluser->login."'"; ?> > 
				<INPUT TYPE="submit" NAME="modifier" VALUE="modifier"> 
			</form>
			<a href="./accueil.php">Retour</a> </p>
	<?php
		} 
	}

	if(isset($_POST['login'])){ // On a envoyé une modification
		$seluser = $entityManager->getRepository('User')->find($_POST['login']);
        $seluser->dossier->etat_civil = htmlspecialchars($_POST['modif']);
        $seluser->dossier->coords = htmlspecialchars($_POST['coord']);
        $entityManager->flush();

        echo "<p> Mise à jour réussie ! <a href='./accueil.php'>Revenir à l'accueil</a></p>";
    }
	?>
	
    </body>
</html>