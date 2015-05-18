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
	<?php
			if(isset($_POST['selectbasic'])) {
				$user = $entityManager->getRepository('User')->find($_POST['selectbasic']);
				echo $user->dossier->etat_civil;
				echo $user->dossier->coords;
				
			
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
	<?php
		} 
    	else if (isset($_SESSION['user']) && $_SESSION['user'] ==  "employe"){
    		$user = $entityManager->getRepository('User')->find($_SESSION['user']->login);
	?>
			<form  action="./etat_civil.php" method="POST">
				<LABEL for="etat"> Etat Civil : </label>
				<select id="selectetat" name="selectetat" class="form-control">
					<option value="0" > -- Etat civil -- </option>
					<option value="1"> -- M. -- </option>
					<option value="2"> -- Mme -- </option>
				</select>
				<LABEL for="coord"> Adresse : </label>
				<input type="text" name="coord" value=<?php echo("'".$user->coords()."'"); ?> />
				<INPUT TYPE="submit" NAME="enregistrer" VALUE="Enregistrer"> 
			</form>
	<?php
		} 
	?>
	
    </body>
</html>