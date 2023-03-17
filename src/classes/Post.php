<?php
class Post
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function createPost($data)
  {
    $sql = "INSERT INTO posts (post_content, post_date, post_topic, post_by) VALUES (?, NOW(), ?, ?)";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['post_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['post_topic'], PDO::PARAM_INT);
    $stmt->bindParam(3, $data['post_by'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function getPosts($topic)
  {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              posts.post_by = users.user_id
            WHERE
              posts.post_topic = ?
            ORDER BY
              post_id
            ASC";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $topic, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }

    return false;
  }

  public function getPost($post)
  {
    $sql = "SELECT * FROM posts WHERE post_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $post, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return $stmt->fetch();
    }
    
    return false;
  }

  public function updatePost($data)
  {
    $sql = "UPDATE posts SET post_content = ? WHERE post_id = ?";

    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $data['post_content'], PDO::PARAM_STR);
    $stmt->bindParam(2, $data['post_id'], PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }

    return false;
  }

  public function deletePost($post)
  {
    $sql = "DELETE FROM posts WHERE post_id = ?";
    
    $stmt = $this->db->pdo->prepare($sql);

    $stmt->bindParam(1, $post, PDO::PARAM_INT);

    if($stmt->execute())
    {
      return true;
    }
    
    return false;
  }
}