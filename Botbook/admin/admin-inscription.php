<?php

require("admin-requestSQL.php");

// Démarrage de la session 
session_start();

// Vérificatie si le formulaire d'inscription a été soumis
if(isset($_POST['bInscription'])){
    // Récupére les données du formulaire
    $lastname = htmlspecialchars(strtolower(trim($_POST['lastname'])));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $email = htmlspecialchars(trim($_POST['email']));
    $email2 = htmlspecialchars(trim($_POST['email2']));
    $password1 = md5(htmlspecialchars(trim($_POST['password1'])));
    $password2 = md5(htmlspecialchars(trim($_POST['password2'])));
    $question = htmlspecialchars(trim($_POST['question']));
    $answer = htmlspecialchars(trim($_POST['answer']));

    // Vérifie si les mots de passe ne correspondent pas
    if ($password1 !== $password2) {
        echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
    } 
    // Vérifie si les adresses email ne correspondent pas
    elseif ($email !== $email2) {
        echo "Les adresses email ne correspondent pas. Veuillez les saisir à nouveau.";
    } else {
        // Insertion des données dans la base de données
        insertdata($lastname, $firstname, $username, $email, $password1, $question, $answer);
        
        header("Location: ../pconnexion.php");
        exit();
    }

    //Insertion des données dans la base de données
    $insertResult = insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete);

    // Vérification du résultat de l'insertion
    if ($insertResult === 'username_exists') {
        echo ""; // Le nom d'utilisateur existe déjà
    } else {
        echo "l'identifiants est déjà utilisé"; // Un autre type d'erreur
    }

    // Redirection vers la page d'inscription en cas d'erreur
    header("Location: ../pinscription.php");
    exit;
}
?>
