<?php #YANIS ET MAXIME

include "config/commandes.php"; // Inclure le fichier de configuration des commandes

?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #0b0b0b; /* Fond noir pour tout le corps */
            color: goldenrod; /* Couleur dorée pour le texte */
        }
        .form-label, .btn-info {
            color: goldenrod; /* Couleur dorée pour les labels et le bouton */
        }
        .form-control {
            background-color: #333; /* Couleur de fond des champs de saisie sombre */
            border-color: goldenrod; /* Couleur de la bordure dorée */
            color: goldenrod; /* Couleur du texte dorée */
        }
        .btn-info {
            background-color: #444; /* Couleur de fond du bouton légèrement plus claire */
            border-color: goldenrod; /* Couleur de la bordure dorée */
        }
        .btn-info:hover {
            background-color: #555; /* Couleur de fond du bouton au survol */
        }
    </style>
</head>
<body>
<div class="container" style="display: flex; justify-content: center;">
    <div class="row">
        <div class="col-md-10">
            <form method="post">
                <!-- Champ de saisie pour le nom -->
                <div class="mb-3">
                    <label for="nom" class="form-label" style="margin-top: 20px;">Nom</label>
                    <input name="nom" class="form-control">
                </div>

                <!-- Champ de saisie pour le prénom -->
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input name="prenom" class="form-control">
                </div>

                <!-- Champ de saisie pour l'email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <!-- Champ de saisie pour le mot de passe -->
                <div class="mb-3">
                    <label for="motdepasse" class="form-label">Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control">
                </div>
                
                <!-- Bouton d'envoi du formulaire -->
                <input type="submit" name="envoyer" class="btn btn-info" value="Envoyer">
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php

if(isset($_POST['envoyer']))
{
    if(!empty($_POST['email']) AND !empty($_POST['motdepasse']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
    {
        // Récupération et traitement des données du formulaire
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        // Appel de la fonction pour inscrire un utilisateur
        $user = inscrire($email, $motdepasse, $nom, $prenom);
        if ($user == false) {}

        else{header('Location: login.php');}
    }
}

?>
+