<?php 
session_start();
include("connexion.php");

// Vérification de l'id du livre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Livre introuvable.";
    exit;
}

$id_livre = (int) $_GET['id'];

// Récupération du livre avec sa catégorie
$sql = "SELECT livre.*, cathegorie.nom AS cat_nom
        FROM livre
        JOIN cathegorie ON livre.cathegorie_id = cathegorie.id
        WHERE livre.id = $id_livre";

$res = mysqli_query($conn, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    echo "Livre introuvable.";
    exit;
}

$livre = mysqli_fetch_assoc($res);
$dossier = strtolower($livre['cat_nom']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($livre['titre']) ?> | UNILIBRARY</title>
<link rel="stylesheet" href="biblio1.css">
<style>
*{ box-sizing:border-box; margin:0; padding:0; }

body{
    font-family:"Segoe UI", Arial, sans-serif;
    background:#eef1f4;
    padding:20px;
}

.container{
    max-width:1000px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.book-header{
    display:flex;
    gap:30px;
    align-items:flex-start;
    border-bottom:1px solid #ddd;
    padding-bottom:25px;
}

.book-header img{
    width:220px;
    border-radius:12px;
    box-shadow:0 8px 18px rgba(0,0,0,0.18);
}

.book-info h1{
    font-size:30px;
    margin-bottom:12px;
    color:#222;
}

.book-info p{
    font-size:16px;
    margin:8px 0;
    color:#444;
}

.book-info strong{
    color:#000;
}

.description{
    margin-top:25px;
    background:#f8f9fa;
    padding:20px;
    border-radius:10px;
    line-height:1.8;
    color:#333;
}

.actions{
    margin-top:30px;
    display:flex;
    justify-content:center;
    gap:15px;
}

.btn{
    padding:14px 28px;
    background:linear-gradient(135deg, #0a7d2c, #12b954);
    color:white;
    border:none;
    border-radius:30px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:linear-gradient(135deg, #ff6600, #ff944d);
    transform:scale(1.05);
}

.back{
    display:block;
    margin-top:30px;
    text-align:center;
    color:#0066cc;
    font-weight:bold;
    text-decoration:none;
}

.back:hover{
    text-decoration:underline;
}

/* Responsive */
@media(max-width:768px){
    .book-header{
        flex-direction:column;
        align-items:center;
        text-align:center;
    }

    .book-header img{
        width:160px;
    }

    .container{
        margin:20px;
        padding:20px;
    }
}
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
            <li><a href="index.php">Acceuil</a></li>
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
<div class="container">
    <div class="book-header">

        <!-- IMAGE -->
        <?php
        $imageServeur = __DIR__ . "/upload/images/$dossier/{$livre['image']}";
        $imageWeb = "upload/images/$dossier/" . rawurlencode($livre['image']);

        if (file_exists($imageServeur)) {
            echo "<img src='$imageWeb' alt='Couverture du livre'>";
        } else {
            echo "<img src='upload/images/default.png' alt='Pas d'image'>";
        }
        ?>

        <!-- INFOS -->
        <div class="book-info">
            <h1><?= htmlspecialchars($livre['titre']) ?></h1>
            <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
            <p><strong>Maison d’édition :</strong> <?= htmlspecialchars($livre['maison_edition']) ?></p>
            <p><strong>Nombre d’exemplaires :</strong> <?= (int)$livre['nombre_exemplair'] ?></p>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="description">
        <strong>Description :</strong><br>
        <?= nl2br(htmlspecialchars($livre['description'])) ?>
    </div>

    <!-- ACTIONS -->
    <div class="actions">
        <form method="post" action="ajouter_liste.php">
            <input type="hidden" name="id_livre" value="<?= $livre['id'] ?>">
            <button type="submit" class="btn">➕ Ajouter à ma liste</button>
        </form>

        <a href="wishlist.php" class="btn" style="background:#0066cc;">📖 Ma liste</a>
    </div>

    <a href="livre.php" class="back">⬅ Retour aux livres</a>
</div>

</body>
</html>
