<?php
require("admin-requestSQL.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST["bAdd"])){ 
    // Récupération de l'ID de l'utilisateur connecté et des données du formulaire
   
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $user_id = $_SESSION['user_id'];

    // Appel de la fonction pour insérer les données
    if (insertContact( $lastname, $firstname, $email, $phone, $address, $user_id)) {
    header("Location: ../plistContact.php");
        exit();
}
}
?>