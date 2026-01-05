<?php
session_start();
include "connexion.php";

if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true){
    header("Location: index.php");
    exit;
}

if(!isset($_GET['id'])) exit("ID manquant.");
$id = (int)$_GET['id'];

// Optionnel : supprimer image et PDF du serveur
$res = mysqli_query($conn, "SELECT image,fichier_pdf FROM livre WHERE id=$id");
$livre = mysqli_fetch_assoc($res);
if($livre){
    if($livre['image'] && file_exists("upload/images/".$livre['image'])) unlink("upload/images/".$livre['image']);
    if($livre['fichier_pdf'] && file_exists("upload/pdfs/".$livre['fichier_pdf'])) unlink("upload/pdfs/".$livre['fichier_pdf']);
}

mysqli_query($conn, "DELETE FROM livre WHERE id=$id");

header("Location: admin_livre.php");
exit;
