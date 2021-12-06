-- CREATE DATABASE

CREATE DATABASE `forum`;

-- CREATE USERS TABLE

CREATE TABLE `users` (
  `user_id` INT(8) NOT NULL AUTO_INCREMENT,
  `user_username` VARCHAR(50) NOT NULL,
  `user_email` VARCHAR(256) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_joined` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `user_level` INT(8) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=INNODB;

-- CREATE CATEGORIES TABLE

CREATE TABLE `categories` (
  `category_id` INT(8) NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(50) NOT NULL,
  `category_description` VARCHAR(500),
  `category_created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `category_by` INT(8) NOT NULL,
  PRIMARY KEY (category_id)
) ENGINE=INNODB;

-- CREATE FOLLOWS TABLE

CREATE TABLE `follows` (
  `follow_id` INT(8) NOT NULL AUTO_INCREMENT,
  `user_following` INT(8) NOT NULL,
  `category_followed` INT(8) NOT NULL,
  PRIMARY KEY (follow_id)
) ENGINE=INNODB;

-- CREATE POSTS TABLE

CREATE TABLE `posts` (
  `post_id` INT(8) NOT NULL AUTO_INCREMENT,
  `post_title` VARCHAR(256) NOT NULL,
  `post_text` VARCHAR(5000),
  `post_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `post_category` INT(8) NOT NULL,
  `post_by` INT(8) NOT NULL,
  PRIMARY KEY (post_id)
) ENGINE=INNODB;

-- CREATE COMMENTS TABLE

CREATE TABLE `comments` (
  `comment_id` INT(8) NOT NULL AUTO_INCREMENT,
  `comment_text` VARCHAR(5000) NOT NULL,
  `comment_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `comment_post` INT(8) NOT NULL,
  `comment_by` INT(8) NOT NULL,
  PRIMARY KEY (comment_id)
) ENGINE=INNODB;