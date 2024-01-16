<?php
//On récupère la connexion à la bdd
include('admin-connectdb.php');

//Fonction inscription utilisateur, on insère les données de l'utilisateur dans la base de données
function insertdata($name, $firstname, $username, $birthday, $email, $password, $question, $answer){
  //On récupère notre variable global
  global $bdd;
  $hashedPassword = md5($password);

  // Vérifier si le nom d'utilisateur ou l'email existe déjà
  $sqlCheck = "SELECT username, email FROM User WHERE username = :username OR email = :email";
  $stmtCheck = $bdd->prepare($sqlCheck);
  $stmtCheck->bindParam(':username', $username);
  $stmtCheck->bindParam(':email', $email);
  $stmtCheck->execute();
  $existingUser = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if ($existingUser) {
      if ($existingUser['username'] === $username) {
          return 'username_exists';
      }
      if ($existingUser['email'] === $email) {
          return 'email_exists';
      }
  }

  // Si l'utilisateur et l'email sont valident on insert les données de l'utilisateur
  $sqlUser = "INSERT INTO user (name, firstname, username,  email, password, question, answer) VALUES (:name, :firstname, :username, :email, :password, :question, :answer)";
  //On prépare la requête
  $stmtUser = $bdd->prepare($sqlUser);
  //On binde les paramètres
  $stmUser->bindParam(':name', $name, PDO::PARAM_STR);
    $stmUser->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmUser->bindParam(':username', $username, PDO::PARAM_STR);
    $stmUser->bindParam(':email', $email, PDO::PARAM_STR);
    $stmUser->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmUser->bindParam(':question', $question, PDO::PARAM_STR);
    $stmUser->bindParam(':answer', $answer, PDO::PARAM_STR);
  //On exécute la requête
  try {
    $stmtUser->execute();
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $message = "Une erreur s'est produite";
  }
}