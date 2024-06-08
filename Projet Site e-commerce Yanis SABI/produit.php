<?php #YANIS ET MAXIME

require("config/commandes.php");

// Vérifier si l'ID du produit est présent et correct
if(isset($_GET['pdt']) && is_numeric($_GET['pdt'])) {
    $id = $_GET['pdt'];
    $produit = afficherUnProduit($id); // Utilisation de la nouvelle fonction pour afficher les détails du produit
    if(!$produit) {
        header('Location: index.php'); // Redirige l'utilisateur vers la page d'accueil si le produit n'est pas trouvé
        exit;
    }
} else {
    header('Location: index.php'); // Redirige l'utilisateur vers la page d'accueil si l'ID n'est pas valide
    exit;
}

// Récupérer la quantité disponible du produit depuis la base de données
$quantiteDisponible = obtenirQuantiteDisponible($id);

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: black; /* Fond noir pour tout le corps */
        }
        h3 {
            color: goldenrod; /* Couleur dorée pour les noms de produits */
        }
    </style>
</head>
<body>
<main>
    <div class="album py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <h3 align="center"><?= htmlspecialchars($produit->nom) ?></h3>
                        <img src="<?= htmlspecialchars($produit->image) ?>" style="width: 50%">
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($produit->description) ?></p>
                            <p class="card-text">Quantité disponible: <?= $quantiteDisponible ?></p> <!-- Affichage de la quantité disponible -->
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="font-weight: bold;"><?= htmlspecialchars($produit->prix) ?> €</small>
                                <a href="index.php" class="btn btn-sm btn-success">Boutique</a>
                                    <a href="ajouter_panier.php?id=<?= htmlspecialchars($produit->id) ?>" class="btn btn-sm btn-success">Ajouter au panier</a> <!-- Afficher le bouton "Ajouter au panier" si le produit est en stock -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
