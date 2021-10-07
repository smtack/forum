<?php
class Category {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createCategory() {
    $sql = "INSERT INTO categories (category_name, category_description, category_by) VALUES (:category_name, :category_description, :category_by)";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':category_name' => htmlentities($_POST['category_name']),
      ':category_description' => htmlentities($_POST['category_description']),
      ':category_by' => $this->category_by
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function getCategories() {
    $sql = "SELECT * FROM categories ORDER BY category_id DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getCategory($id) {
    $sql = "SELECT * FROM categories WHERE category_id = :category_id";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':category_id' => $id])) {
      $row = $stmt->fetch();

      return $row;
    } else {
      return false;
    }
  }
}