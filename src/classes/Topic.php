<?php
class Topic
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function createTopic($data)
  {
    $sql = "INSERT INTO topics (topic_subject, topic_date, topic_category, topic_by) VALUES (?, NOW(), ?, ?)";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['topic_subject'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['topic_category'], PDO::PARAM_STR);
    $stmt->bindParam(3, $data['topic_by'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }

  public function getTopics($category)
  {
    $sql = "SELECT * FROM topics WHERE topic_category = ? ORDER BY topic_id DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $category, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    
    return false;
  }

  public function getTopic($id)
  {
    $sql = "SELECT * FROM topics WHERE topics.topic_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $id, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetch();
    }
    
    return false;
  }

  public function getLastTopic($category_id)
  {
    $sql = "SELECT
              *
            FROM
              topics
            WHERE
              topic_category = ?
            ORDER BY
              topic_date
            DESC
            LIMIT
              1";
              
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $category_id, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetch();
    }
    
    return false;
  }

  public function getUsersTopics($user)
  {
    $sql = "SELECT
              *
            FROM
              topics
            LEFT JOIN 
              users
            ON
              topics.topic_by = users.user_id
            LEFT JOIN
              categories
            ON
              topics.topic_category = categories.category_id
            WHERE
              topic_by = ?
            ORDER BY
              topic_id
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $user, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    
    return false;
  }

  public function deleteTopic($topic)
  {
    $sql = "DELETE FROM topics WHERE topic_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $topic, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }

  public function searchTopics($keywords)
  {
    $sql = "SELECT
              *
            FROM
              topics
            LEFT JOIN
              users
            ON
              topics.topic_by = users.user_id
            LEFT JOIN
              categories
            ON
              topics.topic_category = categories.category_id
            WHERE
              topics.topic_subject
            LIKE
              ?
            ORDER BY
              topics.topic_date
            DESC";
      
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $keywords, PDO::PARAM_STR);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    
    return false;
  }
}