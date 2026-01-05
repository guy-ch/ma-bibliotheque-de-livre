 <?php 
include("connexion.php")
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniLibrary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="biblio1.css">
    <script src="biblio.js" defert></script>
</head>
<body>
    <header id = "navigation">
        <div class= "logo">
            <img src="UNILIBRARY.png" alt="un logo montrant du livre ouvert">
            <h1>UNILIBRARY</h1>
        </div>
    <nav id="menu">
        <div class="list">
             <ul>
            <li><a href="#">Acceuil</a></li>
            <li><a href="livre.php">Livres</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="#">Contacts</a></li>
           </ul>
        </div>
          
        <div class = "rech">
           <form action="results.php" method="get">
    <input type="text" name="q" placeholder="Titre ou Auteur" required>
    <button type="submit">Rechercher</button>
</form>

            
         </div>
    </nav>
     

    </header>

    <main>
               
        <section id="acceuil">

             <h1>Bienvenue à La Bibliothèque Numérique UniLibrary</h1>
            <hr>

            <div class="ftitre">
                 <p class="texte">
                    UNILIBRARY est plateforme numerique qui  vous présente une large collection de livres accèssible facilement.
                    Notre plateforme vous permet de consulter, d'emprunter et rechercher
                    des ouvrages en toute simplicité.
               </p>

                <button>
                   <a href="livre.php" target="_blank">Voir Les Catalogues</a>
                </button>
            </div>

            <div class="grandeligne">
                <span class="ligne"></span>
                <h2>GUIDE D'UTILISATION</h2>
                <span class="ligne1"></span>
            </div>


            <div class="flotte">

        <div class="guidepart1">
            <img src="upload/images/image.png" alt="">
            <h4>Consulter les livres</h4>
            
            <p>
                Accéder aux catalogues et explorer les livres
                disponibles par catégories et auteurs.
            </p>
        </div>

        <div class="guidepart1">
             <img src="upload/images/utilisateur.png" alt="">
            <h4>Se connecter</h4>
            <p>
                Connectez-vous à votre espace 
                personnel et gérez vos emprunts.
            </p>
        </div>

        <div class="guidepart1">
             <img src="upload/images/emprunter.png" alt="">
            <h4>Emprunter un livre</h4> 
            <p>
                Sélectionnez un livre disponible
                et faites votre emprunt en un clic.
            </p>
        </div>

    </section>

    </main>

    <footer>
        <div>
            <p><i class="fa fa-registered" aria-hidden="true"></i>
                 2026 BIBLIOTHEQUE UNILIBRARY | Tous droits réservé </p>
        </div>
      
    </footer>

</body>
</html>