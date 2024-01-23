<?php
session_start();

if (isset($_SESSION["user_id"]) && isset($_POST["contact_id"])) {
    $user_id = $_SESSION["user_id"];
    $contact_id = $_POST["contact_id"];

    include('admin-requestSQL.php');

    // Appeler la fonction pour supprimer le contact
    if (deleteContact($contact_id, $user_id)) {
        // Rediriger ou effectuer d'autres actions après la suppression
        header("Location: ../plistContact.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du contact.";
    }
} else {
    echo "Paramètres manquants.";
}
?>