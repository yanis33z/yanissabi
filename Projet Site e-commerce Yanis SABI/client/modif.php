<?php #YANIS ET MAXIME
session_start();
include "../config/commandes.php"; // Inclure le fichier de configuration des commandes

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_POST['email']) || !isset($_POST['motdepasse'])) {
    header('Location: login.php');
    exit();
}

// Récupération des informations de l'utilisateur dans la base de données
$email = $_POST['email'];
$mdp = $_POST['motdepasse'];
$utilisateur = getUsers($email, $mdp);


// Lorsque l'utilisateur confirme les modifications
if (isset($_POST['confirmer'])) {
    $nouvel_email = $_POST['new_email'];
    $nouveau_mdp = $_POST['new_motdepasse'];
    $nouveau_nom = $_POST['new_nom'];
    $nouveau_prenom = $_POST['new_prenom'];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $mise_a_jour = updateClient($email, $nouvel_email, $nouveau_mdp, $nouveau_nom, $nouveau_prenom);
    if ($mise_a_jour) {
        // Redirection vers la page de connexion générale après mise à jour réussie
        header('Location: destroy.php');
        exit();
    }
}

// Lorsque l'utilisateur demande la suppression de son compte
if (isset($_POST['supprimer'])) {
    $suppression = supprcompte($email);
    if ($suppression) {
        // Redirection vers la page d'accueil après suppression réussie
        header('Location: ../index.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000; /* Fond sombre pour tout le corps */
            color: goldenrod; /* Couleur de texte dorée */
        }
        .btn-danger, .btn-success {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2>Modifier Compte</h2>
        <form method="post">
            <!-- Champ pour l'email -->
            <div class="mb-3">
                <label for="new_email" class="form-label">Nouvel Email</label>
                <input type="email" class="form-control" name="new_email" id="new_email" value="<?= $email ?>" required>
            </div>
            <!-- Champ pour le mot de passe -->
            <div class="mb-3">
                <label for="new_motdepasse" class="form-label">Nouveau Mot de passe</label>
                <input type="password" class="form-control" name="new_motdepasse" id="new_motdepasse" required>
            </div>
            <!-- Champ pour le nom -->
            <div class="mb-3">
                <label for="new_nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="new_nom" id="new_nom" value="<?= $utilisateur['nom'] ?? '' ?>" required>
            </div>
            <!-- Champ pour le prénom -->
            <div class="mb-3">
                <label for="new_prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="new_prenom" id="new_prenom" value="<?= $utilisateur['prenom'] ?? '' ?>" required>
            </div>
            <!-- Boutons Confirmer et Supprimer le compte -->
            <button type="submit" name="confirmer" class="btn btn-success">Confirmer</button>
            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer le compte</button>
        </form>
    </div>
</body>
</html>
