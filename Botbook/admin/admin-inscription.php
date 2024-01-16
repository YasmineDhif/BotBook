<?php
require("admin-requestSQL.php");
session_start();

if(isset($_POST['bInscription'])){
    $name = htmlspecialchars(strtolower(trim($_POST['name'])));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $email = htmlspecialchars(trim($_POST['email']));
    $email2 = htmlspecialchars(trim($_POST['email2']));
    $password = md5(htmlspecialchars(trim($_POST['password'])));
    $password2 = md5(htmlspecialchars(trim($_POST['password2'])));
    $question = htmlspecialchars(trim($_POST['question']));
    $answer = htmlspecialchars(trim($_POST['answer']));

    // Vérification si les mots de passes sont identiques
    if ($password !== $password2) {
        echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        
    } 
    // Vérification si les adresses email sont identiques
    elseif ($email !== $email2) {
        echo "Les adresses email ne correspondent pas. Veuillez les saisir à nouveau.";
       
    } else {
        // Les mots de passe et les adresses email sont identiques.
        header("Location: ../pconnexion.php");
        exit();
    }
}
?>
