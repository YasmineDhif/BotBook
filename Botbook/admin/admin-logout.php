<?php
session_start();
include('admin-requestSQL.php'); 

// Vérifie si un utilisateur est connecté 
if (isset($_SESSION['user_id'])) {
    // Nettoie et détruit la session en cours
    session_unset();
    session_destroy();

    // Redirection vers la page d'accueil (index.php)
    header("Location: index.php");
    exit();
}
?>