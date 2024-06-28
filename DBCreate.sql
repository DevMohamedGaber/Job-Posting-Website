CREATE DATABASE IF NOT EXISTS linkedin_clone_db;

USE linkedin_clone_db;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(256),
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(25),
  `password` varchar(256) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `current_company` varchar(50),
  `title` varchar(50),
  `about` text,
  `is_recruiter` boolean NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id)
);

CREATE VIEW IF NOT EXISTS job_seekers AS
	SELECT * FROM users WHERE is_recruiter = FALSE;

CREATE VIEW IF NOT EXISTS recruiters AS
	SELECT * FROM users WHERE is_recruiter = TRUE;

CREATE TABLE IF NOT EXISTS `job_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(256),
  `position` varchar(50) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `author_id` int NOT NULL,
  `salary` float NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `reactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `react_name` varchar(20) NOT NULL,
  `post_id` int NOT NULL,
  `author_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (`post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_post_id` int NOT NULL,
  `job_seeker_id` int NOT NULL,
  `cover_letter` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (`job_post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`job_seeker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `post_id` int NOT NULL,
  `author_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (`post_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text,
  `joining_date` date,
  `leaving_date` date,
  `author_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

-- bridge table
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `skill` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime,
  PRIMARY KEY (id),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);
