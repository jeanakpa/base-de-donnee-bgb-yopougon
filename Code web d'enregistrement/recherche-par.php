<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['code'])) {
    // Redirection vers la page d'accueil si non connecté
    header('Location: accueil.html');
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

// Requête SQL pour récupérer tous les membres
$sql = "SELECT matricule, grade, nom, prenom, compagnie, legion, fonction_compagnie, date_de_naissance FROM membre";
$resultat = mysqli_query($connexion, $sql);

$type = isset($_GET['type']) ? $_GET['type'] : '';

// Mettre à jour le titre de la page en fonction du type de recherche
switch ($type) {
    case 'matricule':
        $titre = "EFFECTUER UNE RECHERCHE PAR MATRICULE";
        break;
    case 'grade':
        $titre = "EFFECTUER UNE RECHERCHE PAR GRADE";
        break;
    case 'nom':
        $titre = "EFFECTUER UNE RECHERCHE PAR NOM";
        break;
    case 'compagnie':
        $titre = "EFFECTUER UNE RECHERCHE PAR COMPAGNIE";
        break;
    case 'legion':
        $titre = "EFFECTUER UNE RECHERCHE PAR LEGION";
        break;
    case 'date_de_naissance':
        $titre = "EFFECTUER UNE RECHERCHE PAR DATE DE NAISSANCE";
        break;
    case 'fonction_compagnie':
        $titre = "EFFECTUER UNE RECHERCHE PAR FONCTION";
        break;
    default:
        $titre = "RECHERCHE";
}

?>

<!DOCTYPE html>
<html lang="en">
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
    display: flex;
    flex-direction: row;
    gap: 5%;
    height: 100vh; /* Ensures the container fills the viewport */
  }
.nav{
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #fff;
    box-shadow: #3c3c3c 0.1px 0.1px 5px;
    height: 95vh;
    top: 2.5vh;
    position: fixed;
    width: 20%;
    margin-left: 2%;
    border-radius: 21px;
}

.nav img{
    height: 70px;
    width: 70px;
    margin-top: 20px;
}

.nav .buttons{
    margin-top: 30px;
    display: flex;
    flex-direction: column;
    position: relative;
    width: 80%;
    gap: 10px;
}
.nav .buttons button{
    padding: 10px;
    border-radius: 21px;
    border: none;
    background-color: #15C150;
    color: #fff;
    text-align: start;
    padding-left: 20px;
    cursor: pointer;
}
.nav .buttons button:hover{
    background-color: #0a963b;
}

button:hover{
    background-color: #0a963b;
}
.nav .buttons .active{
    padding: 10px;
    border-radius: 21px;
    border: 1px solid #15C150;
    background-color: #fff;
    color: #15C150;
    padding-left: 20px;
}
.nav .buttons .active:hover{
    background-color: #fff;
}
.nav i{
    padding-right: 10px;
}


.nav .administrateur{
    margin-top: 180px;
    text-align: center;
}
.nav .administrateur h3{
    font-weight: 400;
}
.nav .administrateur span{
    font-weight: 500;
    color: #697BBD;
}
.nav .logout{
    margin-top: 50px;
}
.nav .logout a{
    color: #CE2121;
    font-weight: 500;
    text-decoration: none;
}





.liste {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #fff;
    box-shadow: #3c3c3c 0.1px 0.1px 5px;
    position: fixed; /* Rendre la div fixe */
    width: 72%;
    margin-left: 25%;
    margin-right: 3%;
    min-height: 95vh;
    top: 2.5vh;
    margin-right: 2%;
    border-radius: 21px;
}

.liste h1{
    font-size: 20px;
    margin-top: 15px;
}

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

.table-container {
    overflow-y: auto;
    max-height: 80vh; /* Ajustez la hauteur maximale en fonction de vos besoins */
    width: 100%;
    margin-top: 20px;
}

.recherche{
    position: relative;
    width: 50%;
    display: flex;
    align-items: center;
    right: 5px;
    margin-top: 10px;
    justify-content: center;
}


.recherche i{
    position: relative;
    left: 35px;
    z-index: 1100;
    color: #15C150;
    font-size: 20px;
    top: 5px;
}


.recherche input{
    position: relative;
    width: 100%;
    border: 2px solid #15C150;
    padding: 10px;
    border-radius: 21px;
    padding-left: 50px;
    font-size: 18px;
}
.recherche input::placeholder{
    color: #15C150;
    font-size: 13px;
}
    </style>
    <link rel="stylesheet" href="recherche-par.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="nav">
            <img src="img/logo_bgb.png" alt="">
            <div class="buttons">
                <button onclick="window.location.href = 'liste.php'"><i class="fa-solid fa-list"></i>LISTE DES MEMBRES</button>
                <button onclick="window.location.href = 'ajouter.php'"><i class="fa-solid fa-plus"></i>AJOUTER UN MEMBRE</button>
                <button  class="active" onclick="window.location.href = 'recherche.php'"><i class="fa-solid fa-magnifying-glass"></i>RECHERCHE</button>
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
            <h1 id="titre"><?php echo $titre; ?></h1>
            <div class="recherche">
    <i class="fa-solid fa-magnifying-glass"></i>
    <?php if ($type !== 'date_de_naissance') { ?>
        <input type="text" class="recherche" id="recherche" name="recherche" placeholder="RECHERCHE..." >
    <?php } else { ?>
        <input type="date" id="recherche" name="recherche">
    <?php } ?>
</div>


            
            <div class="table-container">
        <table id="resultats">
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
// Afficher tous les membres dans le tableau
while ($row = mysqli_fetch_assoc($resultat)) {
    echo "<tr class='member' onclick='window.location.href = \"info-plus.php?matricule={$row['matricule']}\"'>";
    echo "<td>" . $row['matricule'] . "</td>";
    echo "<td>" . $row['grade'] . "</td>";
    echo "<td>" . $row['nom'] . "</td>";
    echo "<td>" . $row['prenom'] . "</td>";
    echo "<td>" . $row['compagnie'] . "</td>";
    echo "<td style='display:none'>" . $row['legion'] . "</td>";
    echo "<td style='display:none'>" . $row['fonction_compagnie'] . "</td>";
    echo "<td style='display:none'>" . $row['date_de_naissance'] . "</td>";
    echo "</tr>";
}

          ?>
          </tbody>
        </table>
      </div>
                
        </div>
    </div>

    <script>
document.getElementById('recherche').addEventListener('input', function() {
    var recherche = this.value.toUpperCase();
    var table = document.getElementById('resultats');
    var lignes = table.getElementsByTagName('tr');
    var titre = document.getElementById('titre');
    
    for (var i = 0; i < lignes.length; i++) {
        // Index de la colonne selon le type de recherche
        var indexColonne;

        // Déterminer l'index de la colonne en fonction du titre
        switch (titre.textContent) {
            case "EFFECTUER UNE RECHERCHE PAR NOM":
                indexColonne = 2; // Index de la colonne du nom
                break;
            case "EFFECTUER UNE RECHERCHE PAR MATRICULE":
                indexColonne = 0; // Index de la colonne du matricule
                break;
            case "EFFECTUER UNE RECHERCHE PAR GRADE":
                indexColonne = 1; // Index de la colonne du grade
                break;
            case "EFFECTUER UNE RECHERCHE PAR COMPAGNIE":
                indexColonne = 4; // Index de la colonne de la compagnie
                break;
            case "EFFECTUER UNE RECHERCHE PAR LEGION":
                indexColonne = 5; // Index de la colonne de la légion
                break;
            case "EFFECTUER UNE RECHERCHE PAR FONCTION":
                indexColonne = 6; // Index de la colonne de la fonction
                break;
            case "EFFECTUER UNE RECHERCHE PAR DATE DE NAISSANCE":
                indexColonne = 7; // Index de la colonne de la date de naissance
                break;
            default:
                break;
        }

        // Récupérer la cellule correspondante dans la ligne
        var cellule = lignes[i].getElementsByTagName('td')[indexColonne];
        if (cellule) {
            var contenu = cellule.textContent || cellule.innerText;
            // Comparer le contenu avec la recherche et afficher ou masquer la ligne
            if (contenu.toUpperCase().indexOf(recherche) > -1) {
                lignes[i].style.display = '';
            } else {
                lignes[i].style.display = 'none';
            }
        }
    }


    var inputDate = document.getElementById('recherche');

    // Ajouter un écouteur d'événement pour l'événement input
    inputDate.addEventListener('input', function() {
        // Récupérer la valeur saisie dans le champ de date
        var valeur = inputDate.value;
        // Convertir la valeur en majuscules
        var valeurMajuscules = valeur.toUpperCase();
        // Mettre à jour la valeur du champ de date avec la valeur en majuscules
        inputDate.value = valeurMajuscules;
    });
});
</script>


</body>
</html>
