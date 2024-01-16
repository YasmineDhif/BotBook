<?php
$title = "Changer le mot de passe";
include('partials/header.php');
?>


    <div class="accueil-up">
        <a href="index.php">
                  <img src="img/logoBotBook.png" alt="logo"></a>
         
    </div>

  <div class="formmdp">

    <h1><?php echo $title; ?></h1>
    <form action="admin/admin-pmdp.php" method="post"> 
      
      
        <label for="username">Nom d'utilisateur*</label>
        <input type="text" id="username" name="username" required>
      
      
        <label for="answer">Réponse à la question secrète*</label>
        <input type="text" id="answer" name="answer" required>
      
      
        <label for="newPassword">Nouveau mot de passe*</label>
        <input type="password" id="newPassword" name="newPassword" required>
    
    
      <input type="submit" name="bReset" value="Réinitialiser">
    </form>

    <div class="form-links">
    <a href="index.php">Retour à la page d'accueil</a>
    </div>
    
</div>

      <?php
    include('partials/footer.php');?>