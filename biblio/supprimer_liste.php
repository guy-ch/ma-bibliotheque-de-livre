<?php
session_start();
include "connexion.php";

if (!isset($_SESSION['id_lecreur']) || !isset($_GET['id_livre'])) {
    header("Location: wishlist.php");
    exit;
}

$id_lecteur = $_SESSION['id_lecreur'];
$id_livre = (int) $_GET['id_livre'];

mysqli_query($conn, "DELETE FROM liste_lecture WHERE id_lecteur=$id_lecteur AND id_livre=$id_livre");

header("Location: wishlist.php");
exit;
