<?php
session_start();
include "connexion.php";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $check = mysqli_query($conn, "SELECT * FROM lecteurs WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $_SESSION['error_message'] = "Cet email est déjà utilisé.";
    } else {
        mysqli_query($conn, "INSERT INTO lecteurs (nom, prenom, email) VALUES ('$nom','$prenom','$email')");
        $id_lecteur = mysqli_insert_id($conn);
        $_SESSION['id_lecteur'] = $id_lecteur;

        // Ajouter le livre si existait en session
        if(isset($_SESSION['livre_a_ajouter'])){
            $id_livre = $_SESSION['livre_a_ajouter'];
            $checkLivre = mysqli_query($conn, "SELECT * FROM liste_lecture WHERE id_livre=$id_livre AND id_lecteur=$id_lecteur");
            if(mysqli_num_rows($checkLivre) == 0){
                mysqli_query($conn, "INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprun) VALUES ($id_livre, $id_lecteur, CURDATE())");
            }
            unset($_SESSION['livre_a_ajouter']);
        }

        $_SESSION['success_message'] = "Compte créé avec succès ! ✅";
        header("Location: wishlist.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription | UNILIBRARY</title>
<link rel="stylesheet" href="biblio1.css">
<style>
body {
    font-family: Arial, sans-serif;
    background:#f4f4f4;
    margin:0;
}

 /* HEADER */
header #navigation {
    
    background:rgb(4, 4, 73);
    padding:10px 20px;
    display:flex;
    align-items:center;
    justify-content: space-between;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

header#navigation .logo {
    display:flex;
    align-items:center;
    gap:10px;
}

header#navigation .logo img {
    width:40px;
}

header#navigation nav ul {
    
    list-style:none;
    display:flex;
     gap:15px;
    margin:0;
    padding:0;
}

header#navigation nav ul li a {
    
    text-decoration:none;
    color:#0066cc;
    font-weight:bold;
}

header#navigation nav ul li a:hover {
    color:#ff6600;
}

/* CONTENEUR PRINCIPAL */
.main-container {
    display:flex;
    justify-content:center;
    align-items:center;
    min-height: calc(100vh - 70px); /* 70px = hauteur approximative du header */
    padding:20px;
} 

/* FORMULAIRE */
form {
    text-align:center;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    width:300px;
}

input {
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #ccc;
    text-align:center;
}

button {
    width:100%;
    padding:10px;
    border:none;
    border-radius:6px;
    background:darkgreen;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover {
    background:#ff6600;
}

.message {
    padding:10px;
    margin-bottom:15px;
    border-radius:6px;
    font-weight:bold;
    text-align:center;
}

.success { background:#28a745; color:white; }
.error { background:#dc3545; color:white; }
.info { background:#17a2b8; color:white; }
</style>
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

<div class="main-container">
    <form method="post">
        <h2>Créer un compte</h2>

        <?php
        if(isset($_SESSION['success_message'])){
            echo "<div class='message success'>".$_SESSION['success_message']."</div>";
            unset($_SESSION['success_message']);
        }
        if(isset($_SESSION['error_message'])){
            echo "<div class='message error'>".$_SESSION['error_message']."</div>";
            unset($_SESSION['error_message']);
        }
        if(isset($_SESSION['info_message'])){
            echo "<div class='message info'>".$_SESSION['info_message']."</div>";
            unset($_SESSION['info_message']);
        }
        ?>

        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Créer mon compte</button>
    </form>
</div>


 <footer>
        <div>
            <p><i class="fa fa-registered" aria-hidden="true"></i>
                 2026 BIBLIOTHEQUE UNILIBRARY | Tous droits réservé </p>
        </div>
      
    </footer>

</body>
</html>
