<?php

// Fonction pour générer les parties aléatoires du matricule
function generateMatricule() {
    // Générer trois chiffres aléatoires
    $chiffres = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
    
    // Générer deux lettres aléatoires
    $lettres = chr(rand(65,90)) . chr(rand(65,90));
    
    // Concaténer et retourner le matricule
    return "24-YOP{$chiffres}{$lettres}";
}

// Utilisation de la fonction pour générer le matricule
$matricule = generateMatricule();

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['code'])) {
  // Redirection vers la page d'accueil si non connecté
  header('Location: accueil.html');
  exit(); // Arrêter l'exécution du script après la redirection
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Récupérer les données du formulaire
  $grade = $_POST['grade'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $telephone = $_POST['telephone'];
  $date_naissance = $_POST['date'];
  $compagnie = $_POST['compagnie'];
  $legion = $_POST['legion'];
  
  // Traiter les responsabilités de compagnie sélectionnées
// Traiter les responsabilités de compagnie sélectionnées
// Traiter les responsabilités de compagnie sélectionnées
// Traiter les responsabilités de compagnie sélectionnées
$responsabilites_compagnie = isset($_POST['responsabilite-compagnie']) ? implode(", ", $_POST['responsabilite-compagnie']) : "";

// Traiter les responsabilités de légion sélectionnées
$responsabilites_legion = isset($_POST['responsabilite-legion']) ? implode(", ", $_POST['responsabilite-legion']) : "";

// Traiter les responsabilités de bataillon sélectionnées
$responsabilites_bataillon = isset($_POST['responsabilite-bataillon']) ? implode(", ", $_POST['responsabilite-bataillon']) : "";

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
  
  // Requête SQL pour insérer un nouveau membre avec le matricule généré
  $sql = "INSERT INTO membre (matricule, grade, nom, prenom, telephone, date_de_naissance, compagnie, legion, fonction_compagnie, fonction_legion, fonction_bataillon) VALUES ('$matricule', '$grade', '$nom', '$prenom', '$telephone', '$date_naissance', '$compagnie', '$legion', '$responsabilites_compagnie', '$responsabilites_legion', '$responsabilites_bataillon')";

  if (mysqli_query($connexion, $sql)) {
    // Succès de l'insertion, maintenant traiter les responsabilités

    // Redirection vers la page d'ajout de membre
    header('Location: ajouter.php');
    exit(); // Arrêter l'exécution du script après la redirection
  } else {
    echo "Erreur lors de l'ajout du membre : " . mysqli_error($connexion);
  }
  
  // Fermer la connexion à la base de données
  mysqli_close($connexion);
} else {
  // Redirection vers la page d'accueil si le formulaire n'a pas été soumis
  header('Location: accueil.html');
  exit(); // Arrêter l'exécution du script après la redirection
}
?>
