<?php
$title = "Votre liste de contact";
include('partials/header.php');
session_start();
if (isset($_SESSION['user_id'])) {
?>

 <a href="index.php">
              <img src="img/logoBotBook.png" alt="logo"></a>
              
              <h1><?php echo $title; ?></h1>

              <a href="admin/admin-logout.php">Deconnexion</a>
              <form action="pinscription.php" method="POST">
                                    <button type="submit" name="bAdd">Ajouter un $contacts</button>
                                </form> 
<table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>téléphone</th>
                        <th>Addresse</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                     <tbody>
                        <?php foreach
                        ($_SESSION['donnéesContact'] as $donnees){
                            ?>
                            <tr>
                                <td>
                                   <?php echo $donnees ['lastname'];?>
                                </td>
                                <td>
                                   <?php echo $donnees ['firstname'];?>
                                </td>
                                <td>
                                   <?php echo $donnees ['email'];?>
                                </td>
                                <td>
                                   <?php echo $donnees ['phone'];?>
                                </td>
                                <td>
                                   <?php echo $donnees ['address'];?>
                                </td>
                            </tr>
                        }
                    </tbody>
<table>
}
?>