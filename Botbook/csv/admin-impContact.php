<?php
// Vérifie si la session est démarrée, sinon démarre une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('admin-connectdb.php');
include('admin-requestSQL.php');

// l'utilisateur est connecté?
if (!isset($_SESSION["user_id"])) {
    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: pconnexion.php");
    exit();
}

// Message de confirmation/d'erreur pour l'importation
$uploadMessage = '';

// Vérifie si le bouton d'upload a été soumis
if (isset($_POST['bUpload'])) {
    // Récupère l'identifiant de l'utilisateur depuis la session
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Vérifie si l'identifiant de l'utilisateur est disponible dans la session
    if (!$user_id) {
        exit('User ID not found in session.');
    }

    // Vérifie si aucun fichier n'a été sélectionné
    if (empty($_FILES['csv_file']['name'])) {
        $uploadMessage = "Veuillez sélectionner un fichier CSV.";
    } else {
        // Récupère le fichier temporaire du formulaire
        $file = $_FILES['csv_file']['tmp_name'];

        // Appelle la fonction d'importation CSV pour traiter le fichier
        importCSV($file);
    }
}

// Redirige l'utilisateur vers la page de liste de contacts après l'importation
header("Location: ../plistContact.php");
exit();
?>
