<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('admin-connectdb.php');
include('admin-requestSQL.php');

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: pconnexion.php");
    exit();
}

$uploadMessage = '';

if (isset($_POST['bUpload'])) {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (!$user_id) {
        exit('User ID not found in session.');
    }

    if (empty($_FILES['csv_file']['name'])) {
        $uploadMessage = "Veuillez sélectionner un fichier CSV.";
    } else {
        $file = $_FILES['csv_file']['tmp_name'];
        importCSV($file);
    }
}

header("Location: ../plistContact.php");
exit();
?>