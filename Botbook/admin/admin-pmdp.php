<?php
require("admin-requestSQL.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $answer = $_POST['answer'];
    $newPassword = $_POST['newPassword'];

    // Vérifier la validité de l'utilisateur et récupérer la question et la réponse
    $userData = getUserData($username);

    if ($userData && $userData['answer'] == $answer) {
        // Mettre à jour le mot de passe
        updatePassword($userData['id'], $newPassword);
        echo "Mot de passe mis à jour avec succès.";
        header("Location: ../pconnexion.php");
        exit();
    } else {
        echo "Réponse secrète incorrecte. Veuillez réessayer.";
    }
}

?>