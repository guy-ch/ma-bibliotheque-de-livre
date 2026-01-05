<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['id_lecteur'])) {
    header("Location: inscription.php");
    exit;
}

$id_lecteur = $_SESSION['id_lecteur'];

// Récupérer les livres de la liste de lecture avec le statut lu
$sql = "SELECT ll.*, livre.*, cathegorie.nom AS cat_nom
        FROM liste_lecture ll
        JOIN livre ON ll.id_livre = livre.id
        JOIN cathegorie ON livre.cathegorie_id = cathegorie.id
        WHERE ll.id_lecteur = $id_lecteur
        ORDER BY cathegorie.nom, livre.titre";

$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ma Liste de Lecture | UNILIBRARY</title>
<link rel="stylesheet" href="biblio1.css">
<style>
*{box-sizing:border-box;}
/* body{font-family:Arial,sans-serif;background:#f4f6f8;margin:0;padding:0;} */

.container{max-width:1200px;margin:auto;padding:20px;}
h2{text-align:center;font-size:2rem;margin-bottom:30px;color:#0066cc;}
.category{margin-bottom:40px;}
.category h3{text-align:center;font-size:1.5rem;color:#0066cc;margin-bottom:15px;border-bottom:2px solid #0066cc;display:inline-block;padding-bottom:5px;}

.books-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;}

.book-card{background:white;padding:15px;border-radius:10px;text-align:center;box-shadow:0 4px 10px rgba(0,0,0,0.1);transition:transform 0.2s, box-shadow 0.2s;position:relative;}
.book-card:hover{transform:scale(1.03);box-shadow:0 6px 14px rgba(0,0,0,0.15);}

.book-card img{width:100%;height:220px;object-fit:cover;border-radius:8px;margin-bottom:10px;}
.book-card h3{font-size:1.1rem;margin:10px 0 5px;}
.book-card p{font-size:0.95rem;color:#444;margin:3px 0;}

.actions{display:flex;justify-content:center;gap:10px;flex-wrap:wrap;margin-top:10px;}
.btn{padding:8px 12px;border:none;border-radius:6px;cursor:pointer;font-weight:bold;color:white;background:darkgreen;transition:0.2s;}
.btn:hover{background:#ff6600;}

.empty{text-align:center;font-size:1.2rem;color:#555;margin-top:50px;}

/* Badge LU */
.badge-lu{
    position:absolute;
    top:10px;
    right:10px;
    background:green;
    color:white;
    font-weight:bold;
    padding:5px 8px;
    border-radius:5px;
    font-size:0.8rem;
}

/* Responsive */
@media(max-width:700px){
    .books-grid{grid-template-columns:repeat(auto-fill,minmax(140px,1fr));}
    .book-card img{height:180px;}
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


<?php
if(isset($_SESSION['success_message'])){
    echo "<div style='text-align:center; margin-bottom:20px; padding:10px; background:#28a745; color:white; border-radius:6px; font-weight:bold;'>".$_SESSION['success_message']."</div>";
    unset($_SESSION['success_message']);
}
if(isset($_SESSION['error_message'])){
    echo "<div style='text-align:center; margin-bottom:20px; padding:10px; background:#dc3545; color:white; border-radius:6px; font-weight:bold;'>".$_SESSION['error_message']."</div>";
    unset($_SESSION['error_message']);
}
if(isset($_SESSION['info_message'])){
    echo "<div style='text-align:center; margin-bottom:20px; padding:10px; background:#17a2b8; color:white; border-radius:6px; font-weight:bold;'>".$_SESSION['info_message']."</div>";
    unset($_SESSION['info_message']);
}
?>



<h2>📚 Ma Liste de Lecture</h2>

<?php
$categories = [];
while($livre = mysqli_fetch_assoc($res)){
    $categories[$livre['cat_nom']][] = $livre;
}

if(empty($categories)){
    echo "<p class='empty'>Votre liste de lecture est vide.</p>";
}else{
    foreach($categories as $cat => $livres){
        echo "<div class='category'><h3>$cat</h3><div class='books-grid'>";
        foreach($livres as $livre){
            $dossier = strtolower($livre['cat_nom']);
            $cheminImage = __DIR__."/upload/images/$dossier/{$livre['image']}";
            $imageURL = file_exists($cheminImage) ? "upload/images/$dossier/".rawurlencode($livre['image']) : "upload/images/default.png";

            echo "<div class='book-card'>";
            if($livre['lu'] == 1){
                echo "<div class='badge-lu'>LU ✅</div>";
            }
            echo "<img src='$imageURL' alt='".htmlspecialchars($livre['titre'])."'>";
            echo "<h3>".htmlspecialchars($livre['titre'])."</h3>";
            echo "<p>Auteur : ".htmlspecialchars($livre['auteur'])."</p>";

            echo "<div class='actions'>";
            echo "<form method='post' action='marquer_lu.php'>
                    <input type='hidden' name='id_livre' value='{$livre['id']}'>
                    <button type='submit' class='btn'>✅ Marquer comme lu</button>
                  </form>";
            echo "<form method='post' action='retirer_livre.php'>
                    <input type='hidden' name='id_livre' value='{$livre['id']}'>
                    <button type='submit' class='btn'>❌ Retirer</button>
                  </form>";
            echo "</div>";

            echo "</div>";
        }
        echo "</div></div>";
    }
}
?>
</div>


 <footer>
        <div>
            <p><i class="fa fa-registered" aria-hidden="true"></i>
                 2026 BIBLIOTHEQUE UNILIBRARY | Tous droits réservé </p>
        </div>
      
    </footer>
</body>
</html>
