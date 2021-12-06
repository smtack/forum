<?php
class User {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createUser($data) {
    if($this->db->insert('users', $data)) {
      return true;
    }

    return false;
  }

  public function checkUser($user) {
    if($this->db->exists('users', array('user_username' => $user['user_username']))) {
      $stmt = $this->db->select('users', array('user_username' => $user['user_username']));

      $row = $stmt->fetch();

      if(password_verify($user['user_password'], $row->user_password)) {
        return true;
      }
    }

    return false;
  }

  public function logOut() {
    session_destroy();

    return;
  }

  public function getUser($user) {
    if($stmt = $this->db->select('users', array('user_username' => $user))) {
      $row = $stmt->fetch();

      return $row;
    }

    return false;
  }

  public function updateUser($data, $id) {
    if($this->db->update('users', $data, array('user_id' => $id))) {
      return true;
    }

    return false;
  }

  public function changePassword($password, $id) {
    if($this->db->update('users', $password, array('user_id' => $id))) {
      return true;
    }

    return false;
  }

  public function deleteProfile($user) {
    if($this->db->delete('users', array('user_id' => $user))) {
      return true;
    }

    return false;
  }

  public function searchUsers($keywords) {
    $sql = "SELECT
              *
            FROM
              users
            WHERE
              user_username
            LIKE
              :keywords
            ORDER BY
              user_joined
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute([':keywords' => $keywords])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }
}