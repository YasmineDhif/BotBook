<?php
$title = "Votre liste de contact";
include('partials/header.php');
include('admin/admin-requestSQL.php');
// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: pconnexion.php");
    exit();
}

// Incluez ici vos fichiers nécessaires, tels que les fichiers de configuration et la connexion à la base de données.

// Utilisez la fonction pour récupérer la liste des contacts de l'utilisateur
$contacts = getContacts($_SESSION["user_id"]);
?>
<div class="accueil-up">
<a href="index.php">
    <img src="img/logoBotBook.png" alt="logo">
</a>
<h1><?php echo $title; ?></h1>
</div>



<a href="pconnexion.php">Deconnexion</a>

<form action="paddContact.php" method="POST">
<input type="submit" name="bAdd" value="+Ajouter un contact">
</form>

<?php if (!$contacts) : ?>
    <p>Liste de contact vide</p>
<?php else : ?>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $donnees) : ?>
                <tr>
                    <td><?php echo $donnees['lastname']; ?></td>
                    <td><?php echo $donnees['firstname']; ?></td>
                    <td><?php echo $donnees['email']; ?></td>
                    <td><?php echo $donnees['phone']; ?></td>
                    <td><?php echo $donnees['address']; ?></td>
            <td>
            <a href="pmodContact.php?key=<?php echo $donnees['id']; ?>" class="bEdit">Modifier</a>
            <form action="admin/admin-deleteContact.php" method="post" style="display:inline;">
                <input type="hidden" name="contact_id" value="<?php echo $donnees['id']; ?>">
                <button type="submit" class="bDel" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once("partials/footer.php"); ?>