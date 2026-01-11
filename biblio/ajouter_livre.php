<?php
session_start();
include "connexion.php";

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: index.php");
    exit;
}

// Récupérer les catégories pour le select
$catRes = mysqli_query($conn, "SELECT * FROM cathegorie ORDER BY nom");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $auteur = mysqli_real_escape_string($conn, $_POST['auteur']);
    $maison_edition = mysqli_real_escape_string($conn, $_POST['maison_edition']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $nombre_exemplair = (int)$_POST['nombre_exemplair'];
    $cathegorie_id = (int)$_POST['cathegorie_id'];

    // Upload image
    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid().".".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/images/".$image);
    }

    // Upload PDF
    $pdf = '';
    if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0){
        $ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
        $pdf = uniqid().".".$ext;
        move_uploaded_file($_FILES['pdf']['tmp_name'], "upload/pdfs/".$pdf);
    }

    mysqli_query($conn, "INSERT INTO livre (titre,auteur,maison_edition,description,nombre_exemplair,cathegorie_id,image,fichier_pdf)
                         VALUES ('$titre','$auteur','$maison_edition','$description',$nombre_exemplair,$cathegorie_id,'$image','$pdf')");
    header("Location: admin_livre.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter un livre | Admin</title>
<link rel="stylesheet" href="biblio1.css">
<style>
form{max-width:500px;margin:30px auto;padding:20px;background:white;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
input, textarea, select{width:100%;padding:10px;margin-bottom:15px;border-radius:6px;border:1px solid #ccc;}
button{padding:10px 20px;background:green;color:white;border:none;border-radius:6px;font-weight:bold;cursor:pointer;}
button:hover{background:#ff6600;}
</style>
</head>
<body>

<h2 style="text-align:center;"> Ajouter un livre</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre" required>
    <input type="text" name="auteur" placeholder="Auteur" required>
    <input type="text" name="maison_edition" placeholder="Maison d'édition">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="nombre_exemplair" placeholder="Nombre d'exemplaires" min="1" value="1" required>
    <select name="cathegorie_id" required>
        <option value="">-- Choisir une catégorie --</option>
        <?php while($cat = mysqli_fetch_assoc($catRes)) {
            echo "<option value='".$cat['id']."'>".htmlspecialchars($cat['nom'])."</option>";
        } ?>
    </select>
    <label>Image de couverture :</label>
    <input type="file" name="image" accept="image/*">
    <label>Fichier PDF :</label>
    <input type="file" name="pdf" accept="application/pdf">
    <button type="submit">Ajouter le livre</button>
</form>

</body>
</html>
