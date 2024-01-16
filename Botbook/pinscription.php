<?php
$title = "S'inscrire";
include('partials/header.php');
session_start();
?>

<section>
    <div class="accueil-up">
    <a href="index.php">
              <img src="img/logoBotBook.png" alt="logo"></a>
        <h1><?php echo $title; ?></h1>
    </div>
  

<div class="forminscription">
  
    <form action="admin/admin-inscription.php" method="POST">

        <label for="name"></label>
        <input name="name" type="text" id="name" placeholder="Nom" >

        <label for="firstname"></label>
        <input name="firstname" type="text" id="firstname" placeholder="Prénom" >

        <label for="username"></label>
        <input name="username" type="text" id="username" placeholder="Nom d'utilisateur *"  required>

        <label for="email"></label>
        <input name="email" type="email" id="email" placeholder="E-mail*"  required>

        <label for="email2"></label>
        <input name="email2" type="email" id="email2" placeholder="Confirmation de l'E-mail*"  required>

        <label for="password"></label>
        <input name="password" type="password" id="password" name="password" placeholder="Mot de passe*" required>

        <label for="password2"></label>
        <input name="password2" type="password" id="password2" placeholder="Confirmation du mot de passe*" required>

        <label for="question"></label>
          <select id="question" name="question" required>
            <option value="">Choisissez votre question secrète*</option>
            <option>Quel est votre film préféré?</option>
            <option>Quel est le nom de votre premier animal?</option>
            <option>Quel est votre couleur préféré?</option>
            <option>Quel est le meilleur voyage que vous avez fait?</option>
          </select>

        <label for="answer"></label>
        <input type="text" id="answer" name="answer" placeholder="Votre réponse à la question secrète*" required>
        
        <input type="submit" name="bInscription" value="S'inscrire">
      </form>
      <a href="index.php">Retour à la page d'accueil</a>


      <?php
    include('partials/footer.php');?>