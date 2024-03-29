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
    <link rel="stylesheet" href="ajouter.css">
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

form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="tel"],
input[type="date"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form button {
    background-color: #15C150;
    color: #fff;
    position: relative;
    width: 40%;
    padding: 10px;
    align-items: center;
    margin-left: 30%;
    margin-top: 30px;
    margin-bottom: 10px;
    border: none;
    border-radius: 21px;
    cursor: pointer;
}

form button i{
    padding-right: 10px;
}

.choice {
    display: flex;
    flex-wrap: wrap;
}

.choice div {
    flex: 1 0 50%; /* 2 items per row */
}

.resp {
    margin-top: 20px;
    border-top: 1px solid #ccc;
    padding-top: 20px;
}

/* Style checkboxes */
input[type="checkbox"] {
    display: none;
}

input[type="checkbox"] + label {
    display: inline-block;
    margin-right: 10px;
    cursor: pointer;
    font-weight: 300;
}

input[type="checkbox"] + label:before {
    content: "";
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-right: 5px;
    margin-top: 5px;
}

input[type="checkbox"]:checked + label:before {
    background-color: #007bff;
}

/* Style select */
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.select{
    margin-top: 20px;
}
label{
    color: #000;
    font-weight: 500;
}

input[type="text"] {
    text-transform: uppercase;
  }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="nav">
            <img src="img/logo_bgb.png" alt="">
            <div class="buttons">
                <button onclick="window.location.href = 'liste.php'"><i class="fa-solid fa-list"></i>LISTE DES MEMBRES</button>
                <button class="active" onclick="window.location.href = 'ajouter.php'"><i class="fa-solid fa-plus"></i>AJOUTER UN MEMBRE</button>
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
            <h1>AJOUTER UN MEMBRE</h1>
            <div class="table-container">
                <form action="traitement_ajout_membre.php" method="POST">
                    <label for="grade" class="select">GRADE</label>
                    <select name="grade" id="grade" class="grade" required>
                        <option value="SOLDAT">SOLDAT</option>
                        <option value="CAPORAL">CAPORAL</option>
                        <option value="CAPORAL CHEF">CAPORAL CHEF</option>
                        <option value="SERGENT">SERGENT</option>
                        <option value="SERGENT CHEF">SERGENT CHEF</option>
                        <option value="ADJUDANT">ADJUDANT</option>
                        <option value="ADJUDANT CHEF">ADJUDANT CHEF</option>
                        <option value="SOUS LIEUTENANT">SOUS LIEUTENANT</option>
                        <option value="LIEUTENANT">LIEUTENANT</option>
                        <option value="CAPITAINE">CAPITAINE</option>
                        <option value="COMMANDANT">COMMANDANT</option>
                        <option value="LIEUTENANT COLONEL">LIEUTENANT COLONEL</option>
                        <option value="COLONEL">COLONEL</option>
                        <!-- Ajoutez d'autres options de grade ici si nécessaire -->
                    </select>

                    <div class="block">
                        <div>
                            <label for="nom">NOM</label>
                            <input type="text" class="nom" id="nom" name="nom" placeholder="ENTREZ LE NOM" onkeyup="convertirEnMajuscules(this)">
                        </div>
                        <div>
                            <label for="prenom">PRENOM</label>
                            <input type="text" class="prenom" id="prenom" name="prenom" placeholder="ENTREZ LE PRENOM" onkeyup="convertirEnMajuscules(this)">
                        </div>
                        
                    </div>

                    <div class="block">
                        <div class="choice">
                            <label for="telephone">NUMERO DE TELEPHONE</label>
                            <input type="tel" class="telephone" id="telephone" name="telephone" placeholder="ENTREZ LE NUMERO DE TELEPHONE">
                        </div>
                        <div class="choice">
                            <label for="date">DATE DE NAISSANCE</label>
                            <input type="date" class="date" id="date" name="date" placeholder="DATE DE NAISSANCE">
                        </div>
                        
                    </div>

                    <label for="compagnie" class="select">COMPAGNIE</label>
                    <select name="compagnie" id="compagnie" class="compagnie" required>
                        <option value="" selected disabled>--SELECTIONNER UNE COMPAGNIE--</option>
                        <option value="BETHESDA NIANGON SUD">BETHESDA NIANGON SUD</option>
                        <option value="JEHOVAH JIREH NIANGON ADJAME">JEHOVAH JIREH NIANGON ADJAME</option>
                        <option value="SILO CAMP MILITAIRE">SILO CAMP MILITAIRE</option>
                        <option value="SILOE YOPOUGON ZONE INDUSTRIELLE">SILOE YOPOUGON ZONE INDUSTRIELLE</option>
                        <option value="EMMAUS YOPOUGON GARE">EMMAUS YOPOUGON GARE</option>
                        <option value="BEAGO">BEAGO</option>
                        <option value="EPHRATA NIANGON ATTIE">EPHRATA NIANGON ATTIE</option>
                        <option value="LOCODJRO">LOCODJRO</option>
                        <option value="ABOBODOUME">ABOBODOUME</option>
                        <option value="ADIPODOUME">ADIPODOUME</option>
                        <!-- Ajoutez d'autres options de compagnie ici si nécessaire -->
                    </select>

                    <!-- Responsabilité de compagnie -->
                    <div class="resp">
                        <label>RESPONSABILITE COMPAGNIE</label>
                        <div class="choice">
                            <div>
                                <input type="checkbox" id="responsable-compagnie" name="responsabilite-compagnie[]" value="1ER RESPONSABLE">
                                <label for="responsable-compagnie">1ER RESPONSABLE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="conseiller-compagnie" name="responsabilite-compagnie[]" value="CONSEILLER">
                                <label for="conseiller-compagnie">CONSEILLER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="adjoint-compagnie" name="responsabilite-compagnie[]" value="RESPONSABLE ADJOINT">
                                <label for="adjoint-compagnie">RESPONSABLE ADJOINT</label>
                            </div>
                            <div>
                                <input type="checkbox" id="secretaire-compagnie"name="responsabilite-compagnie[]" value="SECRETAIRE">
                                <label for="secretaire-compagnie">SECRETAIRE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tresorier-compagnie" name="responsabilite-compagnie[]" value="TRESORIER">
                                <label for="tresorier-compagnie">TRESORIER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="action-sociale-compagnie"name="responsabilite-compagnie[]" value="ACTION SOCIALE">
                                <label for="action-sociale-compagnie">ACTION SOCIALE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="communicateur-compagnie" name="responsabilite-compagnie[]" value="COMMUNICATEUR">
                                <label for="communicateur-compagnie">COMMUNICATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="commissaire-compagnie" name="responsabilite-compagnie[]" value="COMMISSAIRE AUX COMPTES">
                                <label for="commissaire-compagnie">COMMISSAIRE AUX COMPTES</label>
                            </div>
                            <div>
                                <input type="checkbox" id="formateur-compagnie" name="responsabilite-compagnie[]" value="FORMATEUR">
                                <label for="formateur-compagnie">FORMATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="boys-compagnie" name="responsabilite-compagnie[]" value="RESPONSABLE BOYS">
                                <label for="boys-compagnie">RESPONSABLE BOYS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="girls-compagnie" name="responsabilite-compagnie[]" value="RESPONSABLE GIRLS">
                                <label for="girls-compagnie">RESPONSABLE GIRLS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="organisateur-compagnie" name="responsabilite-compagnie[]" value="ORGANISATEUR">
                                <label for="organisateur-compagnie">ORGANISATEUR</label>
                            </div>
                        </div>
                        <!-- Ajoutez d'autres responsabilités de compagnie ici si nécessaire -->
                    </div>

                    <label for="legion" class="select">LEGION</label>
                    <select name="legion" id="legion" class="legion" required>
                        <option value="" selected disabled>--SELECTIONNER UNE LEGION--</option>
                        <option value="NIANGON">NIANGON</option>
                        <option value="YOPOUGON">YOPOUGON</option>
                        <!-- Ajoutez d'autres options de légion ici si nécessaire -->
                    </select>

                    <!-- Responsabilité de légion -->
                    <div class="resp">
                        <label>RESPONSABILITE LEGION</label>
                        <div class="choice">
                            <div>
                                <input type="checkbox" id="responsable-legion" name="responsabilite-legion[]" value="1ER RESPONSABLE">
                                <label for="responsable-legion">1ER RESPONSABLE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="conseiller-legion" name="responsabilite-legion[]" value="CONSEILLER">
                                <label for="conseiller-legion">CONSEILLER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="adjoint-legion" name="responsabilite-legion[]" value="RESPONSABLE ADJOINT">
                                <label for="adjoint-legion">RESPONSABLE ADJOINT</label>
                            </div>
                            <div>
                                <input type="checkbox" id="secretaire-legion"name="responsabilite-legion[]" value="SECRETAIRE">
                                <label for="secretaire-legion">SECRETAIRE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tresorier-legion" name="responsabilite-legion[]" value="TRESORIER">
                                <label for="tresorier-legion">TRESORIER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="action-sociale-legion"name="responsabilite-legion[]" value="ACTION SOCIALE">
                                <label for="action-sociale-legion">ACTION SOCIALE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="communicateur-legion" name="responsabilite-legion[]" value="COMMUNICATEUR">
                                <label for="communicateur-legion">COMMUNICATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="commissaire-legion" name="responsabilite-legion[]" value="COMMISSAIRE AUX COMPTES">
                                <label for="commissaire-legion">COMMISSAIRE AUX COMPTES</label>
                            </div>
                            <div>
                                <input type="checkbox" id="formateur-legion" name="responsabilite-legion[]" value="FORMATEUR">
                                <label for="formateur-legion">FORMATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="boys-legion" name="responsabilite-legion[]" value="RESPONSABLE BOYS">
                                <label for="boys-legion">RESPONSABLE BOYS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="girls-legion" name="responsabilite-legion[]" value="RESPONSABLE GIRLS">
                                <label for="girls-legion">RESPONSABLE GIRLS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="organisateur-legion" name="responsabilite-legion[]" value="ORGANISATEUR">
                                <label for="organisateur-legion">ORGANISATEUR</label>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Responsabilité de bataillon -->
                    <div class="resp">
                        <label>RESPONSABILITE BATAILLON</label>
                        <div class="choice">
                            <div>
                                <input type="checkbox" id="responsable-bataillon" name="responsabilite-bataillon[]" value="1ER RESPONSABLE">
                                <label for="responsable-bataillon">1ER RESPONSABLE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="conseiller-bataillon" name="responsabilite-bataillon[]" value="CONSEILLER">
                                <label for="conseiller-bataillon">CONSEILLER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="adjoint-bataillon" name="responsabilite-bataillon[]" value="RESPONSABLE ADJOINT">
                                <label for="adjoint-bataillon">RESPONSABLE ADJOINT</label>
                            </div>
                            <div>
                                <input type="checkbox" id="secretaire-bataillon"name="responsabilite-bataillon[]" value="SECRETAIRE">
                                <label for="secretaire-bataillon">SECRETAIRE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tresorier-bataillon" name="responsabilite-bataillon[]" value="TRESORIER">
                                <label for="tresorier-bataillon">TRESORIER</label>
                            </div>
                            <div>
                                <input type="checkbox" id="action-sociale-legbataillonion"name="responsabilite-bataillon[]" value="ACTION SOCIALE">
                                <label for="action-sociale-bataillon">ACTION SOCIALE</label>
                            </div>
                            <div>
                                <input type="checkbox" id="communicateur-bataillon" name="responsabilite-bataillon[]" value="COMMUNICATEUR">
                                <label for="communicateur-bataillon">COMMUNICATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="commissaire-bataillon" name="responsabilite-bataillon[]" value="COMMISSAIRE AUX COMPTES">
                                <label for="commissaire-bataillon">COMMISSAIRE AUX COMPTES</label>
                            </div>
                            <div>
                                <input type="checkbox" id="formateur-bataillon" name="responsabilite-bataillon[]" value="FORMATEUR">
                                <label for="formateur-bataillon">FORMATEUR</label>
                            </div>
                            <div>
                                <input type="checkbox" id="boys-bataillon" name="responsabilite-bataillon[]" value="RESPONSABLE BOYS">
                                <label for="boys-bataillon">RESPONSABLE BOYS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="girls-bataillon" name="responsabilite-bataillon[]" value="RESPONSABLE GIRLS">
                                <label for="girls-bataillon">RESPONSABLE GIRLS</label>
                            </div>
                            <div>
                                <input type="checkbox" id="organisateur-bataillon" name="responsabilite-bataillon[]" value="ORGANISATEUR">
                                <label for="organisateur-bataillon">ORGANISATEUR</label>
                            </div>
                        </div>
                    </div>
                    
                    <button><i class="fa-solid fa-plus"></i>AJOUTER</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="info-plus.js"></script>
</body>
</html>
