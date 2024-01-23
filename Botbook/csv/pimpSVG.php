<?php
$title = "Changer le mot de passe";
include('partials/header.php');
?>
<main>
    <!--- téléchargé le fichier csv -->
<form action="csv/admin-impContact.php" method="post" enctype="multipart/form-data"><!-- indiicque comment les données du formulaire doivent être encodées -->
    <h2>Télécharger un fichier</h2>
    <div class="form-group">
        <label for="csv_file">Choisir un fichier CSV :</label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv">
    </div>

    <button type="submit" name="bUpload">Importer Contacts</button>
</form>
</main>

<?php require_once("partials/footer.php"); ?>