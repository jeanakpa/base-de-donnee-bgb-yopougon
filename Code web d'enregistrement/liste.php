<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['code'])) {
  // Redirection vers la page d'accueil si non connecté
  header('Location: accueil.php');
}

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

// Requête SQL pour récupérer les membres
$sql = "SELECT matricule, grade, nom, prenom, compagnie FROM membre";
$resultat = mysqli_query($connexion, $sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BGB</title>
  <link rel="stylesheet" href="liste.css">
  <style>
    
.liste table {
    width: 100%;
    border-collapse: collapse;
}

.liste table thead {
    background-color: #15C150;
    color: #fff;
}

.liste table tbody tr{
    cursor: pointer;
}
.liste table th,
.liste table td {
    padding: 7px;
    text-align: center;
    border: 1px solid #ddd;
}

.liste table th:first-child,
.liste table td:first-child {
    border-left: none;
}

.liste table th:last-child,
.liste table td:last-child {
    border-right: none;
}

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container">
    <div class="nav">
      <img src="img/logo_bgb.png" alt="">
      <div class="buttons">
        <button class="active" onclick="window.location.href = 'liste.php'"><i class="fa-solid fa-list"></i>LISTE DES MEMBRES</button>
        <button onclick="window.location.href = 'ajouter.php'"><i class="fa-solid fa-plus"></i>AJOUTER UN MEMBRE</button>
        <button onclick="window.location.href = 'recherche.php'"><i class="fa-solid fa-magnifying-glass"></i>RECHERCHE</button>
      </div>
      <div class="administrateur">
        <h3>Administrateur</h3>
        <?php
        // Affichage du nom de l'administrateur s'il est présent dans la session
        if(isset($_SESSION['nom_admin'])) {
          echo "<span>{$_SESSION['nom_admin']}</span>";
        }
        ?>
      </div>
      <div class="logout">
        <a href="accueil.php"><i class="fa-solid fa-right-from-bracket"></i>DECONNEXION</a>
      </div>
    </div>
    <div class="liste">
      <h1>LISTE DES MEMBRES</h1>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>MATRICULE</th>
              <th>GRADE</th>
              <th>NOM</th>
              <th>PRENOM</th>
              <th>COMPAGNIE</th>
            </tr>
          </thead>
          <tbody>
          <?php
// Afficher les membres dans le tableau
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "<tr class='member' onclick='window.location.href = \"info-plus.php?matricule={$row['matricule']}\"'>";
    echo "<td>" . $row['matricule'] . "</td>";
    echo "<td>" . $row['grade'] . "</td>";
    echo "<td>" . $row['nom'] . "</td>";
    echo "<td>" . $row['prenom'] . "</td>";
    echo "<td>" . $row['compagnie'] . "</td>";
    echo "</tr>";
}

          ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
</body>
<html>