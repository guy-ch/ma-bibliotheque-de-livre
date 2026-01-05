<?php
session_start();
include "connexion.php";

// Vérifier que l'ID du livre est bien envoyé
if (!isset($_POST['id_livre']) || empty($_POST['id_livre'])) {
    $_SESSION['error_message'] = "Aucun livre sélectionné.";
    header("Location: livre.php");
    exit;
}

$id_livre = (int) $_POST['id_livre'];

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_lecteur'])) {
    $id_lecteur = $_SESSION['id_lecteur'];

    // Utilisation de prepared statements pour plus de sécurité
    $stmt = $conn->prepare("SELECT * FROM liste_lecture WHERE id_livre = ? AND id_lecteur = ?");
    $stmt->bind_param("ii", $id_livre, $id_lecteur);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 0) {
        $stmt_insert = $conn->prepare("INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprunt) VALUES (?, ?, CURDATE())");
        $stmt_insert->bind_param("ii", $id_livre, $id_lecteur);
        $stmt_insert->execute();
        $stmt_insert->close();

        $_SESSION['success_message'] = "Livre ajouté à votre liste de lecture ✅";
    } else {
        $_SESSION['info_message'] = "Ce livre est déjà dans votre liste de lecture.";
    }

    $stmt->close();

    header("Location: wishlist.php");
    exit;

} else {
    // Si l'utilisateur n'est pas connecté, stocker le livre en session
    $_SESSION['livre_a_ajouter'] = $id_livre;
    $_SESSION['info_message'] = "Connectez-vous ou créez un compte pour ajouter ce livre à votre liste.";
    header("Location: inscription.php");
    exit;
}
