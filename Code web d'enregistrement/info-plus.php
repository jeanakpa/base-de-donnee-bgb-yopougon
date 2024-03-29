

<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['code'])) {
    // Redirection vers la page d'accueil si non connecté
    header('Location: accueil.html');
    exit();
}

// Récupérer le matricule du membre passé en URL
$matricule = isset($_GET['matricule']) ? $_GET['matricule'] : '';

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

// Requête SQL pour récupérer les informations du membre à partir du matricule
$sql = "SELECT * FROM membre WHERE matricule='$matricule'";
$resultat = mysqli_query($connexion, $sql);

// Vérifier si le membre existe
if (mysqli_num_rows($resultat) > 0) {
    // Récupérer les informations du membre
    $membre = mysqli_fetch_assoc($resultat);
} else {
    // Redirection vers la liste des membres si le membre n'existe pas
    header('Location: liste.php');
    exit();
}

?>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGB</title>
    <link rel="stylesheet" href="info-plus.css">
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

.table-container {
    overflow-y: auto;
    max-height: 70vh; /* Ajustez la hauteur maximale en fonction de vos besoins */
    width: 50%;
    margin-top: 20px;
    border: 1px #000 solid;
    border-radius: 20px;
    padding: 35px;
}
.table-container .info {
    display: flex;
    justify-content: space-between; /* Aligne les éléments sur les extrémités */
    position: relative;
    width: 100%;
}

.table-container hr {
    margin-bottom: 10px;
    margin-top: 5px;
}

.table-container .info p {
    text-align: left;
}

.table-container span {
    color: #15C150;
    text-align: right;
}

.liste button{
    background-color: #15C150;
    display: flex;
    border-radius: 21px;
    border: none;
    color: #fff;
    width: 20%;
    text-align: center;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-top: 15px;
    cursor: pointer;
    margin-bottom: 5px;
}

.liste button i{
    padding-right: 10px;
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
        <h1>INFORMATIONS DE MEMBRE</h1>
        <div class="table-container">
            <div class="info">
                <p>MATRICULE : </p>
                <span><?php echo $membre['matricule']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>GRADE : </p>
                <span><?php echo $membre['grade']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>NOM : </p>
                <span><?php echo $membre['nom']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>PRENOM : </p>
                <span><?php echo $membre['prenom']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>DATE DE NAISSANCE : </p>
                <span><?php echo $membre['date_de_naissance']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>TELEPHONE : </p>
                <span><?php echo $membre['telephone']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>COMPAGNIE : </p>
                <span><?php echo $membre['compagnie']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>RESP. COMP. : </p>
                <span><?php echo $membre['fonction_compagnie']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>LEGION : </p>
                <span><?php echo $membre['legion']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>RESP. LEG. : </p>
                <span><?php echo $membre['fonction_legion']; ?></span>
            </div>
            <hr>
            <div class="info">
                <p>RESP. BAT. : </p>
                <span><?php echo $membre['fonction_bataillon']; ?></span>
            </div>
            </div>

            <button onclick="confirmerSuppression('<?php echo $membre['matricule']; ?>', '<?php echo $membre['grade']; ?>', '<?php echo $membre['nom']; ?>', '<?php echo $membre['prenom']; ?>', '<?php echo $membre['compagnie']; ?>')"><i class="fa-solid fa-trash-can"></i>SUPPRIMER</button>

    </div>
        
    </div>
    <script src="info-plus.js"></script>
</body>
</html>
