<?php
class Post {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function createPost($data) {
    if($this->db->insert('posts', $data)) {
      return true;
    }

    return false;
  }

  public function getPosts() {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            LEFT JOIN
              categories
            ON
              category_id = posts.post_category
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getHomepagePosts($user) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            LEFT JOIN
              categories
            ON
              category_id = posts.post_category
            WHERE
              posts.post_category = categories.category_id AND post_category
            IN
              (SELECT
                category_followed
              FROM
                follows
              WHERE
                user_following = $user)
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute()) {
      $rows = $stmt->fetchAll();

      return $rows;
    }

    return false;
  }

  public function getPostsByCategory($id) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            WHERE
              post_category = :category_id
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute([':category_id' => $id])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getUsersPosts($user) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            LEFT JOIN
              categories
            ON
              category_id = posts.post_category
            WHERE
              post_by = :post_by
            ORDER BY
              post_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute([':post_by' => $user])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function getPost($id) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            WHERE
              post_id = :post_id";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute([':post_id' => $id])) {
      $row = $stmt->fetch();

      return $row;
    } else {
      return false;
    }
  }

  public function createComment($comment) {
    if($this->db->insert('comments', $comment)) {
      return true;
    }

    return false;
  }

  public function getComments($post) {
    $sql = "SELECT
              *
            FROM
              comments
            LEFT JOIN
              users
            ON
              users.user_id = comments.comment_by
            WHERE
              comment_post = :comment_post
            ORDER BY
              comment_date
            DESC";

    $stmt = $this->db->pdo->prepare($sql);

    if($stmt->execute([':comment_post' => $post])) {
      $rows = $stmt->fetchAll();

      return $rows;
    } else {
      return false;
    }
  }

  public function searchPosts($keywords) {
    $sql = "SELECT
              *
            FROM
              posts
            LEFT JOIN
              users
            ON
              users.user_id = posts.post_by
            WHERE
              post_title
            OR
              post_text
            LIKE
              :keywords
            ORDER BY
              post_date
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