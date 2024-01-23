<?php
// Vérification si la session PHP n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('admin-requestSQL.php');

// Vérifie si la clé 'key' est définie dans l'URL
if (isset($_GET['key'])) {
    // Récupérer les données nécessaires depuis l'URL
    $contact_id = $_GET['key'];
    $user_id = $_SESSION["user_id"];

    
    $contact = getContactDetails($contact_id, $user_id);

    // Vérifie si le contact existe 
    if (!$contact) {
        echo "Contact non trouvé ou vous n'avez pas les autorisations nécessaires.";
        exit();
    }

    // Vérifie si le formulaire a été soumis
    if (isset($_POST['bEdit'])) {
        // Récupérer les données du formulaire
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Mise à jour du contact dans la base de données
        if (updateContact($contact_id, $user_id, $lastname, $firstname, $email, $phone, $address)) {
            echo "Le contact a été modifié avec succès.";
            // Redirection vers la page plistContact.php après la modification
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
