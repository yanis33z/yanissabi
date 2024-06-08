<?php #YANIS ET MAXIME // Commentaire indiquant les noms des auteurs

// Fonction pour ajouter un utilisateur à la base de données
function ajouterUser($nom, $prenom, $email, $motdepasse)
{
  // Vérification de la connexion à la base de données
  if(require("connexion.php"))
  {
    // Préparation de la requête SQL pour insérer un nouvel utilisateur
    $req = $access->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");

    // Exécution de la requête avec les valeurs fournies
    $req->execute(array($nom, $prenom, $email, $motdepasse));

    // Fermeture du curseur de la requête
    $req->closeCursor();

    // Retourner true pour indiquer que l'opération a réussi
    return true;
  }
}

// Fonction pour récupérer les utilisateurs de la base de données
function getUsers($email, $password){
  
  // Vérification de la connexion à la base de données
  if(require("connexion.php")){

     // Préparation de la requête SQL pour sélectionner tous les utilisateurs
    $req = $access->prepare("SELECT * FROM client ");

    // Exécution de la requête
    $req->execute();

    // Vérification du nombre de résultats
    if($req->rowCount() == 1){
      
      // Récupération des données sous forme d'objet
      $data = $req->fetchAll(PDO::FETCH_OBJ);

      // Parcours des données
      foreach($data as $i){
       $mail = $i->email;
        $mdp = $i->motdepasse;
      }

      // Vérification de l'email et du mot de passe
      if($mail == $email AND $mdp == $password)
      {
        // Retourner les données si l'email et le mot de passe correspondent
        return $data;
      }
      else{
         return false;
      }
    }

   }

 }

// Fonction pour afficher un produit spécifique de la base de données
function afficherUnProduit($id)
 {
     // Inclusion du fichier de connexion à la base de données
     require_once("connexion.php");
 
     // Préparation de la requête SQL pour sélectionner un produit par son ID
     $req = $access->prepare("SELECT * FROM produits WHERE id=?");
     $req->execute(array($id));  
 
     // Récupération des données sous forme d'objet
     $data = $req->fetch(PDO::FETCH_OBJ);  
     $req->closeCursor();
 
     // Retourner les données du produit
     return $data;  
 }
 
// Fonction pour afficher des produits du panier en fonction des identifiants fournis
 function afficherUnProduitPanier($ids) {
  // Inclusion du fichier de connexion à la base de données
  require_once("connexion.php"); 

  // Initialisation du tableau de produits
  $produits = [];

  // Vérification de la non-vacuité du tableau d'identifiants
  if (!empty($ids)) {
      // Création d'une chaîne de caractères pour les paramètres de la requête SQL
      $placeholders = implode(',', array_fill(0, count($ids), '?'));
      // Préparation de la requête SQL pour sélectionner les produits avec les identifiants fournis
      $stmt = $access->prepare("SELECT * FROM produits WHERE id IN ($placeholders)");
      // Exécution de la requête avec les identifiants
      $stmt->execute($ids);
      // Récupération des produits sous forme de tableau associatif
      $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Retourner les produits
  return $produits;
}

// Fonction pour ajouter un produit à la base de données
function ajouter($image, $nom, $prix, $desc, $quantite)
{
  // Vérification de la connexion à la base de données
  if(require("connexion.php"))
  {
    // Préparation de la requête SQL pour insérer un nouveau produit
    $req = $access->prepare("INSERT INTO produits (image, nom, prix, description, quantite) VALUES (?, ?, ?, ?,?)");

    // Exécution de la requête avec les valeurs fournies
    $req->execute(array($image, $nom, $prix, $desc, $quantite));

    // Fermeture du curseur de la requête
    $req->closeCursor();
  }
}

// Fonction pour inscrire un utilisateur dans la base de données
function inscrire($mail, $mdp, $nom, $prenom)
{
  // Vérification de la connexion à la base de données
  if(require("connexion.php"))
  {
    // Vérification si l'email existe déjà dans la table client
    $check_email = $access->prepare("SELECT COUNT(*) FROM client WHERE email = ?");
    $check_email->execute([$mail]);
    $count = $check_email->fetchColumn();

    // Si l'email n'existe pas, on peut insérer le nouvel utilisateur
    if($count == 0) {
      // Préparation de la requête SQL pour insérer un nouvel utilisateur
      $req = $access->prepare("INSERT INTO client (email, motdepasse, nom, prenom) VALUES (?, ?, ?, ?)");

      // Exécution de la requête avec les valeurs fournies
      $req->execute(array($mail, $mdp, $nom, $prenom));

      // Fermeture du curseur de la requête
      $req->closeCursor();
      return true; // Utilisateur inséré avec succès
    } else {
      return false; // L'email existe déjà dans la base de données
    }
  }
}


// Fonction pour afficher tous les produits de la base de données
function afficher()
{
	if(require("connexion.php"))
	{
		// Préparation de la requête SQL pour sélectionner tous les produits
        $req=$access->prepare("SELECT * FROM produits ORDER BY id DESC");

        // Exécution de la requête
        $req->execute();

        // Récupération des données sous forme d'objet
        $data = $req->fetchAll(PDO::FETCH_OBJ);

        // Fermeture du curseur de la requête
        $req->closeCursor();

        // Retourner les données
        return $data;
	}
}

// Fonction pour supprimer un produit de la base de données
function supprimer($id)
{
	if(require("connexion.php"))
	{
		// Préparation de la requête SQL pour supprimer un produit par son ID
		$req=$access->prepare("DELETE FROM produits WHERE id=?");

		// Exécution de la requête avec l'identifiant fourni
		$req->execute(array($id));

		// Fermeture du curseur de la requête
		$req->closeCursor();
	}
}

// Fonction pour supprimer un compte utilisateur de la base de données
function supprcompte($mail)
{
	if(require("connexion.php"))
	{
		// Préparation de la requête SQL pour supprimer un compte utilisateur par email
		$req=$access->prepare("DELETE FROM client WHERE mail=?");

		// Exécution de la requête avec l'email fourni
		$req->execute(array($mail));

		// Fermeture du curseur de la requête
		$req->closeCursor();
	}
}

// Fonction pour obtenir les informations d'administration
function getAdmin($email, $password){
  
  // Vérification de la connexion à la base de données
  if(require("connexion.php")){

    // Préparation de la requête SQL pour sélectionner l'administrateur avec un ID spécifique
    $req = $access->prepare("SELECT * FROM admin WHERE id=33");

    // Exécution de la requête
    $req->execute();

    // Vérification du nombre de résultats
    if($req->rowCount() == 1){
      
      // Récupération des données sous forme d'objet
      $data = $req->fetchAll(PDO::FETCH_OBJ);

      // Parcours des données
      foreach($data as $i){
        $mail = $i->email;
        $mdp = $i->motdepasse;
      }

      // Vérification de l'email et du mot de passe
      if($mail == $email AND $mdp == $password)
      {
        // Retourner les données si l'email et le mot de passe correspondent
        return $data;
      }
      else{
          return false;
      }

    }

  }

}

// Fonction pour obtenir la quantité disponible d'un produit dans la base de données
function obtenirQuantiteDisponible($id) {
  // Inclure le fichier de connexion à la base de données si nécessaire
  include_once "connexion2.php";

  // Préparer la requête SQL pour obtenir la quantité disponible du produit
  $stmt = $con->prepare("SELECT quantite FROM produits WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($quantite);
  $stmt->fetch();
  $stmt->close();

  // Retourner la quantité disponible
  return $quantite;
}

// Fonction pour rechercher des produits dans la base de données
function rechercherProduits($search)
{
    // Inclure le fichier de connexion à la base de données
    require("connexion.php"); 
    
    // Préparation du terme de recherche
    $search_term = "%$search%";
    
    // Préparation de la requête SQL pour rechercher des produits par nom
    $req = $access->prepare("SELECT * FROM produits WHERE nom LIKE ?");
    
    // Exécution de la requête avec le terme de recherche
    $success = $req->execute([$search_term]);
    
    // Récupération des résultats sous forme d'objet
    return $req->fetchAll(PDO::FETCH_OBJ);
}

// Fonction pour mettre à jour les informations d'un client dans la base de données
function updateClient($old_email, $new_email, $new_mdp, $new_nom, $new_prenom) {
  require("connexion.php"); // Inclure le fichier de connexion à la base de données

  // Préparer la requête SQL pour mettre à jour les détails de l'utilisateur
  $sql = "UPDATE client SET email = :new_email, motdepasse = :new_mdp, nom = :new_nom, prenom = :new_prenom WHERE email = :old_email";

  try {
      // Préparer la déclaration
      $stmt = $access->prepare($sql);

      // Binder les paramètres à la déclaration
      $stmt->bindParam(':new_email', $new_email);
      $stmt->bindParam(':new_mdp', $new_mdp);
      $stmt->bindParam(':new_nom', $new_nom);
      $stmt->bindParam(':new_prenom', $new_prenom);
      $stmt->bindParam(':old_email', $old_email);

      // Exécuter la déclaration
      $stmt->execute();

      // Vérifier si la mise à jour a réussi
      if ($stmt->rowCount()) {
          return true; // Mise à jour réussie
      } else {
          return false; // Mise à jour échouée
      }
  } catch (PDOException $e) {
      // Gérer les erreurs qui se produisent pendant la mise à jour
      echo "Error: " . $e->getMessage();
      return false;
  }
}

// Fonction pour vérifier l'existence d'un utilisateur dans la base de données
function verifyUser($email, $password) {
  // Assumer que la connexion à la base de données est gérée par $access, un objet PDO
  require 'connexion.php'; // Ce fichier doit contenir la création de l'objet PDO $access

  // Préparer une requête SQL pour rechercher l'utilisateur
  $stmt = $access->prepare("SELECT * FROM client WHERE email = :email AND motdepasse = :password");
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  // fetch() retourne un seul enregistrement (la première ligne) ou false si aucun enregistrement n'est trouvé
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Retourner l'utilisateur s'il est trouvé, sinon false
  return $user ? $user : false;
}

?>
