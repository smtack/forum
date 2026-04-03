-- SQL CODE FOR FORUM DATABASE

CREATE DATABASE `forum`;

-- USE DATABASE

USE `forum`;

-- CREATE USERS TABLE

CREATE TABLE `users` (
  `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_name` VARCHAR(32) NOT NULL,
  `user_email` VARCHAR(256) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `user_profile_picture` VARCHAR(256) DEFAULT "default.png", 
  `user_joined` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `user_level` INT NOT NULL,
  UNIQUE INDEX user_name_unique (user_name)
) ENGINE=INNODB;

-- CREATE CATEGORIES TABLE

CREATE TABLE `categories` (
  `category_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category_name` VARCHAR(256) NOT NULL,
  `category_description` VARCHAR(256) NOT NULL,
  UNIQUE INDEX category_name_unique (category_name)
) ENGINE=INNODB;

-- CREATE TOPICS TABLE

CREATE TABLE `topics` (
  `topic_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `topic_subject` VARCHAR(256) NOT NULL,
  `topic_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `topic_category` INT NOT NULL,
  `topic_by` INT NOT NULL
) ENGINE=INNODB;

-- CREATE POSTS TABLE

CREATE TABLE `posts` (
  `post_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `post_content` VARCHAR(5000) NOT NULL,
  `post_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `post_topic` INT NOT NULL,
  `post_by` INT NOT NULL
) ENGINE=INNODB;

-- LINK TOPICS AND CATEGORIES TABLE

ALTER TABLE
  `topics`
ADD FOREIGN KEY
  (topic_category)
REFERENCES
  categories(category_id)
ON DELETE CASCADE ON UPDATE CASCADE;

-- LINK TOPICS AND USERS TABLE

ALTER TABLE
  `topics`
ADD FOREIGN KEY
  (topic_by)
REFERENCES
  users(user_id)
ON DELETE CASCADE ON UPDATE CASCADE;

-- LINK POSTS AND TOPICS TABLE

ALTER TABLE
  `posts`
ADD FOREIGN KEY
  (post_topic)
REFERENCES
  topics(topic_id)
ON DELETE CASCADE ON UPDATE CASCADE;

-- LINK POSTS AND USERS TABLE

ALTER TABLE
  `posts`
ADD FOREIGN KEY
  (post_by)
REFERENCES
  users(user_id)
ON DELETE CASCADE ON UPDATE CASCADE;