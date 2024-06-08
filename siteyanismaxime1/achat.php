<?php #YANIS ET MAXIME
session_start();
require_once "config/commandes.php"; // Assurez-vous que ce fichier contient vos paramètres de connexion et la fonction afficher()

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header("Location: panier.php");
    exit;
}

$ids = array_keys($_SESSION['panier']);
if (!empty($ids)) {
    $Produits = afficherUnProduitPanier($ids); // Cette fonction devrait être définie pour récupérer les produits par leurs IDs
} else {
    $Produits = [];
}

$total = 0;
foreach ($Produits as $produit) {
    $total += $produit['prix'] * $_SESSION['panier'][$produit['id']];
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Finaliser Achat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
      body { 
        font-size: 1rem; 
        background-color: black; /* Fond noir pour tout le corps */
        color: goldenrod; /* Couleur dorée pour le texte */
      }
      .container { 
        max-width: 960px; 
        color: goldenrod; /* Couleur dorée pour le texte */
      }
      h1, h2, th {
        color: goldenrod; /* Couleur dorée pour les titres */
      }
      tbody {
        color : goldenrod ;
      }
    </style>
  </head>
  <body>
    
<header class="navbar navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a href="#" class="navbar-brand d-flex align-items-center">
      <strong>O'Montro</strong>
    </a>
  </div>
</header>

<main class="py-4 bg-dark">
  <div class="container">
    <h1 class="mb-3">Finaliser votre commande</h1>
    <!-- Formulaire pour finaliser la commande -->
    <form action="confirmation.php" method="post" class="needs-validation" novalidate>
      <div class="mb-3">
        <label class="form-label">Votre nom:</label>
        <input class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Votre Adresse:</label>
        <input class="form-control" name="adresse" required>
      </div>
      <div class="mb-4">
        <!-- Résumé de la commande -->
        <h2>Résumé de votre commande</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nom du produit</th>
              <th scope="col">Prix unitaire</th>
              <th scope="col">Quantité</th>
              <th scope="col">Prix Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($Produits as $produit) : ?>
              <tr>
                <td><?= $produit['nom'] ?></td>
                <td><?= $produit['prix'] ?> €</td>
                <td><?= $_SESSION['panier'][$produit['id']] ?></td>
                <td><?= $_SESSION['panier'][$produit['id']] * $produit['prix'] ?> €</td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <th colspan="3">Total :</th>
              <th><?= $total ?> €</th>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Bouton de confirmation -->
      <form action="confirmation.php" method="post" class="needs-validation" novalidate>
        <button type="submit" class="btn btn-primary">Confirmer la commande</button>
      </form>
    </form>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
