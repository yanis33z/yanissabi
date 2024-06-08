<?php #YANIS ET MAXIME
session_start(); // Démarrage de la session PHP.
require("../config/commandes.php"); // Inclusion du fichier de configuration des commandes.

// Redirection si l'utilisateur n'est pas connecté.
if (!isset($_SESSION['admmmm'])) {
    header("Location: ../login.php");
    exit();
}
if (empty($_SESSION['admmmm'])) {
    header("Location: ../login.php");
    exit();
}

$Produits = afficher(); // Récupération des produits à afficher.

// Récupération de l'email de l'utilisateur connecté.
foreach ($_SESSION['admmmm'] as $i) {
    $email = $i->email;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Page Administrateur</title>
    <style>
        body {
            background-color: #0b0b0b; /* Fond noir pour tout le corps */
            color: goldenrod; /* Couleur du texte doré pour tout le contenu hors navbar */
        }
        .navbar {
            background-color: goldenrod; /* Fond de la barre de navigation en doré */
        }
        .navbar-brand, .nav-link {
            color: #000 !important; /* Couleur du texte dans la barre de navigation en noir */
        }
        .btn-danger {
            background-color: #dc3545; /* Couleur de fond du bouton de déconnexion */
            border-color: #dc3545; /* Couleur de la bordure du bouton de déconnexion */
        }
        .btn-danger:hover {
            background-color: #c82333; /* Couleur de fond du bouton de déconnexion au survol */
            border-color: #bd2130; /* Couleur de la bordure du bouton de déconnexion au survol */
        }
        .card {
            background-color: #0b0b0b; /* Fond des cartes en noir */
            border: 1px solid goldenrod; /* Bordure des cartes en doré */
            color: goldenrod; /* Texte des cartes en doré */
        }
        .form-control, .btn {
            background-color: #fff; /* Fond blanc pour les éléments de formulaire et boutons */
            color: #000; /* Texte noir pour les éléments de formulaire et boutons */
        }
        .btn-primary {
            background-color: goldenrod; /* Couleur de fond du bouton primaire */
            border-color: darkgoldenrod; /* Couleur de la bordure du bouton primaire */
        }
        .btn-primary:hover {
            background-color: darkgoldenrod; /* Couleur de fond du bouton primaire au survol */
        }
    </style>
</head>
<body>
<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Page Administrateur</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="../admin/">Nouveau</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="supprimer.php">Suppression</a>
        </li>
      </ul>
      <a class="btn btn-danger" href="deconnexion.php">Se déconnecter</a>
    </div>
  </div>
</nav>

<!-- Contenu principal -->
<div class="container py-5">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <form method="post">
      <div class="mb-3">
        <label for="idproduit" class="form-label">Identifiant du produit</label>
        <input type="number" class="form-control" name="idproduit" required>
      </div>
      <button type="submit" name="valider" class="btn btn-primary">Supprimer le produit</button>
    </form>

    <!-- Affichage des produits -->
    <?php foreach ($Produits as $produit): ?>
    <div class="col">
      <div class="card shadow-sm">
        <img src="<?= htmlspecialchars($produit->image) ?>" alt="Image du produit">
        <h3><?= htmlspecialchars($produit->id) ?></h3>
        <div class="card-body"></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>

<?php
if (isset($_POST['valider'])) {
    if (!empty($_POST['idproduit']) && is_numeric($_POST['idproduit'])) {
        $idproduit = $_POST['idproduit'];
        supprimer($idproduit); // Appel de la fonction pour supprimer le produit
    }
}
?>
