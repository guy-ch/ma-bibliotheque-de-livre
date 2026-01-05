<?php
session_start();
include "connexion.php";

$success = "";
$error = "";

// TRAITEMENT DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        !empty($_POST['nom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['message'])
    ) {
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // 1️⃣ STOCKAGE EN BASE
        $sql = "INSERT INTO messages_contact (nom, email, message)
                VALUES ('$nom', '$email', '$message')";
        mysqli_query($conn, $sql);

        // 2️⃣ ENVOI EMAIL RÉEL
        $to = "guyaziada21@gmail.com";
        $subject = "📩 Nouveau message - UNILIBRARY";
        $body = "Nom : $nom\nEmail : $email\n\nMessage :\n$message";
        $headers = "From: $email";

        mail($to, $subject, $body, $headers);

        $success = "✅ Message envoyé avec succès. Nous vous répondrons bientôt.";
    } else {
        $error = "❌ Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Contact | UNILIBRARY</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}

body{
    font-family:Arial, sans-serif;
    background:#f4f6f8;
}

/* HEADER */
header{
    background:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

header h1{
    color:#0066cc;
}

/* CONTENEUR */
.container{
    max-width:900px;
    margin:50px auto;
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.container h2{
    text-align:center;
    margin-bottom:20px;
    color:#0066cc;
}

/* INFOS */
.infos{
    text-align:center;
    margin-bottom:30px;
    font-size:1.05em;
}

.infos p{
    margin:8px 0;
}

/* FORMULAIRE */
form{
    max-width:500px;
    margin:auto;
}

input, textarea{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:1em;
}

textarea{
    resize:none;
    height:140px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:25px;
    background:linear-gradient(135deg,#0a7d2c,#12b954);
    color:white;
    font-size:1em;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:linear-gradient(135deg,#ff6600,#ff944d);
}

/* MESSAGES */
.success{
    background:#28a745;
    color:white;
    padding:12px;
    text-align:center;
    border-radius:8px;
    margin-bottom:20px;
}

.error{
    background:#dc3545;
    color:white;
    padding:12px;
    text-align:center;
    border-radius:8px;
    margin-bottom:20px;
}

/* FOOTER */
footer{
    margin-top:60px;
    padding:20px;
    background:#222;
    color:white;
    text-align:center;
}
</style>
</head>

<body>

<header>
    <h1>UNILIBRARY</h1>
</header>

<div class="container">
    <h2>📞 Contactez-nous</h2>

    <div class="infos">
        <p><strong>Email :</strong> guyaziada21@gmail.com</p>
        <p><strong>Téléphone :</strong> 70543778 / 98448122</p>
    </div>

    <?php if($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <textarea name="message" placeholder="Votre message..." required></textarea>
        <button type="submit">📩 Envoyer le message</button>
    </form>
</div>

<footer>
    <p>© 2026 BIBLIOTHÈQUE UNILIBRARY | Tous droits réservés</p>
</footer>

</body>
</html>
