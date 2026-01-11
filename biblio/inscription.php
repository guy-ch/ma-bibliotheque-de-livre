<?php
session_start();
include "connexion.php";

/* ===== TRAITEMENT DU FORMULAIRE ===== */
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

        if(isset($_SESSION['livre_a_ajouter'])){
            $id_livre = $_SESSION['livre_a_ajouter'];
            $checkLivre = mysqli_query($conn, "SELECT * FROM liste_lecture WHERE id_livre=$id_livre AND id_lecteur=$id_lecteur");
            if(mysqli_num_rows($checkLivre) == 0){
                mysqli_query($conn, "INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprunt)
                VALUES ($id_livre, $id_lecteur, CURDATE())");
            }
            unset($_SESSION['livre_a_ajouter']);
        }

        $_SESSION['success_message'] = "Compte créé avec succès !";
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

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:Arial, sans-serif;
    background:#f4f4f4;
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

/* ===== HEADER ===== */
header#navigation{
    background:rgb(4, 4, 73);
    padding:12px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo img{width:45px;}
.logo h1{color:white;font-size:20px;}

#menu{
    display:flex;
    align-items:center;
    gap:25px;
    flex-wrap:wrap;
}

.list ul{
    list-style:none;
    display:flex;
    gap:18px;
}

.list ul li a{
    text-decoration:none;
    color:gainsboro;
    font-weight:bold;
}

.list ul li a:hover{color:#ff6600;}

.rech form{
    display:flex;
    gap:8px;
}

.rech input{
    padding:8px;
    border-radius:6px;
    border:1px solid #ccc;
}

.rech button{
    padding:8px 12px;
    border:none;
    border-radius:6px;
    background:darkgreen;
    color:white;
    cursor:pointer;
}

.rech button:hover{background:#ff6600;}

/* ===== CONTENU ===== */
.main-container{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px 15px;
}

form{
    background:white;
    padding:30px 25px;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.15);
    width:320px;
    text-align:center;
}

form h2{
    margin-bottom:20px;
}

input{
    width:100%;
    padding:11px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
    text-align:center;
}

input:focus{
    outline:none;
    border-color:#0066cc;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:darkgreen;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#ff6600;
}

/* ===== MESSAGES ===== */
.message{
    padding:10px;
    margin-bottom:15px;
    border-radius:8px;
    font-weight:bold;
}

.success{background:#28a745;color:white;}
.error{background:#dc3545;color:white;}
.info{background:#17a2b8;color:white;}

/* ===== FOOTER ===== */
footer{
    text-align:center;
    padding:15px;
    font-size:14px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:600px){
    header#navigation{
        flex-direction:column;
        gap:15px;
        text-align:center;
    }

    .list ul{
        flex-direction:column;
        gap:10px;
    }

    .rech form{
        flex-direction:column;
        width:100%;
    }

    .rech input,
    .rech button{
        width:100%;
    }
}
</style>
</head>

<body>

<header id="navigation">
    <div class="logo">
        <img src="UNILIBRARY.png" alt="logo">
        <h1>UNILIBRARY</h1>
    </div>

    <nav id="menu">
        <div class="list">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="livre.php">Livres</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="contact.php">Contacts</a></li>
            </ul>
        </div>

        <div class="rech">
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
    <p>© 2026 BIBLIOTHÈQUE UNILIBRARY | Tous droits réservés</p>
</footer>

</body>
</html>
