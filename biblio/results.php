<?php
include "connexion.php";

/* Vérifier si une recherche est envoyée */
if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo "<p style='text-align:center;'>Aucune recherche effectuée.</p>";
    exit;
}

$motCle = mysqli_real_escape_string($conn, $_GET['q']);

/* Requête de recherche */
$sql = "SELECT livre.id, livre.titre, livre.auteur, livre.image, cathegorie.nom AS cat_nom
        FROM livre
        JOIN cathegorie ON livre.cathegorie_id = cathegorie.id
        WHERE livre.titre LIKE '%$motCle%'
        OR livre.auteur LIKE '%$motCle%'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Résultats de recherche | UNILIBRARY</title>
<link rel="stylesheet" href="biblio1.css">

<style>


.container{
    width:90%;
    max-width:900px;
    background:#fff;
    margin:40px auto;
    padding:30px;
    border-radius:12px;
    box-shadow:0 15px 30px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    margin-bottom:30px;
    color:#333;
}

.book{
    display:flex;
    gap:20px;
    align-items:center;
    background:#f8faff;
    padding:18px;
    border-radius:10px;
    margin-bottom:20px;
    transition:0.3s;
}

.book:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 20px rgba(0,0,0,0.12);
}

.book img{
    width:90px;
    border-radius:6px;
    box-shadow:0 5px 10px rgba(0,0,0,0.15);
}

.info{
    flex:1;
}

.info h3{
    font-size:1.2em;
    color:#222;
    margin-bottom:6px;
}

.info p{
    color:#555;
    margin-bottom:10px;
}

.btn{
    display:inline-block;
    padding:10px 18px;
    background:linear-gradient(135deg,#0066cc,#004a99);
    color:#fff;
    text-decoration:none;
    border-radius:25px;
    font-weight:600;
    transition:0.3s;
    box-shadow:0 5px 15px rgba(0,102,204,0.35);
}

.btn:hover{
    background:linear-gradient(135deg,#ff7a18,#ff6600);
    transform:scale(1.05);
    box-shadow:0 8px 20px rgba(255,102,0,0.4);
}

.back{
    display:block;
    text-align:center;
    margin-top:30px;
    font-weight:bold;
    color:#0066cc;
    text-decoration:none;
}

.back:hover{color:#ff6600;}

@media(max-width:600px){
    .book{flex-direction:column;text-align:center;}
    .book img{width:120px;}
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
            <li><a href="contact.php">Contacts</a></li>
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

<h2> Résultats pour : <em><?= htmlspecialchars($motCle) ?></em></h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($livre = mysqli_fetch_assoc($result)): 
        $dossier = strtolower($livre['cat_nom']);
        $imgServeur = __DIR__ . "/upload/images/$dossier/{$livre['image']}";
        $imgWeb = "upload/images/$dossier/" . rawurlencode($livre['image']);
    ?>
    <div class="book">
        <?php if (file_exists($imgServeur)): ?>
            <img src="<?= $imgWeb ?>" alt="<?= htmlspecialchars($livre['titre']) ?>">
        <?php else: ?>
            <img src="upload/images/default.png" alt="Couverture">
        <?php endif; ?>

        <div class="info">
            <h3><?= htmlspecialchars($livre['titre']) ?></h3>
            <p>Auteur : <?= htmlspecialchars($livre['auteur']) ?></p>
            <a class="btn" href="details.php?id=<?= $livre['id'] ?>">
                Voir détails
            </a>
        </div>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center;">Aucun livre trouvé.</p>
<?php endif; ?>

<a class="back" href="index.php"> Retour à l'accueil</a>

</div>

</body>
</html>
