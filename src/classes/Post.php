<?php
class Post {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createPost() {
    $sql = "INSERT INTO posts (post_title, post_text, post_category, post_by) VALUES (:post_title, :post_text, :post_category, :post_by)";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':post_title' => htmlentities($_POST['post_title']),
      ':post_text' => htmlentities($_POST['post_text']),
      ':post_category' => htmlentities($_POST['post_category']),
      ':post_by' => $this->post_by
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function getPosts() {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by ORDER BY post_date DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getPostsByCategory($id) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_category = :category_id ORDER BY post_date DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':category_id' => $id])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getUsersPosts($user) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_by = :post_by ORDER BY post_date DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':post_by' => $user])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getPost($id) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_id = :post_id";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':post_id' => $id])) {
      $row = $stmt->fetch();

      return $row;
    } else {
      return false;
    }
  }

  public function createComment() {
    $sql = "INSERT INTO comments (comment_text, comment_post, comment_by) VALUES (:comment_text, :comment_post, :comment_by)";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([
      ':comment_text' => htmlentities($_POST['comment_text']),
      ':comment_post' => $this->comment_post,
      ':comment_by' => $this->comment_by
    ])) {
      return true;
    } else {
      return false;
    }
  }

  public function getComments($post) {
    $sql = "SELECT * FROM comments LEFT JOIN users ON users.user_id = comments.comment_by WHERE comment_post = :comment_post ORDER BY comment_date DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':comment_post' => $post])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function searchPosts($keywords) {
    $sql = "SELECT * FROM posts LEFT JOIN users ON users.user_id = posts.post_by WHERE post_title OR post_text LIKE :keywords ORDER BY post_date DESC";

    $stmt = $this->db->prepare($sql);

    if($stmt->execute([':keywords' => $keywords])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }
}