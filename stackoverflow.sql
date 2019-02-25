-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `uddated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `uddated_at`) VALUES
(39,	'laravel',	NULL,	NULL),
(40,	'java',	NULL,	NULL),
(41,	'php',	NULL,	NULL),
(42,	'',	NULL,	NULL);

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(1,	27,	1,	'gsgsgsggsgdg',	'2019-02-16 17:28:26',	'2019-02-16 17:28:26'),
(2,	26,	1,	'fsddgdsdg',	'2019-02-16 15:52:41',	'2019-02-16 15:52:41'),
(4,	27,	1,	'fsdsgsgdds',	'2019-02-20 20:07:55',	'2019-02-20 20:07:55'),
(7,	27,	13,	'safas',	'2019-02-20 20:35:20',	'2019-02-20 20:35:20'),
(8,	27,	21,	'sdfgsdg',	'2019-02-25 06:39:40',	'2019-02-25 06:39:40'),
(49,	27,	21,	'afasf',	'2019-02-25 11:34:23',	'2019-02-25 11:34:23');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `posts` (`id`, `user_id`, `cat_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1,	27,	39,	'sgdsg',	'sdfgsdfgdfgsdfgsfgsgdsfsg',	'2019-02-16 16:33:07',	'2019-02-16 16:33:07'),
(6,	27,	39,	'final post',	'asfaflsdfl lhahsdfh l;lasdlfh loriaijdj',	'2019-02-16 16:33:07',	'2019-02-16 16:33:07'),
(8,	27,	39,	'fhcfh',	'gagadfga',	'2019-02-16 16:33:07',	'2019-02-16 16:33:07'),
(9,	27,	40,	'post time check',	'this is for post time check',	'2019-02-16 16:33:07',	'2019-02-16 16:33:07'),
(13,	27,	41,	'cbzx',	'asdfsadfsadfasfasdfasdf asdfasd asdf',	'2019-02-16 17:46:48',	'2019-02-16 17:46:48'),
(14,	27,	39,	'accha kita kortham',	'dfgsdgsdfgsdfg sdfgs d',	'2019-02-16 17:46:27',	'2019-02-16 17:46:27'),
(20,	27,	39,	'titlejla',	'asfasfasdfs it\'s okay bosss',	'2019-02-20 16:28:06',	'2019-02-20 16:28:06'),
(21,	27,	40,	'AbracaDabraasfsadfas asdf',	'asfasdfasfsd asdfas sfsadcv',	'2019-02-20 16:28:19',	'2019-02-20 16:28:19');

DROP TABLE IF EXISTS `replies`;
CREATE TABLE `replies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `comment_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `reply` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  KEY `comment_id` (`comment_id`),
  CONSTRAINT `replies_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `replies_ibfk_4` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `replies_ibfk_5` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `replies` (`id`, `post_id`, `comment_id`, `user_id`, `reply`, `created_at`, `updated_at`) VALUES
(2,	1,	2,	27,	'afsaf',	'2019-02-25 11:17:36',	'2019-02-25 11:17:36'),
(3,	21,	8,	27,	'sdfsg',	'2019-02-25 11:28:27',	'2019-02-25 11:28:27'),
(4,	21,	8,	27,	'ssgsdfsg',	'2019-02-25 11:28:42',	'2019-02-25 11:28:42');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `bio` text,
  `role` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `bio`, `role`, `created_at`, `updated_at`) VALUES
(24,	'hala',	'hala@mail.com',	'e10adc3949ba59abbe56e057f20f883e',	NULL,	0,	'2019-02-16 17:19:49',	'2019-02-16 17:19:49'),
(25,	'pias',	'pias@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	NULL,	0,	'2019-02-16 17:19:49',	'2019-02-16 17:19:49'),
(26,	'nikhil',	'nikhil@mail.com',	'e10adc3949ba59abbe56e057f20f883e',	NULL,	0,	'2019-02-16 17:19:49',	'2019-02-16 17:19:49'),
(27,	'sperrow',	'sperrow@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	NULL,	1,	'2019-02-16 17:19:49',	'2019-02-16 17:19:49');

-- 2019-02-25 17:27:39
