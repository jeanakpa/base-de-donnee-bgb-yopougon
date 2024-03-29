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
    max-height: 80vh; /* Ajustez la hauteur maximale en fonction de vos besoins */
    width: 100%;
    margin-top: 20px;
}

.table-container .buttons{
    border: 1px solid #3c3c3c;
    position: relative;
    width: 35%;
    margin-left: 32.5%;
    margin-top: 40px;
    padding: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
}

.table-container button{
    position: relative;
    width: 95%;
    background-color: #15C150;
    padding: 12px 5px;
    border: none;
    margin-top: 5px;
    margin-bottom: 5px;
    color: #fff;
    border-radius: 21px;
    cursor: pointer;
}
        </style>
        <link rel="stylesheet" href="recherche.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="container">
            <div class="nav">
                <img src="img/logo_bgb.png" alt="">
                <div class="buttons">
                    <button onclick="window.location.href = 'liste.php'"><i class="fa-solid fa-list"></i>LISTE DES MEMBRES</button>
                    <button onclick="window.location.href = 'ajouter.php'"><i class="fa-solid fa-plus"></i>AJOUTER UN MEMBRE</button>
                    <button class="active" onclick="window.location.href = 'recherche.php'"><i class="fa-solid fa-magnifying-glass"></i>RECHERCHE</button>
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
                <h1>EFFECTUER UNE RECHERCHE</h1>
                <div class="table-container">
                    <!-- Boutons de recherche -->
                    <div class="buttons">
    <button onclick="window.location.href = 'recherche-par.php?type=matricule'">RECHERCHER PAR MATRICULE</button>
    <button onclick="window.location.href = 'recherche-par.php?type=grade'">RECHERCHER PAR GRADE</button>
    <button onclick="window.location.href = 'recherche-par.php?type=nom'">RECHERCHER PAR NOM</button>
    <button onclick="window.location.href = 'recherche-par.php?type=compagnie'">RECHERCHER PAR COMPAGNIE</button>
    <button onclick="window.location.href = 'recherche-par.php?type=legion'">RECHERCHER PAR LEGION</button>
    <button onclick="window.location.href = 'recherche-par.php?type=date_de_naissance'">RECHERCHER PAR DATE DE NAISSANCE</button>
    <button onclick="window.location.href = 'recherche-par.php?type=fonction_compagnie'">RECHERCHER PAR FONCTION</button>
</div>

                </div>
            </div>
        </div>
    </body>
    </html>
