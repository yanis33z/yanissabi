<?php #YANIS ET MAXIME
session_start(); // Start the session to maintain user data

include "config/commandes.php"; // Include the command configuration file

if(isset($_SESSION['xRttpHo0greL39'])) {
    if(!empty($_SESSION['xRttpHo0greL39'])) {
        header("Location: admin/"); // Redirect to the administration page if the user is already connected
        exit();
    }
}
?>
<html>
<head>
    <!-- Links to Bootstrap CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Connexion</title>
    <style>
        body {
            background-color: #0b0b0b; /* Darker black background color */
            color: goldenrod; /* Goldenrod text color */
        }
        .form-label {
            color: goldenrod; /* Goldenrod label color */
        }
        .form-control {
            background-color: #2c2f33; /* Dark grey background for input fields */
            color: goldenrod; /* Goldenrod text color for inputs */
            border: 1px solid goldenrod; /* Goldenrod border for inputs */
        }
        .btn-info {
            background-color: goldenrod; /* Goldenrod background color for the button */
            border-color: #cda434; /* Darker goldenrod border color */
        }
        .btn-info:hover {
            background-color: #cda434; /* Darker goldenrod background color on hover */
            border-color: #b89232; /* Even darker goldenrod border color on hover */
        }
    </style>
</head>
<body>
<br><br><br><br>
<div class="container" style="display: flex; justify-content: center;">
    <div class="row">
        <div class="col-md-10">
            <form method="post">
                <!-- Input field for email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Login</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <!-- Input field for password -->
                <div class="mb-3">
                    <label for="motdepasse" class="form-label">Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control" required>
                </div>
                <br>
                <!-- Submit button -->
                <input type="submit" name="envoyer" class="btn btn-info" value="Se connecter">
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['envoyer'])) {
    if(!empty($_POST['email']) && !empty($_POST['motdepasse'])) {
        // Retrieve and process form data
        $login = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];

        // Retrieve admin or user information
        $admin = getAdmin($login, $motdepasse);
        $user = getUsers($login, $motdepasse);

        // Redirect based on user type
        if($admin) {
            $_SESSION['admmmm'] = $admin;
            header('Location: admin/index.php');}
        else{
            $_SESSION['admmmm'] = $user;
            header('Location: client/index.php');
        }
    }
}
?>
