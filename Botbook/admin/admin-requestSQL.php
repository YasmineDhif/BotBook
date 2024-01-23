<?php
//On récupère la connexion à la bdd
include('admin-connectdb.php');
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


//Fonction inscription utilisateur, on insère les données de l'utilisateur dans la base de données
function insertdata($lastname, $firstname, $username, $email,  $password1,  $question, $answer)
{
  //On récupère notre variable global
  global $bdd;

  // Vérification si le nom d'utilisateur est unique
 $sqlCheckUsername = "SELECT username FROM user WHERE username= :username";
 $stmtCheckUsername = $bdd->prepare($sqlCheckUsername);
 $stmtCheckUsername->bindParam(':username', $username);
 $stmtCheckUsername->execute();
 $existingUsername = $stmtCheckUsername->fetch(PDO::FETCH_ASSOC);
 // Si l'utilisateur existe déjà, retourner une erreur
 if ($existingUsername) {
     return 'username_exists';
 }

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
  
  $sqlUser = "SELECT id, username, password1 FROM user where username= :username and password1 = :password1";

  $stm = $bdd->prepare($sqlUser);
  $stm->bindParam(':username', $username, PDO::PARAM_STR);
  $stm->bindParam(':password1', $password1, PDO::PARAM_STR);
  
  $stm->execute();
  //var_dump($stm); exit;
  $result = $stm->fetch(PDO::FETCH_ASSOC);
  //var_dump($result); exit;

  if ($result && $result['password1'] == $password1) {
    $_SESSION['user_id']=  $result['id'];
    
    return true;
  }
  return false;
}


// fonction ajout de contact dans la base de données
function insertContact( $lastname, $firstname, $email, $phone, $address, $user_id) {
  global $bdd;

  $sqlContact = "INSERT INTO contact (lastname, firstname, email, phone, address, user_id ) VALUES (:lastname, :firstname, :email, :phone, :address, :user_id)";
  
  $stmt = $bdd->prepare($sqlContact);

  $user_id = $_SESSION['user_id'];
var_dump($user_id);  // Ajout de cet var_dump pour afficher l'identifiant de l'utilisateur
  $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
  $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
  $stmt->bindParam(':address', $address, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

  try {
    $stmt->execute();
    return true;
} catch (PDOException $e) {
    error_log("Erreur lors de l'ajout du contact : " . $e->getMessage());
    echo "Erreur lors de l'ajout du contact : " . $e->getMessage();  // Ajout de cet echo pour afficher l'erreur
    return false;
}
}

function getContacts($user_id) {
  global $bdd;

  $sql = "SELECT id, lastname, firstname, email, phone, address, user_id FROM contact WHERE user_id = :user_id"; // Ajout de la colonne 'user_id'
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

  try {
      $stmt->execute();
      $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $contacts;
  } catch (PDOException $e) {
      error_log("Erreur lors de la récupération des contacts : " . $e->getMessage());
      return false;
  }
}

function deleteContact($contact_id, $user_id) {
  global $bdd;

  $sql = "DELETE FROM contact WHERE id = :contact_id AND user_id = :user_id";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

  try {
      $stmt->execute();
      return true;
  } catch (PDOException $e) {
      error_log("Erreur lors de la suppression du contact : " . $e->getMessage());
      return false;
  }
}

function getContactDetails($contact_id, $user_id) {
  global $bdd;

  $sql = "SELECT id, lastname, firstname, email, phone, address FROM contact WHERE id = :contact_id AND user_id = :user_id";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

  try {
      $stmt->execute();
      $contactDetails = $stmt->fetch(PDO::FETCH_ASSOC);
      return $contactDetails;
  } catch (PDOException $e) {
      error_log("Erreur lors de la récupération des détails du contact : " . $e->getMessage());
      return false;
  }
}

function updateContact($contact_id, $user_id, $lastname, $firstname, $email, $phone, $address) {
  global $bdd;

  $sql = "UPDATE contact SET lastname = :lastname, firstname = :firstname, email = :email, phone = :phone, address = :address WHERE id = :contact_id AND user_id = :user_id";
  $stmt = $bdd->prepare($sql);
  $stmt->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
  $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
  $stmt->bindParam(':address', $address, PDO::PARAM_STR);

  try {
      $stmt->execute();
      return true;
  } catch (PDOException $e) {
      error_log("Erreur lors de la mise à jour du contact : " . $e->getMessage());
      return false;
  }
}

function importCSV($file)
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (!$user_id) {
        exit('User ID not found in session.');
    }

    $handle = fopen($file, "r");

    $mysqli = new mysqli('localhost', 'root', '', 'adb_login');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $lastname = $data[0];
      $firstname = $data[1];
      $email = $data[2];
      $phone = $data[3];
      $address = $data[4];

      insertContact($lastname, $firstname, $email, $phone, $address, $user_id);
  }

    fclose($handle);
    $mysqli->close();
}

function uploadContact($lastname, $firstname, $email, $phone, $address, $user_id, $notes)
{
    $mysqli = new mysqli('localhost', 'root', '', 'adb_login');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $stmt = $mysqli->prepare("INSERT INTO adds (lastname, firstname, email, phone, address, notes, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssis", $lastname, $firstname, $email, $phone, $address, $notes, $user_id);
        $stmt->execute();

        if ($stmt->errno) {
            echo "Failed to add user: " . $stmt->error;
        } else {
            echo "User added successfully";
            header("Location: listContact.php");
            exit();
        }

        $stmt->close();
    } else {
        header("Location: listContact.php");
    }

    $mysqli->close();
}