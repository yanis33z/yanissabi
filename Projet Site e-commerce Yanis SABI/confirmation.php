<?php #YANIS ET MAXIME
session_start();
require_once "config/commandes.php"; // Assurer que ce fichier inclut la connexion à la base de données


    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        header("Location: panier.php"); // Rediriger si le panier est vide
        exit;
    }

    $ids = array_keys($_SESSION['panier']);
    $produits = afficherUnProduitPanier($ids); // Utiliser la fonction pour obtenir les produits
	$access=new PDO("mysql:host=localhost;dbname=O'Montro.;charset=utf8", "Yanis", "");

    // Démarrer la transaction
    $access->beginTransaction();

    // Mettre à jour les quantités de produits dans la base de données
    foreach ($produits as $produit) {
        $id = $produit['id'];
        $quantite_achetee = $_SESSION['panier'][$id];
        $req = $access->prepare("UPDATE produits SET quantite = quantite - ? WHERE id = ?");
        $req->execute([$quantite_achetee, $id]);
    }
    
    $access->commit(); // Commit la transaction
    $_SESSION['panier'] = []; // Vider le panier
    header("Location: index.php"); // Rediriger après la commande

    exit;
?>
