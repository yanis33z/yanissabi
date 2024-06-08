<?php #YANIS ET MAXIME
// démarrage de la session
session_start();

// initialisation de la session 'admmmm' à un tableau vide
$_SESSION['admmmm'] = array();

// Destruction de la session
session_destroy();

// redirection vers la page d'index
header("Location: ../index.php");
?>
