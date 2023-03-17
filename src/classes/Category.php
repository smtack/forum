<?php
class Category
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function createCategory($data)
  {
    $sql = "INSERT INTO categories (category_name, category_description) VALUES (?, ?)";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['category_name'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['category_description'], PDO::PARAM_STR);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function getCategories()
  {
    $sql = "SELECT
              categories.category_id, categories.category_name, categories.category_description,
              COUNT(topics.topic_id)
              AS
                topics
            FROM
              categories
            LEFT JOIN
              topics
            ON
              topics.topic_id = categories.category_id
            GROUP BY
              categories.category_name, categories.category_description, categories.category_id
            ORDER BY
              categories.category_id
            DESC";
              
    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    
    return false;
  }

  public function getCategory($id)
  {
    $sql = "SELECT * FROM categories WHERE category_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetch();
    }

    return false;
  }

  public function deleteCategory($id)
  {
    $sql = "DELETE FROM categories WHERE category_id = ?";
    
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }
}