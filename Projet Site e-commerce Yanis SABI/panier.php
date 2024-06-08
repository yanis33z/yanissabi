<?php #YANIS ET MAXIME
session_start(); // Démarrer la session pour maintenir les données utilisateur
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = []; // Initialiser le panier s'il n'existe pas encore
}
include_once "connexion2.php"; // Inclure le fichier de connexion à la base de données

function obtenirQuantiteDisponible($id) {
    // Préparer et exécuter la requête SQL pour obtenir la quantité disponible du produit
    global $con; // Assurer l'accès à $con dans cette fonction
    $stmt = $con->prepare("SELECT quantite FROM produits WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($quantite);
    $stmt->fetch();
    $stmt->close();

    // Retourner la quantité disponible
    return $quantite;
}

// Supprimer les produits du panier si nécessaire
if (isset($_GET['del'])) {
    $id_del = $_GET['del'];
    $quantite_supprimee = $_SESSION['panier'][$id_del]; // Stocker la quantité supprimée
    unset($_SESSION['panier'][$id_del]);
}

// Vérifier si le formulaire de finalisation de commande a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialiser un indicateur de stock insuffisant
    $stock_insuffisant = false;

    // Parcourir chaque produit dans le panier pour vérifier le stock
    foreach ($_SESSION['panier'] as $id_produit => $quantite) {
        // Récupérer la quantité disponible en stock depuis la base de données
        $quantite_stock = obtenirQuantiteDisponible($id_produit);

        // Vérifier si la quantité dans le panier dépasse la quantité disponible en stock
        if ($quantite > $quantite_stock) {
            // Mettre à jour l'indicateur de stock insuffisant
            $stock_insuffisant = true;
            // Arrêter la boucle dès qu'un produit a un stock insuffisant
            break;
        }
    }

    // Rediriger vers la page d'achat si le stock est suffisant
    if (!$stock_insuffisant) {
        header("Location: achat.php");
        exit;
    } else {
        // Rediriger vers le panier avec un message d'erreur si le stock est insuffisant
        header("Location: panier.php?erreur=stock_insuffisant");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier de style CSS -->
</head>
<body class="panier">
    <a href="index.php" class="link">Boutique</a>
    <section>
        <?php
        // Afficher un message d'erreur si le stock est insuffisant
        if (isset($_GET['erreur']) && $_GET['erreur'] === 'stock_insuffisant') {
            echo "<p class='error'>Stock insuffisant pour certains produits.</p>";
        }
        ?>
        <!-- Structure du panier -->
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Supprimer</th>
            </tr>
            <?php 
            $total = 0;
            $ids = array_keys($_SESSION['panier']);
            if (empty($ids)) {
                echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
            } else {
                // Récupérer les informations sur les produits du panier depuis la base de données
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                $stmt = $con->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
                $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
                $stmt->execute();
                $result = $stmt->get_result();

                // Afficher les produits du panier dans le tableau
                while ($produit = $result->fetch_assoc()) {
                    $total += $produit['prix'] * $_SESSION['panier'][$produit['id']]; // Calcul du total
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($produit['nom']) ?></td>
                        <td><?= $produit['prix'] ?>€</td>
                        <td><?= $_SESSION['panier'][$produit['id']] ?></td>
                        <td><a href="panier.php?del=<?= $produit['id'] ?>"><img src="delete.png" alt="Supprimer"></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <!-- Afficher le total de la commande -->
            <tr class="total">
                <th colspan="4">Total : <?= $total ?>€</th>
            </tr>
        </table>
        <!-- Formulaire pour finaliser la commande -->
        <form action="panier.php" method="POST">
            <button type="submit" class="btn">Finaliser la commande</button> <!-- Bouton de finalisation de commande -->
        </form>
    </section>
</body>
</html>
