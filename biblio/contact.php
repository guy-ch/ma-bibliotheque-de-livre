<?php
session_start();
include "connexion.php";

$success = "";
$error = "";

// TRAITEMENT DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])) {

        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        mysqli_query($conn, "INSERT INTO messages_contact (nom, email, message)
                              VALUES ('$nom','$email','$message')");

        mail(
            "guyaziada21@gmail.com",
            "Nouveau message - UNILIBRARY",
            "Nom : $nom\nEmail : $email\n\nMessage :\n$message",
            "From:$email"
        );

        $success = "Message envoyé avec succès. Nous vous répondrons bientôt.";
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Contact | UNILIBRARY</title>

<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f4f6f8}

/* ===== HEADER ===== */
header{
    background:rgb(4,4,73);
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

header h1{color:white}

/* NAV */
nav ul{
    list-style:none;
    display:flex;
    gap:20px;
}

ul{
   
    padding-right:40rem ;
}

nav ul li a{
    text-decoration:none;
    color:gainsboro;
    font-weight:bold;
}

nav ul li a:hover{color:#ff6600}

/* ===== CONTENEUR ===== */
.container{
    max-width:900px;
    margin:50px auto;
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.container h2{text-align:center;color:#0066cc;margin-bottom:20px}

/* FORM */
form{max-width:500px;margin:auto; margin-bottom: 9rem;}

input,textarea{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}

textarea{height:140px;resize:none}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:25px;
    background:darkgreen;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover{background:#ff6600}

/* MESSAGES */
.success{background:#28a745;color:white;padding:12px;border-radius:8px;margin-bottom:15px}
.error{background:#dc3545;color:white;padding:12px;border-radius:8px;margin-bottom:15px}

/* FOOTER */
footer{
    background:#222;
    color:white;
    text-align:center;
    padding:20px;
    margin-top:50px;
}

/* RESPONSIVE */
@media(max-width:700px){
    header{flex-direction:column;gap:15px}
    nav ul{flex-direction:column;align-items:center}
}
</style>
</head>

<body>

<header>
    <h1>UNILIBRARY</h1>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="livre.php">Livres</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="wishlist.php">Ma liste</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Contactez-nous</h2>

    <?php if($success): ?><div class="success"><?= $success ?></div><?php endif; ?>
    <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="post">
        <input type="text" name="nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <textarea name="message" placeholder="Votre message..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>

<footer>
    © 2026 BIBLIOTHÈQUE UNILIBRARY | Tous droits réservés
</footer>

</body>
</html>
