<?php

session_start();
require_once './model/user.php';
require_once './model/dossier.php';
require_once "./vendor/autoload.php";
require "./src/bootstrap.php";
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Etat civil</title>
    </head>
    <body>
    
    <?php
		echo session_id();
		//echo $_SESSION['user'];
    	if (isset($_SESSION['user']) && $_SESSION['user'] ==  "medecin"){
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
				$user = $entityManager->getRepository('User')->find($_POST['selectbasic']);
				echo "Etat civil :".$user->dossier->etat_civil."\n";
				
				echo "Adresse :".$user->dossier->coords;
			}
		}
    	else if (isset($_SESSION['user']) && $_SESSION['user'] ==  "infirmiere"){
    		$users = $entityManager->getRepository('User')->findAll();
	?>
			<form method="POST" action="./etat_civil.php">
				<select id="selectbasic2" name="selectbasic2" class="form-control">
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
			if(isset($_POST['selectbasic2'])) {
				$user = $entityManager->getRepository('User')->find($_POST['selectbasic2']);
			?>
				<form method="POST" action="./etat_civil.php">
				<select id="modif" name="modif" class="form-control">
					<option value="0"> -- Etat civil -- </option>
					<option value="M" <?php if(isset($user->dossier->etat_civil) && $user->dossier->etat_civil=="M") echo "selected"; ?>> -- M. -- </option>
					<option value="Mme" <?php if(isset($user->dossier->etat_civil) && $user->dossier->etat_civil=="Mme") echo "selected"; ?>> -- Mme -- </option>
				</select>
				<input type="textarea" name="coord" value=<?php if(isset($user->dossier->coords)) echo $user->dossier->coords; ?>>
				<INPUT TYPE="submit" NAME="modifier" VALUE="modifier"> 
			</form>
	<?php
			}
		} 
    	else if (isset($_SESSION['user']) && $_SESSION['user'] ==  "employe"){
    		$user = $entityManager->getRepository('User')->find($_SESSION['user']);
	?>
				<form method="POST" action="./etat_civil.php">
				<select id="modifemp" name="modifemp" class="form-control">
					<option value="0"> -- Etat civil -- </option>
					<option value="M" <?php if(isset($user->dossier->etat_civil) && $user->dossier->etat_civil=="M") echo "selected"; ?>> -- M. -- </option>
					<option value="Mme" <?php if(isset($user->dossier->etat_civil) && $user->dossier->etat_civil=="Mme") echo "selected"; ?>> -- Mme -- </option>
				</select>
				<input type="textarea" name="coord" value=<?php if(isset($user->dossier->coords)) echo $user->dossier->coords; ?>>
				<INPUT TYPE="submit" NAME="modifier" VALUE="modifier"> 
			</form>
			<a href="./accueil.php">Retour</a> </p>
	<?php
		} 
	?>
	
    </body>
</html>