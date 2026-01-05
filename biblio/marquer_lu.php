<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['id_lecteur'])) {
    header("Location: inscription.php");
    exit;
}

$id_lecteur = $_SESSION['id_lecteur'];
$id_livre = (int) $_POST['id_livre'];

// Mettre à jour le statut lu
$sql = "UPDATE liste_lecture 
        SET lu = 1 
        WHERE id_livre = $id_livre AND id_lecteur = $id_lecteur";

mysqli_query($conn, $sql);

header("Location: wishlist.php");
exit;
?>
