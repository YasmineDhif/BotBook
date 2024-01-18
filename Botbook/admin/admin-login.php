
<?php session_start();
include("admin-requestSQL.php");

// Vérifie si le formulaire a été soumis 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupére les valeurs du formulaire 
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $password = md5(htmlspecialchars(trim($_POST['password'])));

    // Vérifie si l'utilisateur et le mot de passe dans la base de données  
    if (checkUser($username, $password)) {
        // Si les identifiants sont valides, rediriger vers la listeContact.php    
        header("Location: ../plistContact.php");
        exit();
    } else {

        // Si les identifiants ne correspondent pas, rediriger vers pconnexion.php avec un message d'erreur                           
        $message = "Identifiant ou mot de passe incorrect.";
        header("Location: ../pconnexion.php");

        exit();
    }
} else {

    header("Location: ../pconnexion.php");
    exit();
} ?>