<?php #YANIS ET MAXIME
// Inclusion du fichier de configuration des commandes
require("../config/commandes.php");

// Récupération des produits à afficher
$Produits = afficher();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>O'Montro</title>
    <!-- Lien CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
          crossorigin="anonymous">
    <!-- Lien JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <style>
        /* Couleurs personnalisées */
        body, .navbar, .btn-danger, .btn-primary, .btn-outline-secondary, .card {
            background-color: #0b0b0b; /* Fond noir uniforme */
        }
        body, .form-label, .navbar-brand, .nav-link, .btn-danger, .btn-primary, .btn-outline-secondary, .text-muted, .card {
            color: goldenrod; /* Texte et éléments en couleur dorée */
        }
        .btn-outline-secondary {
            border-color: goldenrod; /* Bordure des boutons en doré */
        }
        .btn-outline-secondary:hover, .btn-danger:hover, .btn-primary:hover {
            background-color: #cda434; /* Fond des boutons au survol en doré clair */
            border-color: #b89232; /* Bordure des boutons au survol en doré foncé */
        }
        .card {
            border: 1px solid goldenrod; /* Bordure des cartes en doré */
        }
    </style>
</head>
<body>
<header>
    <!-- Barre de navigation -->
    <div class="navbar navbar-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>O'Montro</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <h4>À propos</h4>
                        <p>Bienvenue chez O'Montro, votre destination privilégiée pour découvrir une collection minutieusement sélectionnée de montres de qualité. Chez O'Montro, nous sommes passionnés par l'élégance intemporelle et la sophistication qui ne se démodent jamais. Chaque pièce de notre collection est soigneusement choisie non seulement pour compléter votre style mais pour le définir.</p>
                    </li>
                </ul>
                <form class="d-flex" action="../recherche.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Boutons de déconnexion et de modification du compte -->
    <a class="btn btn-danger" href="../admin/deconnexion.php" style="margin-left: 10px;">Se déconnecter</a>
    <a href="login.php" class="btn btn-primary" style="margin-left: 10px;">Modifier Compte</a>
</header>

<main>
    <a href="../panier.php"><button type="button" class="btn btn-sm btn-success">Voir le panier</button></a>
    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($Produits as $produit): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <h3><?= htmlspecialchars($produit->nom) ?></h3>
                        <img src="<?= htmlspecialchars($produit->image) ?>" alt="Image du produit" style="width: 100%; height: 225px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text"><?= substr(htmlspecialchars($produit->description), 0, 160); ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="../produit.php?pdt=<?= $produit->id ?>"><button type="button" class="btn btn-sm btn-outline-secondary">En savoir plus</button></a>
                                </div>
                                <small class="text-muted"><?= htmlspecialchars($produit->prix) ?> €</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
  </div>
</main>
</body>
</html>
