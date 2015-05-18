<?php

require_once "./vendor/autoload.php";
$_SESSION['entity_manager'] = require "./src/bootstrap.php";

require_once './model/user.php';
require_once './model/dossier.php';

$user = new User();
$user->login = "employe";
$user->password = password_hash("emp", PASSWORD_BCRYPT);

$entityManager->persist($user);
$entityManager->flush();

// $user = $entityManager->getRepository('User')->find('medecin');

echo $user->password;

?>