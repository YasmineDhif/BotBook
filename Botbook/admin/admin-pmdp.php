<?php
session_start();
require('admin-requestSQL.php');

if (isset($_POST['bReset'])) {
    $username = $_POST['username'];
    $answer = $_POST['answer'];
    $newPassword = $_POST['newPassword'];

    // Connexion à la base de données
    $mysqli = new mysqli('localhost', 'root', '', 'le_bottin');

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }

    // Vérification de la question et de la réponse dans la base de données pour l'utilisateur
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ? AND question = ? AND answer = ?");
    $stmt->bind_param("sss", $username, $question, $answer);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Si la question et la réponse sont correctes, mettre à jour le mot de passe
        $stmt_update = $mysqli->prepare("UPDATE user SET password = ? WHERE username = ?");
        $stmt_update->bind_param("ss", $new_password, $username);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            echo "Mot de passe réinitialisé avec succès!";
            header('Location: pconnexion.php');
        } else {
            echo "Échec de la réinitialisation du mot de passe.";
        }

        $stmt_update->close();
    } else {
        echo "Question ou réponse incorrecte. Veuillez réessayer.";
    }

    // Fermeture de la connexion et du statement
    $stmt->close();
    $mysqli->close();
}
?>
