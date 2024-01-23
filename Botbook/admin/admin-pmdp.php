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

function getUserData($username)
{
    global $bdd;
    $sql = "SELECT id, answer FROM user WHERE username = :username";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePassword($userId, $newPassword)
{
    global $bdd;
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET password1 = :password1 WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':password1', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}
?>