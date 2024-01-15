<?php
$title = "Se connecter";
include('partials/header.php');
?>
    
    <div class="container">
        <div class="left-column">
             <img src="img/logoBotBook.png" alt="logo">
             <p>Besoin de répertorier vos contacts personnels et professionnels dans un seul endroit?</p>
             <p>Essayer Botbook!</p>

            <a href="pinscription.php">S'inscrire</a>
            
        </div>

        <div class="right-column">
        <h1><?php echo $title; ?></h1>

        <div class="formulaire">
          <?php if (isset($_GET['message'])) { ?><p> <?php echo $_GET['message']; ?></p> <?php } ?>
          
            <form action="admin/admin-login.php" method="POST">

                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
            
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>

                <div class="form-links">
                <a href="preinitialisationmdp.php">Mot de passe oublié?</a>
                
                </div>
                <input type="submit" name="bConnexion" value="Se connecter">
            
              </form>
          </div>
        </div>
    </div>

    <?php
    include('partials/footer.php');?>