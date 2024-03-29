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

.buttons button{
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
    </style>
    <link rel="stylesheet" href="accueil.css">
</head>
<body>
    <div class="container">
        <img src="img/logo_bgb.png" alt="">
        <div class="buttons">
            <button onclick="window.location.href = 'liste-simple.html'">LISTE DES MEMBRES</button>
            <button onclick="window.location.href = 'connexion.php'">ADMINISTRATEUR</button>
        </div>
    </div>
</body>
</html>