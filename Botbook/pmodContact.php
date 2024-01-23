<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Modifier le contact";
include('partials/header.php');

if (isset($_GET['key'])) {
    $contact_id = $_GET['key'];
    $user_id = $_SESSION["user_id"];

    include('admin/admin-requestSQL.php');

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
        } else {
            echo "Erreur lors de la modification du contact.";
        }
    }
} else {
    echo "Paramètres manquants.";
}
?>
 <div class="accueil-up">
          <a href="index.php">
          <img src="img/logoBotBook.png" alt="logo"></a>
          <h1><?php echo $title; ?></h1>
      </div>
  

<div class="forminscription">

    <form action="admin/admin-editContact.php?key=<?php echo $contact_id; ?>" method="post">
    <div class="input-group">
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $contact["lastname"]; ?>">
    </div>

    <div class="input-group">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $contact["firstname"]; ?>">
    </div>

    <div class="input-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $contact["email"]; ?>">
    </div>

    <div class="input-group">
        <label for="phone">Téléphone</label>
        <input type="phone" name="phone" id="phone" value="<?php echo $contact["phone"]; ?>">
    </div>

    <div class="input-group">
        <label for="address">Adresse</label>
        <input type="address" name="address" id="address" value="<?php echo $contact["address"]; ?>">
    </div>

    <div class="input-group submit-group">
        <input type="submit" name="bEdit" value="Enregistrer">
    </div>
</form>
<div class="form-links">
      <a href="plistContact.php">Retour à la liste de contact</a>
    </div>
</div>
<?php require_once("partials/footer.php"); ?>