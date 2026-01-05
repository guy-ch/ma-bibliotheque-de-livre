<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['id_lecteur'])) {
    header("Location: inscription.php");
    exit;
}

$id_lecteur = $_SESSION['id_lecteur'];
$id_livre = (int) $_POST['id_livre'];

// Supprimer le livre de la liste
$sqlDelete = "DELETE FROM liste_lecture WHERE id_livre = $id_livre AND id_lecteur = $id_lecteur";
mysqli_query($conn, $sqlDelete);

header("Location: wishlist.php");
exit;
?>
