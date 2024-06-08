<?php #YANIS ET MAXIME
session_start(); // Démarrage de la session PHP.

require("../config/commandes.php"); // Inclusion du fichier de configuration des commandes.

// Vérification de l'authentification de l'utilisateur.
if(!isset($_SESSION['admmmm'])) {
    header("Location: ../login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté.
    exit();
}

// Vérification de la présence de données dans la session.
if(empty($_SESSION['admmmm'])) {
    header("Location: ../login.php"); // Redirection vers la page de connexion si les données de session sont vides.
    exit();
}

// Récupération de l'email de l'utilisateur connecté.
foreach($_SESSION['admmmm'] as $i){
  $email = $i->email;
}

?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>Page Administrateur</title>
    <style>
        body, .navbar, .form-control, .btn, .nav-link, textarea {
            background-color: #0b0b0b; /* Fond noir pour tout le corps et éléments de formulaire */
            color: goldenrod; /* Texte doré pour tout le contenu */
            border-color: goldenrod; /* Bordure dorée pour les éléments de formulaire */
        }
        .btn-primary, .btn-danger {
            background-color: goldenrod; /* Fond des boutons */
            border-color: darkgoldenrod; /* Bordure des boutons */
        }
        .btn-primary:hover, .btn-danger:hover {
            background-color: darkgoldenrod; /* Survol des boutons */
        }
        .navbar {
            border-bottom: 1px solid goldenrod; /* Bordure inférieure de la navbar */
        }
    </style>
</head>
<body>
<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../">Page Administrateur</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../admin/">Nouveau</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="supprimer.php">Suppression</a>
                </li>
            </ul>
            <!-- Bouton de déconnexion -->
            <a class="btn btn-danger" href="deconnexion.php">Se déconnecter</a>
        </div>
    </div>
</nav>

<!-- Formulaire pour ajouter un nouveau produit -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">L'image du produit</label>
                    <input type="text" class="form-control" name="image" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="prix" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <textarea class="form-control" name="desc" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Quantité</label>
                    <input type="number" class="form-control" name="quantite" required>
                </div>
                <!-- Bouton pour ajouter un nouveau produit -->
                <button type="submit" name="valider" class="btn btn-primary">Ajouter un nouveau produit</button>
            </form>
        </div>
    </div>
</div>
<?php
// Traitement du formulaire pour l'ajout d'un nouveau produit
if (isset($_POST['valider'])) {
    // Récupération sécurisée des données du formulaire avec des vérifications
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : 0;
    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 0;

    // Vérification que le champ 'image' n'est pas vide
    if (!empty($image)) {
        // Insertion des données dans la base de données
        $success = ajouter($image, $nom, $prix, $desc, $quantite);
    }
}
?>
</body>
</html>
