<?php
class User
{
  private $db;

  public $user_level;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function signUp($data)
  {
    $sql = "INSERT INTO users (user_name, user_email, user_password, user_joined, user_level) VALUES (?, ?, ?, NOW(), 2)";
              
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['user_name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_email'], PDO::PARAM_STR);
    $stmt->bindParam(3, $data['user_password'], PDO::PARAM_STR);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function logIn($data)
  {
    $sql = "SELECT * FROM users WHERE user_name = ? LIMIT 0,1";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['user_name'], PDO::PARAM_STR);

    $stmt->execute();

    $rows = $stmt->rowCount();

    if($rows > 0)
    {
      $row = $stmt->fetch();

      $this->user_level = $row->user_level;

      if(password_verify($data['user_password'], $row->user_password))
      {
        return true;
      }
    }

    return false;
  }

  public function loggedIn() {
    return isset($_SESSION['logged_in']) ? true : false;
  }

  public function logOut()
  {
    session_destroy();

    return false;
  }

  public function getUser($user)
  {
    if(!is_numeric($user))
    {
      $sql = "SELECT * FROM users WHERE user_name = ? LIMIT 1";

      $stmt = $this->db->pdo->prepare($sql);
  
      $stmt->bindParam(1, $user, PDO::PARAM_STR);
    }
    else
    {
      $sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1";

      $stmt = $this->db->pdo->prepare($sql);
  
      $stmt->bindParam(1, $user, PDO::PARAM_INT);
    }
    
    if($stmt->execute())
    {
      return $stmt->fetch();
    }

    return false;
  }

  public function getUsers()
  {
    $sql = "SELECT * FROM users ORDER BY user_joined DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    
    return false;
  }

  public function updateUser($data)
  {
    $sql = "UPDATE users SET user_email = ? WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['user_email'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_id'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function uploadProfilePicture($data)
  {
    $sql = "UPDATE users SET user_profile_picture = ? WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['user_profile_picture'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_id'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function changePassword($data)
  {
    $sql = "UPDATE users SET user_password = ? WHERE user_id = ?";
    
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['new_password'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['user_id'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }

  public function deleteUser($user)
  {
    $sql = "DELETE FROM users WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }

  public function addModerator($user)
  {
    $sql = "UPDATE users SET user_level = 1 WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }

  public function removeModerator($user)
  {
    $sql = "UPDATE users SET user_level = 2 WHERE user_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }
}