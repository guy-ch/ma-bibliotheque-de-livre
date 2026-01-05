<?php
include("connexion.php");

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

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
        h2, h3 { text-align: center;   font-size: 35px;
  color: rgb(4, 4, 73);
  padding-top: 2rem;
  padding-bottom: 1rem;
  padding-left:rem;}
        .categories-menu { text-align: center; margin-bottom: 20px; margin-left:14rem }
        .categories-menu a { margin: 0 10px; text-decoration: none; color: #0066cc; font-weight: bold;
         font-size: 20px}
        .categories-menu a:hover { color: #ff6600; }
        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 20px; }
        .book-card { border: 1px solid #ccc; padding: 10px; text-align: center; transition: transform 0.2s; }
        .book-card:hover { transform: scale(1.05); box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        .book-card img { max-width: 100%; height: auto; }
        .book-card h3 { font-size: 1.1em; margin: 10px 0 5px; }
        .book-card p { margin: 5px 0; font-size: 0.95em; color: #333; }
        .book-card a.details-btn { display: inline-block; margin-top: 5px; padding: 5px 10px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 4px; }
        .book-card a.details-btn:hover { background-color: #ff6600; }
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
    <main>
 

<h2>📚 UNILIBRARY</h2>

<!-- MENU DES CATÉGORIES -->
<div class="categories-menu">
<?php
$sqlCats = "SELECT * FROM cathegorie";
$resCats = mysqli_query($conn, $sqlCats);

echo "<a href='livre.php'>Tous</a>";

while ($cat = mysqli_fetch_assoc($resCats)) {
    echo "<a href='livre.php?id={$cat['id']}'> {$cat['nom']} </a>";
}
?>
</div>

<hr>

<?php
// Filtrage par catégorie
$whereClause = "";
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_categorie = (int) $_GET['id'];
    $whereClause = "WHERE cathegorie.id = $id_categorie";

    // Nom de la catégorie pour affichage
    $resCat = mysqli_query($conn, "SELECT nom FROM cathegorie WHERE id = $id_categorie");
    $categorie = mysqli_fetch_assoc($resCat);
    echo "<h3>📂 Catégorie : {$categorie['nom']}</h3>";
} else {
    echo "<h3>📚 Tous les livres</h3>";
}

// Requête avec DISTINCT pour éviter les doublons
$sqlLivres = "SELECT DISTINCT livre.*, cathegorie.nom AS cat_nom
              FROM livre
              JOIN cathegorie ON livre.cathegorie_id = cathegorie.id
              $whereClause
              ORDER BY livre.titre ASC";

$resLivres = mysqli_query($conn, $sqlLivres);

// AFFICHAGE EN GRILLE
if (mysqli_num_rows($resLivres) > 0) {
    echo "<div class='books-grid'>";
    while ($livre = mysqli_fetch_assoc($resLivres)) {

        // Sous-dossier en minuscules
        $dossier = strtolower($livre['cat_nom']);
        $cheminImage = __DIR__ . "/upload/images/{$dossier}/{$livre['image']}";

        // Vérification de l'existence de l'image
        if(file_exists($cheminImage)){
            $imageURL = "upload/images/{$dossier}/" . rawurlencode($livre['image']);
        } else {
            $imageURL = "upload/images/default.png"; // image par défaut si introuvable
        }
        ?>
        <div class="book-card">

            <!-- IMAGE -->
            <img src="<?= $imageURL ?>" alt="<?= htmlspecialchars($livre['titre']) ?>">

            <!-- TITRE / AUTEUR -->
            <h3><?= htmlspecialchars($livre['titre']) ?></h3>
            <p>Auteur : <?= htmlspecialchars($livre['auteur']) ?></p>

            <!-- BOUTON DÉTAILS -->
            <a href="details.php?id=<?= $livre['id'] ?>" class="details-btn">Voir détails / PDF</a>

        </div>
        <?php
    }
    echo "</div>";
} else {
    echo "<p style='text-align:center;'>Aucun livre trouvé.</p>";
}
?>

</body>
</html>

    </main>


     <footer>
        <div>
            <p><i class="fa fa-registered" aria-hidden="true"></i>
                 2026 BIBLIOTHEQUE UNILIBRARY | Tous droits réservé </p>
        </div>
      
    </footer>

</body>
</html>