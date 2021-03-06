<?php
//logout.php
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy();

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<h1> Vous avez été déconnecté </h1>

<a href="./index.php">Retour à l'accueil</a>