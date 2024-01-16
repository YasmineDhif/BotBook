<?php 
$title = "Admin-login";
include('../header.php');
require("admin-requeteSQL.php");

if(isset($_POST['bConnexion'])){
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $password = htmlspecialchars(trim($_POST['password']));
    if(connexionUser($username,$password)){
        header("Location: ../plistcontact.php");// si le mdp et nom d'utilisateur sont correctes on se redirige vers la page liste contacts
        exit; 
    }else{
        $message = "Le nom d'utilisateur et/ou le mot de passe sont/est incorrect.";
        header('Location: ../pconnexion.php?message='.$message);exit;
    }

}else{
    include('../pconnexion.php');
}

?>