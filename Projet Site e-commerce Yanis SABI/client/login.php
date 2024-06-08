<?php

include "../config/commandes.php" ;
if(isset($_POST['envoyer'])) {
    if(!empty($_POST['email']) && !empty($_POST['motdepasse'])) {
        // Récupérer et traiter les données du formulaire
        $login = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];

        // Récupérer les informations de l'administrateur ou de l'utilisateur
        $admin = getAdmin($login, $motdepasse);
        $user = getUsers($login, $motdepasse);
        header("Location : modif.php") ;
    }
}
?>

<html>
<head>
    <!-- Liens vers les fichiers CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Connexion</title>
    <style>
        body {
            background-color: #0b0b0b; /* Couleur de fond noir plus foncé */
            color: goldenrod; /* Couleur du texte doré */
        }
        .form-label {
            color: goldenrod; /* Couleur des étiquettes doré */
        }
        .form-control {
            background-color: #2c2f33; /* Fond gris foncé pour les champs de saisie */
            color: goldenrod; /* Couleur du texte doré pour les entrées */
            border: 1px solid goldenrod; /* Bordure dorée pour les entrées */
        }
        .btn-info {
            background-color: goldenrod; /* Couleur de fond doré pour le bouton */
            border-color: #cda434; /* Couleur de bordure doré plus foncé */
        }
        .btn-info:hover {
            background-color: #cda434; /* Couleur de fond doré plus foncé au survol */
            border-color: #b89232; /* Couleur de bordure doré encore plus foncé au survol */
        }
        .error-message {
            color: red; /* Couleur pour les messages d'erreur */
        }
    </style>
</head>
<body>
<br><br><br><br>
<div class="container" style="display: flex; justify-content: center;">
    <div class="row">
        <div class="col-md-10">
            <form method="post">
                <!-- Champ de saisie pour l'email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Login</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <!-- Champ de saisie pour le mot de passe -->
                <div class="mb-3">
                    <label for="motdepasse" class="form-label">Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control" required>
                </div>
                <br>
                <!-- Bouton de soumission -->
                <input type="submit" name="envoyer" class="btn btn-info" value="Se connecter">
                <!-- Affichage du message d'erreur -->
                <?php if(isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>
