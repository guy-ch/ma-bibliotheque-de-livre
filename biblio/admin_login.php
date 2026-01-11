<?php
session_start();
include "connexion.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $res = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");
    if(mysqli_num_rows($res) == 1){
        $admin = mysqli_fetch_assoc($res);
        if(password_verify($mot_de_passe, $admin['mot_de_passe'])){
            $_SESSION['admin'] = true;
            $_SESSION['admin_nom'] = $admin['nom'];
            header("Location: admin_livre.php");
            exit;
        }else{
            $error = "Mot de passe incorrect.";
        }
    }else{
        $error = "Email introuvable.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion Admin</title>
<style>
body{font-family:Arial; display:flex; justify-content:center; align-items:center; height:100vh; background:#f4f4f4;}
form{background:white; padding:25px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.1); width:300px; text-align:center;}
input{width:100%; padding:10px; margin-bottom:15px; border-radius:6px; border:1px solid #ccc;}
button{width:100%; padding:10px; border:none; border-radius:6px; background:darkgreen; color:white; font-weight:bold; cursor:pointer;}
button:hover{background:#ff6600;}
.error{color:white; background:red; padding:10px; border-radius:6px; margin-bottom:15px;}
</style>
</head>
<body>

<form method="post">
<h2>Connexion Admin</h2>
<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
<button type="submit">Se connecter</button>
</form>

</body>
</html>
