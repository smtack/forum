<?php
class Category {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createCategory($category) {
    if($this->db->insert('categories', $category)) {
      return true;
    }

    return false;
  }

  public function getCategories() {
    $sql = "SELECT
              *
            FROM
              categories
            LEFT JOIN
              users
            ON
              users.user_id = categories.category_by
            ORDER BY
              category_created
            DESC";
    
    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    }

    return false;
  }

  public function getUsersFollows($user) {
    $sql = "SELECT
              *
            FROM
              categories
            LEFT JOIN
              follows
            ON
              categories.category_id = follows.category_followed
            WHERE
              follows.user_following = $user";
    
    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    }

    return false;
  }

  public function getCategory($id) {
    if($stmt = $this->db->select('categories', array('category_id' => $id))) {
      $row = $stmt->fetch();

      return $row;
    }
  }

  public function followCategory($user, $category) {
    if($this->db->insert('follows', array('user_following' => $user, 'category_followed' => $category))) {
      return true;
    }

    return false;
  }

  public function unfollowCategory($user, $category) {
    if($this->db->delete('follows', array('user_following' => $user, 'category_followed' => $category))) {
      return true;
    }

    return false;
  }

  public function getFollowData($category) {
    $sql = "SELECT * FROM follows WHERE category_followed = $category";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $rows;
    }

    return false;
  }

  public function searchCategories($keywords) {
    $sql = "SELECT
              *
            FROM
              categories
            LEFT JOIN
              users
            ON
              users.user_id = categories.category_by
            WHERE
              category_name
            OR
              category_description
            LIKE
              :keywords
            ORDER BY
              category_created
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