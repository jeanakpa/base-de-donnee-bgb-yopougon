<?php

// Définir les variables de connexion à la base de données
$user = 'root'; // Nom d'utilisateur MySQL
$password = 'root'; // Mot de passe MySQL (par défaut pour MAMP)
$db = 'bataillon de yopougon'; // Nom de la base de données
$host = 'localhost'; // Nom d'hôte MySQL (par défaut pour MAMP)
$port = 3306; // Port MySQL (par défaut pour MAMP)

// Connexion à la base de données
$connexion = mysqli_connect($host, $user, $password, $db, $port);

// Vérification de la connexion
if (!$connexion) {
  die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupérer le matricule
$matricule = $_GET['matricule'];

// Requête SQL pour supprimer le membre
$sql = "DELETE FROM membre WHERE matricule = '$matricule'";

if (mysqli_query($connexion, $sql)) {
  // Succès de la suppression, redirection vers la page de liste
  header('Location: liste.php');
  exit(); // Arrêter l'exécution du script après la redirection
} else {
  echo "Erreur lors de la suppression du membre : " . mysqli_error($connexion);
}

// Fermer la connexion à la base de données
mysqli_close($connexion);

?>