<?php
session_start();
include "connexion.php";

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: index.php");
    exit;
}

if(!isset($_GET['id'])) exit("ID manquant.");

$id = (int)$_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM livre WHERE id=$id");
$livre = mysqli_fetch_assoc($res);

$catRes = mysqli_query($conn, "SELECT * FROM cathegorie ORDER BY nom");

if($_SERVER['REQUEST_METHOD']==='POST'){
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $auteur = mysqli_real_escape_string($conn, $_POST['auteur']);
    $maison_edition = mysqli_real_escape_string($conn, $_POST['maison_edition']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $nombre_exemplair = (int)$_POST['nombre_exemplair'];
    $cathegorie_id = (int)$_POST['cathegorie_id'];

    // Image
    $image = $livre['image'];
    if(isset($_FILES['image']) && $_FILES['image']['error']==0){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid().".".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/images/".$image);
    }

    // PDF
    $pdf = $livre['fichier_pdf'];
    if(isset($_FILES['pdf']) && $_FILES['pdf']['error']==0){
        $ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
        $pdf = uniqid().".".$ext;
        move_uploaded_file($_FILES['pdf']['tmp_name'], "upload/pdfs/".$pdf);
    }

    mysqli_query($conn, "UPDATE livre SET 
        titre='$titre',
        auteur='$auteur',
        maison_edition='$maison_edition',
        description='$description',
        nombre_exemplair=$nombre_exemplair,
        cathegorie_id=$cathegorie_id,
        image='$image',
        fichier_pdf='$pdf'
        WHERE id=$id
    ");

    header("Location: admin_livre.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier le livre | Admin</title>

<style>
*{
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

body{
    background: linear-gradient(135deg, #f0f4f8, #d9e4ec);
    margin: 0;
    padding: 0;
}

h2{
    text-align: center;
    margin-top: 40px;
    color: #2c3e50;
}

form{
    max-width: 520px;
    margin: 30px auto;
    background: white;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

input[type="text"],
input[type="number"],
textarea,
select{
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 1px solid #ccd1d9;
    font-size: 14px;
    transition: 0.3s;
}

textarea{
    min-height: 90px;
    resize: vertical;
}

input:focus,
textarea:focus,
select:focus{
    outline: none;
    border-color: #2ecc71;
    box-shadow: 0 0 0 3px rgba(46,204,113,0.2);
}

label{
    font-size: 14px;
    color: #34495e;
    margin-bottom: 6px;
    display: block;
}

input[type="file"]{
    margin-bottom: 18px;
}

button{
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover{
    background: linear-gradient(135deg, #27ae60, #1e8449);
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.2);
}

@media(max-width:600px){
    form{
        margin: 20px;
        padding: 20px;
    }
}
</style>
</head>

<body>

<h2>✏ Modifier le livre</h2>

<form method="post" enctype="multipart/form-data">

    <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>

    <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>

    <input type="text" name="maison_edition" value="<?= htmlspecialchars($livre['maison_edition']) ?>">

    <textarea name="description"><?= htmlspecialchars($livre['description']) ?></textarea>

    <input type="number" name="nombre_exemplair" value="<?= $livre['nombre_exemplair'] ?>" min="1" required>

    <select name="cathegorie_id" required>
        <?php 
        while($cat = mysqli_fetch_assoc($catRes)){
            $selected = ($cat['id'] == $livre['cathegorie_id']) ? "selected" : "";
            echo "<option value='{$cat['id']}' $selected>".htmlspecialchars($cat['nom'])."</option>";
        }
        ?>
    </select>

    <label>Image de couverture (laisser vide si inchangé)</label>
    <input type="file" name="image" accept="image/*">

    <label>Fichier PDF (laisser vide si inchangé)</label>
    <input type="file" name="pdf" accept="application/pdf">

    <button type="submit">💾 Modifier le livre</button>

</form>

</body>
</html>
