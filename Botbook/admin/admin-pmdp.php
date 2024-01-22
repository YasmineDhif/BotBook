<?php
session_start();
require('admin-requestSQL.php');

if (isset($_POST['bReset'])) {
    $username = $_POST['username'];
    $answer = $_POST['answer'];
    $newPassword = $_POST['newPassword'];

   

    // Vérification de la question et de la réponse dans la base de données pour l'utilisateur
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ? AND answer = ?");
    $stmt->bind_param("sss", $username, $answer);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Si  la réponse est correcte, mettre à jour le mot de passe
        $stmt_update = $mysqli->prepare("UPDATE user SET newpassword = ? WHERE username = ?");
        $stmt_update->bind_param("ss", $newpassword, $username);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            echo "Mot de passe réinitialisé avec succès!";
            header('Location: pconnexion.php');
        } else {
            echo "Échec de la réinitialisation du mot de passe.";
        }

        $stmt_update->close();
    } else {
        echo "réponse est incorrecte. Veuillez réessayer.";
    }

    // Fermeture de la connexion et du statement
    $stmt->close();
    $mysqli->close();
}
?>
