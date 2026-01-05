<?php
session_start();
include "connexion.php";

// Vérifier si admin
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: index.php");
    exit;
}

// Récupérer tous les livres
$sql = "SELECT livre.*, cathegorie.nom AS cat_nom FROM livre
        JOIN cathegorie ON livre.cathegorie_id = cathegorie.id
        ORDER BY livre.titre";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des livres | Admin</title>
<link rel="stylesheet" href="biblio1.css">
<style>
body{font-family:Arial,sans-serif; padding:20px; background:#f4f4f4;}
h2{text-align:center; color:#0066cc; margin-bottom:20px;}
.table{width:100%; border-collapse:collapse; margin-bottom:30px;}
.table th, .table td{border:1px solid #ccc; padding:10px; text-align:center;}
.table th{background:#0066cc; color:white;}
.btn{padding:6px 10px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; color:white;}
.add-btn{background:green; margin-bottom:15px; display:inline-block;}
.edit-btn{background:orange;}
.delete-btn{background:red;}
.btn:hover{opacity:0.8;}
</style>
</head>
<body>

<h2>📚 Gestion des Livres</h2>

<a href="ajouter_livre.php" class="btn add-btn">➕ Ajouter un livre</a>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Catégorie</th>
        <th>Exemplaires</th>
        <th>Actions</th>
    </tr>

    <?php while($livre = mysqli_fetch_assoc($res)) { ?>
    <tr>
        <td><?= $livre['id'] ?></td>
        <td><?= htmlspecialchars($livre['titre']) ?></td>
        <td><?= htmlspecialchars($livre['auteur']) ?></td>
        <td><?= htmlspecialchars($livre['cat_nom']) ?></td>
        <td><?= $livre['nombre_exemplair'] ?></td>
        <td>
            <a href="modifier_livre.php?id=<?= $livre['id'] ?>" class="btn edit-btn">✏ Modifier</a>
            <a href="supprimer_livre.php?id=<?= $livre['id'] ?>" class="btn delete-btn" onclick="return confirm('Supprimer ce livre ?');">❌ Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
