<?php
$title = "Votre liste de contact";
include('partials/header.php');
session_start();

?>

 <a href="index.php">
              <img src="img/logoBotBook.png" alt="logo"></a>
              
              <h1><?php echo $title; ?></h1>

              <a href="pconnexion.php">Deconnexion</a>
              <form action="paddContact.php" method="POST">
                                    <button type="submit" name="bAdd">Ajouter un contact</button>
                                </form> 
<?php if (!isset($_SESSION["list_contact"]) || empty($_SESSION["list_contact"])) : ?>
        <p>Liste de contact vide</p>
    <?php else : ?>

<table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>téléphone</th>
                        <th>Addresse</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                     <tbody>
                        <?php foreach
                        ($_SESSION['list_contact'] as $key => $donnees) :?>
                            
                            <tr>
                                <td><?php echo $donnees ['lastname'];?></td>
                                <td><?php echo $donnees ['firstname'];?></td>
                                <td><?php echo $donnees ['email'];?></td>
                                <td><?php echo $donnees ['phone'];?></td>
                                <td><?php echo $donnees ['address'];?></td>
                                <td>
                                 <a href="edit_product.php?do=form_edit&key=<?php echo $donnees ?>">Modifier</a>
                                 <a href="list_product.php?do=delete_product&key=<?php echo $donnees ?>" class="danger">Supprimer</a>
                               </td>

                            </tr>
                        
                    </tbody>
                    <?php endforeach;?>
<table>

<?php endif;?>

<?php require_once("partials/footer.php"); ?>