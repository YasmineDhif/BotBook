<?php
require("admin-requestSQL.php");
session_start();

if(isset($_POST['bInscription'])){
    $lastname = htmlspecialchars(strtolower(trim($_POST['lastname'])));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $email = htmlspecialchars(trim($_POST['email']));
    $email2 = htmlspecialchars(trim($_POST['email2']));
    $password1 = md5(htmlspecialchars(trim($_POST['password1'])));
    $password2 = md5(htmlspecialchars(trim($_POST['password2'])));
    $question = htmlspecialchars(trim($_POST['question']));
    $answer = htmlspecialchars(trim($_POST['answer']));

    //var_dump($password, $password); 
    // Vérification si les mots de passes sont identiques
    if ($password1 !== $password2) {
        echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        
    } 
    // Vérification si les adresses email sont identiques
    elseif ($email !== $email2) {
        echo "Les adresses email ne correspondent pas. Veuillez les saisir à nouveau.";
       
    } else {
        //inscription bdd
        insertdata($lastname, $firstname, $username, $email, $password1, $question, $answer);
        // Les mots de passe et les adresses email sont identiques.
        header("Location: ../pconnexion.php");
        exit();
    }
    $insertResult = insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete);
    if ($insertResult === 'username_exists') {
        echo "";
    
    } else {
        echo "l'identifiants est déjà utilisé";
    }
    header("Location: ../pinscription.php");
    exit;
}

?>
