<?php
//On récupère la connexion à la bdd
include('admin-connectdb.php');

//Fonction inscription utilisateur, on insère les données de l'utilisateur dans la base de données
function insertdata($name, $firstname, $username, $email, $password, $question, $answer){
  //On récupère notre variable global
  global $bdd;
  $hashedPassword = md5($password);

  // Vérifier si le nom d'utilisateur  existe déjà
  $sqlCheck = "SELECT username FROM User WHERE username = :username OR email = :email";
  $stmtCheck = $bdd->prepare($sqlCheck);
  $stmtCheck->bindParam(':username', $username);
  $stmtCheck->execute();
  $existingUsername = $stmtCheckUsername->fetch(PDO::FETCH_ASSOC);
  // Si l'utilisateur existe déjà, retourner une erreur
  if ($existingUsername) {
      return 'username_exists';
  }

  // Si l'utilisateur est valide on insert les données de l'utilisateur
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

// Fonction pour vérifier l'utilisateur et le mot de passe dans la base de données
function checkUser($username, $password)
{
    global $bdd;

    $sqlUser = "SELECT id, username, password FROM user WHERE username = :username";
    $stm = $bdd->prepare($sqlUser);
    $stm->bindParam(':username', $username, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['password'] == $password) {
        return true;
    }
    return false;
}


  