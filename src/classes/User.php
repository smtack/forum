<?php
class User {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function signUp() {
    $sql = "INSERT INTO users (user_username, user_email, user_password) VALUES (:user_username, :user_email, :user_password)";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':user_username' => htmlentities($_POST['user_username']),
      ':user_email' => htmlentities($_POST['user_email']),
      ':user_password' => password_hash($_POST['user_password'], PASSWORD_BCRYPT)
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function logIn() {
    $sql = "SELECT * FROM users WHERE user_username = :user_username LIMIT 1";

    $stmt = $this->db->prepare($sql);    
    $stmt->execute([':user_username' => htmlentities($_POST['user_username'])]);

    $rows = $stmt->rowCount();

    if($rows > 0) {
      $row = $stmt->fetch();

      $this->user_username = $row->user_username;
      $this->user_password = $row->user_password;

      return true;
    } else {
      return false;
    }
  }

  public function logOut() {
    session_destroy();

    return false;
  }

  public function getUser() {
    $sql = "SELECT * FROM users WHERE user_username = :user_username";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':user_username' => $_SESSION['user_username']])) {
      $row = $stmt->fetch();

      return $row;
    } else {
      return false;
    }
  }

  public function updateUser($id) {
    $sql = "UPDATE users SET user_email = :user_email WHERE user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':user_id' => $id,
      ':user_email' => htmlentities($_POST['user_email'])
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function changePassword($id) {
    $sql = "UPDATE users SET user_password = :user_password WHERE user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':user_id' => $id,
      ':user_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteProfile($id) {
    $sql = "DELETE FROM users WHERE user_id = :user_id";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':user_id' => $id])) {
      return true;
    } else {
      return false;
    }
  }

  public function getProfile($user) {
    $sql = "SELECT * FROM users WHERE user_username = :user_username";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':user_username' => $user])) {
      $row = $stmt->fetch();

      return $row;
    } else {
      return false;
    }
  }

  public function searchUsers($keywords) {
    $sql = "SELECT * FROM users WHERE user_username LIKE :keywords ORDER BY user_joined DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':keywords' => $keywords])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }
}