<?php #YANIS ET MAXIME
// Démarre une session PHP.

session_start();
session_destroy();
// détruit la session actuelle, supprimant toutes les données de session.

header("Location: ../index.php");
// Redirige vers la page d'accueil.

?>
