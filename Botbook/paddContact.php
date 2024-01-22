<?php
$title = "Ajouter un contact";
include('partials/header.php');

/*echo "<pre>";
var_dump($_GET);
echo "</pre>";

echo "<pre>";
var_dump($_POST);
echo "</pre>";
*/
?>
<div class="contner small-container">
<a href="index.php">
              <img src="img/logoBotBook.png" alt="logo"></a>
              
              <h1><?php echo $title; ?></h1>
    <form action="admin/admin-addContact.php" method="POST">

        <div class="input-group">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname">
        </div>
        <div class="input-group">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname">
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div>
        <div class="input-group">
            <label for="phone">Téléphone</label>
            <input type="number" name="phone" id="phone">
        </div>
        <div class="input-group">
            <label for="address">Adresse</label>
            <input type="address" name="address">
        </div>

        <div class="input-group submit-group">
        <input type="submit" name="bAdd" value="Ajouter">
        </div>
    </form>

</div>
<?php require_once("partials/footer.php"); ?>