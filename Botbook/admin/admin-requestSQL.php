<?php
//On récupère la connexion à la bdd
include('admin-connectdb.php');

//Fonction inscription utilisateur, on insère les données de l'utilisateur dans la base de données
function insertdata($lastname, $firstname, $username, $email,  $password1,  $question, $answer)
{
  //On récupère notre variable global
  global $bdd;

  // on insert les données de l'utilisateur
  $sqlUser = "INSERT INTO user (lastname, firstname, username,  email, password1, question, answer) VALUES (:lastname, :firstname, :username, :email, :password1, :question, :answer)";
  //On prépare la requête
  $stmtUser = $bdd->prepare($sqlUser);
  //On binde les paramètres
  if ($stmtUser) {
    $stmtUser->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmtUser->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmtUser->bindParam(':username', $username, PDO::PARAM_STR);
    $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
    $stmtUser->bindParam(':password1', $password1, PDO::PARAM_STR);
    $stmtUser->bindParam(':question', $question, PDO::PARAM_STR);
    $stmtUser->bindParam(':answer', $answer, PDO::PARAM_STR);

    try {
      $stmtUser->execute();
    } catch (PDOException $e) {
      echo "Erreur : " . $e->getMessage();
      $message = "Une erreur s'est produite";
    }
  }
}

// Fonction pour vérifier l'utilisateur et le mot de passe dans la base de données
function checkUser($username, $password1)
{
  global $bdd;
  //var_dump($password1, $username);exit;
  
  $sqlUser = "SELECT username, password1 FROM user where username= :username and password1 = :password1";

  $stm = $bdd->prepare($sqlUser);
  $stm->bindParam(':username', $username, PDO::PARAM_STR);
  $stm->bindParam(':password1', $password1, PDO::PARAM_STR);
  
  $stm->execute();
  //var_dump($stm); exit;
  $result = $stm->fetch(PDO::FETCH_ASSOC);
  //var_dump($result); exit;
  if ($result && $result['password1'] == $password1) {
    return true;
  }
  return false;
}
