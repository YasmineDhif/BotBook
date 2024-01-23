<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('admin-requestSQL.php');

if (isset($_GET['key'])) {
    $contact_id = $_GET['key'];
    $user_id = $_SESSION["user_id"];

    $contact = getContactDetails($contact_id, $user_id);

    if (!$contact) {
        echo "Contact non trouvé ou vous n'avez pas les autorisations nécessaires.";
        exit();
    }

    if (isset($_POST['bEdit'])) {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if (updateContact($contact_id, $user_id, $lastname, $firstname, $email, $phone, $address)) {
            echo "Le contact a été modifié avec succès.";
            // Rediriger vers plistContact.php après la modification
            header("Location: ../plistContact.php");
            exit();
        } else {
            echo "Erreur lors de la modification du contact.";
        }
    } else {
        // Le formulaire n'a pas été soumis, affichez un message d'erreur si nécessaire
        echo "Paramètres manquants.";
    }
} else {
    // La clé n'est pas définie, affichez un message d'erreur si nécessaire
    echo "Paramètres manquants.";
}
?>