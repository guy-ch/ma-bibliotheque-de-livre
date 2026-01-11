<?php 
include("connexion.php")
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UniLibrary</title>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ===== GLOBAL ===== */
*{box-sizing:border-box;margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;}
body{background:#f5f6fa;color:#333;line-height:1.6;}
a{color:inherit;text-decoration:none;}

/* ===== HEADER ===== */
header{
    background:rgb(4, 4, 73);
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 40px;
    box-shadow:0 3px 15px rgba(0,0,0,0.05);
    flex-wrap:wrap;
    color: gainsboro;
}
header .logo{
    display:flex;
    align-items:center;
    gap:12px;
}
header .logo img{
    width:55px;
}
nav{display:flex;}
header nav ul{
    display:flex;
    gap:25px;
    list-style:none;
}
header nav ul li a{
    font-weight:600;
    padding:8px 12px;
    border-radius:6px;
    transition:0.3s;
}
header nav ul li a:hover{
    background:#ff6600;
    color:#fff;
}

/* ===== RECHERCHE ===== */
.rech form{
    padding-left: 1rem;
    display:flex;
    gap:5px;
}
.rech input{
    padding:6px 10px;
    border-radius:6px;
    border:1px solid #ccc;
}
.rech button{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    background:#006400;
    color:white;
    font-weight:bold;
    transition:0.3s;
}
.rech button:hover{background:#ff6600;}

/* ===== SECTION ACCUEIL ===== */
#acceuil{
    text-align:center;
    padding:60px 20px;
    background:linear-gradient(to right,#ffffff,#e8f0fe);
}
#acceuil h1{
    font-size:2.8rem;
    margin-bottom:20px;
    color:#1a1a1a;
}
#acceuil p{
    max-width:700px;
    margin:20px auto;
    font-size:1.1rem;
}
#acceuil button{
    margin-top:25px;
    padding:15px 30px;
    font-size:1rem;
    border:none;
    border-radius:30px;
    background:#006400;
    color:white;
    font-weight:bold;
    transition:0.3s;
}
#acceuil button:hover{
    background:#ff6600;
}

/* ===== GUIDE D'UTILISATION ===== */
.grandeligne{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:15px;
    margin:50px 0 40px 0;
    flex-wrap:wrap;
}
.grandeligne .ligne,.grandeligne .ligne1{
    flex:1;
    height:2px;
    background:#ccc;
}
.grandeligne h2{margin:0 15px;font-size:1.8rem;}

.flotte{
    display:flex;
    gap:30px;
    justify-content:center;
    flex-wrap:wrap;
    padding-bottom:50px;
}
.guidepart1{
    background:#fff;
    padding:25px;
    width:270px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    transition:transform 0.3s;
    text-align:center;
}
.guidepart1:hover{
    transform:translateY(-8px);
}
.guidepart1 img{
    width:90px;
    margin-bottom:15px;
}
.guidepart1 h4{
    color:#0066cc;
    margin-bottom:10px;
    font-size:1.2rem;
}
.guidepart1 p{
    font-size:0.95rem;
}

/* ===== FOOTER ===== */
footer{
    background:rgb(4, 4, 73);
    color:#fff;
    text-align:center;
    padding:25px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    header nav ul{
        flex-direction:column;
        gap:12px;
    }
    .flotte{
        flex-direction:column;
        align-items:center;
    }
    .guidepart1{width:80%;}
    #acceuil button{width:70%;}
}
</style>
</head>

<body>

<header>
    <div class="logo">
        <img src="UNILIBRARY.png" alt="Logo UniLibrary">
        <h1>UNILIBRARY</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="livre.php">Livres</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="contact.php">Contacts</a></li>
             <li><a href="wishlist.php">Ma Liste</a></li>
        </ul>
        <div class="rech">
            <form action="results.php" method="get">
                <input type="text" name="q" placeholder="Titre ou Auteur" required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </nav>
</header>

<main>
<section id="acceuil">
    <h1>Bienvenue à UniLibrary</h1>
    <p>Découvrez une vaste collection de livres numériques. Accédez, consultez, et empruntez vos ouvrages préférés facilement et rapidement.</p>
    <button><a href="livre.php">Voir les catalogues</a></button>

    <div class="grandeligne">
        <span class="ligne"></span>
        <h2>GUIDE D'UTILISATION</h2>
        <span class="ligne1"></span>
    </div>

    <div class="flotte">
        <div class="guidepart1">
            <img src="upload/images/image.png" alt="Consulter les livres">
            <h4>Consulter les livres</h4>
            <p>Explorez les livres par catégories et auteurs.</p>
        </div>

        <div class="guidepart1">
            <img src="upload/images/utilisateur.png" alt="Se connecter">
            <h4>Se connecter</h4>
            <p>Accédez à votre espace personnel pour gérer vos emprunts.</p>
        </div>

        <div class="guidepart1">
            <img src="upload/images/emprunter.png" alt="Emprunter">
            <h4>Emprunter</h4>
            <p>Sélectionnez un livre disponible et empruntez-le en un clic.</p>
        </div>
    </div>
</section>
</main>

<footer>
    <p><i class="fa fa-registered"></i> 2026 BIBLIOTHÈQUE UNILIBRARY | Tous droits réservés</p>
</footer>

</body>
</html>
