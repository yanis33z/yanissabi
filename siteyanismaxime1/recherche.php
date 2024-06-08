<?php #YANIS ET MAXIME
require("config/commandes.php");

// Vérifiez que le terme de recherche est non seulement défini, mais aussi non vide
if(isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']); // Trim pour enlever les espaces inutiles autour de la chaîne
    $resultats = rechercherProduits($search); // Recherche les produits correspondant au terme de recherche
} else {
    // Rediriger vers index.php si aucune recherche n'est spécifiée ou si la recherche est vide
    header("Location: index.php");
    exit; // Assurez-vous que le script s'arrête après la redirection
}
?>
<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous">
    <style>
        body {
            background-color: black; /* Fond noir */
            color: goldenrod; /* Texte doré */
        }
        .album {
            background-color: black; /* Fond noir pour la section d'album */
            color: goldenrod; /* Texte doré pour la section d'album */
        }
        .card {
            background-color: #222; /* Fond légèrement plus sombre pour les cartes */
            color: goldenrod; /* Texte doré pour les cartes */
        }
        .card-img-top {
            border-bottom: 1px solid goldenrod; /* Bordure dorée en bas de l'image */
        }
        .btn-success {
            background-color: goldenrod; /* Fond doré pour les boutons de succès */
            border-color: goldenrod; /* Bordure dorée pour les boutons de succès */
        }
        .btn-success:hover {
            background-color: #c89600; /* Fond doré plus foncé au survol */
            border-color: #c89600; /* Bordure dorée plus foncée au survol */
        }
    </style>
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>O'Montro - Résultats de la recherche</strong>
            </a>
        </div>
    </div>
</header>

<main>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php if(isset($resultats) && !empty($resultats)): ?> <!-- Vérifie s'il y a des résultats -->
                    <?php foreach ($resultats as $produit): ?> <!-- Parcours des résultats de recherche -->
                        <div class="col">
                            <div class="card shadow-sm">
                                <h3><?= htmlspecialchars($produit->nom) ?></h3> <!-- Affiche le nom du produit -->
                                <img src="<?= htmlspecialchars($produit->image) ?>" style="width: 100%; height: 200px; object-fit: cover;" class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text"><?= htmlspecialchars(substr($produit->description, 0, 160)); ?>...</p> <!-- Affiche une partie de la description -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="produit.php?pdt=<?= $produit->id ?>"><button type="button" class="btn btn-sm btn-success">Voir plus</button></a> <!-- Bouton pour voir plus de détails sur le produit -->
                                        </div>
                                        <small class="text" style="font-weight: bold;"><?= htmlspecialchars($produit->prix) ?> €</small> <!-- Affiche le prix -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col">
                        <p>Aucun résultat trouvé.</p> <!-- Affiche un message si aucun résultat trouvé -->
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
