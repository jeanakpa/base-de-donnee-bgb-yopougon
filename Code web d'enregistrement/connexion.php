<?php
// Démarrer la session
session_start();

// Définir les variables de connexion à la base de données
$user = 'root'; // Nom d'utilisateur MySQL
$password = 'root'; // Mot de passe MySQL (par défaut pour MAMP)
$db = 'bataillon de yopougon'; // Nom de la base de données (il est recommandé d'éviter les espaces dans le nom de la base de données)
$host = 'localhost'; // Nom d'hôte MySQL (par défaut pour MAMP)
$port = 3306; // Port MySQL (par défaut pour MAMP)

// Connexion à la base de données
$connexion = mysqli_connect($host, $user, $password, $db, $port);

// Vérification de la connexion
if (!$connexion) {
  die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Traitement du formulaire de connexion
if (isset($_POST['connexion'])) {
  // Récupération des informations du formulaire
  $code = $_POST['code'];
  $mdp = $_POST['mdp'];

  // Requête SQL pour vérifier le code et le mot de passe
  $sql = "SELECT * FROM administrateur WHERE code = '$code' AND mdp = '$mdp'";
  $resultat = mysqli_query($connexion, $sql);

  // Vérification du nombre de résultats
  if (mysqli_num_rows($resultat) == 1) {
    // Code et mot de passe corrects
    // Stocker le code dans la session
    $_SESSION['code'] = $code;
    // Récupération du nom de l'administrateur à partir de la base de données
    $sql_nom_admin = "SELECT nom FROM administrateur WHERE code = '$code'";
    $resultat_nom_admin = mysqli_query($connexion, $sql_nom_admin);
    $row = mysqli_fetch_assoc($resultat_nom_admin);
    $nom_admin = $row['nom'];

    // Stocker le nom de l'administrateur dans la session
    $_SESSION['nom_admin'] = $nom_admin;

    // Redirection vers la page liste.php
    header('Location: liste.php');
    exit; // Terminer le script après la redirection
  } else {
    // Code ou mot de passe incorrect
    $message_erreur = "Le code ou le mot de passe est incorrect.";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BGB</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Bad+Script&family=Bangers&family=Birthstone&family=Birthstone+Bounce:wght@400;500&family=Boogaloo&family=Candal&family=Carrois+Gothic+SC&family=Cherry+Swash:wght@400;700&family=Cookie&family=Crafty+Girls&family=Damion&family=Edu+NSW+ACT+Foundation:wght@400..700&family=Fruktur:ital@0;1&family=Great+Vibes&family=Inconsolata:wght@200..900&family=Jaldi:wght@400;700&family=Jura:wght@300..700&family=Kaushan+Script&family=Lemon&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Luckiest+Guy&family=Lumanosimo&family=MonteCarlo&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Neonderthaw&family=Ojuju:wght@200..800&family=Pacifico&family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Romanesco&family=Sacramento&family=Satisfy&family=Square+Peg&family=Style+Script&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: "Montserrat", sans-serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
    background: linear-gradient(20deg, #697BBD, #15C150); /* Gradient definition */
    background-size: cover; /* Fills the entire area */
    height: 100vh; /* Ensures the background covers the full viewport */
  }
  

  .container {
    background-color: #fff;
    color: #000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: absolute; /* Utilisez une position absolue */
    top: 50%; /* Déplacez le haut du conteneur à 50% de la hauteur de la page */
    left: 50%; /* Déplacez la gauche du conteneur à 50% de la largeur de la page */
    transform: translate(-50%, -50%); /* Déplacez le conteneur de moitié de sa propre largeur et hauteur vers le haut et la gauche */
    width: 30%; /* Largeur du conteneur */
    border-radius: 21px;    
}

.container img{
    height: 133px;
    margin-top: 20px;
}

.container .buttons{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    width: 70%;
    margin: 50px 0;
    gap: 20px;
}

.buttons input[type="submit"]{
    position: relative;
    width: 100%;
    border-radius: 100px;
    background-color: #15C150;
    color: #fff;
    border: none;
    padding: 12px;
    cursor: pointer;
    text-align: center;
    font-weight: bold;
}

.buttons input[type="text"],
.buttons input[type="password"]{
    position: relative;
    width: 100%;
    border-radius: 100px;
    background-color: #fff;
    color: #000;
    font-size: 15px;
    padding: 12px;
    margin-bottom: 15px;
}
  </style>
  <link rel="stylesheet" href="connexion.css">
</head>
<body>
  <div class="container">
    <img src="img/logo_bgb.png" alt="">
    <div class="buttons">
      <form action="connexion.php" method="post">
        <?php
        // Affichage du message d'erreur si nécessaire
        if (isset($message_erreur)) {
          echo "<p class='erreur' style='color:red; font-size:12px; text-align:center;margin-bottom:8px'>$message_erreur</p>";
        }
        ?>
        <input type="text" placeholder="CODE" name="code" id="code" class="code" required>
        <input type="password" placeholder="MOT DE PASSE" name="mdp" id="mdp" class="mdp" required>
        <input type="submit" value="SE CONNECTER" name="connexion" id="connexion" class="connexion">
      </form>
    </div>
  </div>
</body>
</html>
