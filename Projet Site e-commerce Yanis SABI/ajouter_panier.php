<?php #YANIS ET MAXIME
// Inclure la page de connexion
include "connexion2.php";

// démarrer une session
session_start();


// Créer la session panier si elle n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Récupération de l'id dans le lien
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête SQL pour éviter les injections SQL
    $stmt = $con->prepare("SELECT * FROM produits WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product && $product['quantite'] > 0) {
        // Diminuer la quantité en stock uniquement si la quantité disponible est supérieure à 0
        $qteRest = $product['quantite'] - 1;

        if ($qteRest > 0) {
            // Ajouter le produit au panier
            if (isset($_SESSION['panier'][$id])) {
                $_SESSION['panier'][$id]++; // Incrémenter la quantité dans le panier
            } else {
                $_SESSION['panier'][$id] = 1;
            }
            // Redirection vers la page produit.php
            header("Location: produit.php?pdt=$id");
            exit;
        } else {
            // Si la quantité en stock est insuffisante, afficher un message d'erreur
            $_SESSION['error'] = "Pas de stock disponible pour ce produit.";
            header("Location: erreur.php");
            exit;
        }
    } else {
        // Gérer le cas où le produit n'est plus disponible
        $_SESSION['error'] = "Ce produit n'est plus disponible en stock.";
        header("Location: erreur.php"); // Rediriger vers une page d'erreur
        exit;
    }
}
?>
