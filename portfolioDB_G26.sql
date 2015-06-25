-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `replaces_id` int(10) unsigned DEFAULT NULL,
  `state` int(10) unsigned NOT NULL,
  `refusal_msg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comments_project_id_foreign` (`project_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_approved_by_foreign` (`approved_by`),
  KEY `comments_replaces_id_foreign` (`replaces_id`),
  CONSTRAINT `comments_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_replaces_id_foreign` FOREIGN KEY (`replaces_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `institutions`;
CREATE TABLE `institutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `institutions` (`id`, `name`) VALUES
(1,	'Instituto Politécnico de Leiria'),
(2,	'Instituto Politécnico de Santarém'),
(3,	'Instituto Politécnico de Lisboa'),
(4,	'Instituto Politécnico do Porto'),
(5,	'Instituto Politécnico de Tomar'),
(6,	'Instituto Politécnico de Beja'),
(7,	'Universidade de Lisboa'),
(8,	'Universidade de Coimbra'),
(9,	'Universidade de Porto'),
(10,	'Universidade de Aveiro'),
(11,	'Universidade do Minho'),
(12,	'Universidade do Algarve'),
(13,	'Universidade da Beira Interior'),
(14,	'Centro de Investigação em Informática e Comunicações'),
(15,	'INESC'),
(16,	'Instituto de Telecomunicações');

DROP TABLE IF EXISTS `institution_project`;
CREATE TABLE `institution_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `institution_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `institution_project_institution_id_project_id_unique` (`institution_id`,`project_id`),
  KEY `institution_project_project_id_foreign` (`project_id`),
  CONSTRAINT `institution_project_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `institution_project_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flags` smallint(6) NOT NULL,
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ext_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `int_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `approved_by` int(10) unsigned NOT NULL,
  `replaces_id` int(10) unsigned DEFAULT NULL,
  `state` int(10) unsigned NOT NULL,
  `refusal_msg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `media_project_id_foreign` (`project_id`),
  KEY `media_created_by_foreign` (`created_by`),
  KEY `media_approved_by_foreign` (`approved_by`),
  KEY `media_replaces_id_foreign` (`replaces_id`),
  CONSTRAINT `media_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `media_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `media_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `media_replaces_id_foreign` FOREIGN KEY (`replaces_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `media` (`id`, `project_id`, `title`, `description`, `alt`, `flags`, `mime_type`, `ext_url`, `int_file`, `public_name`, `created_by`, `approved_by`, `replaces_id`, `state`, `refusal_msg`, `created_at`, `updated_at`) VALUES
(7,	3,	'Deleniti numquam nesciunt qui.',	'Maxime vero ut minima rerum numquam ut. Vitae doloremque natus molestiae ipsam quo praesentium. Aut error quisquam hic molestiae ea consequatur.',	'Quia repellat omnis officiis quas eveniet.',	0,	'image/jpg',	NULL,	'projects/Dehole6.jpg',	'projects/Dehole6.jpg',	17,	3,	NULL,	1,	NULL,	'2015-06-17 23:51:06',	'2015-06-17 23:51:06'),
(10,	3,	'Voluptatem id nihil repudiandae.',	'Dolores minima minus dolor veritatis officiis inventore. Iure error esse eos quis unde dolorum praesentium.',	'Molestiae mollitia est quisquam et.',	0,	'image/jpg',	NULL,	'projects/Dehole9.jpg',	'projects/Dehole9.jpg',	6,	15,	NULL,	1,	NULL,	'2015-06-17 23:51:11',	'2015-06-17 23:51:11'),
(11,	4,	'Nihil incidunt molestiae nostrum.',	'Iure accusantium suscipit est ipsa. Consequatur temporibus distinctio laborum est est sint maxime. Et quod ut quo at saepe quidem.',	'Ullam quis minus.',	0,	'image/jpg',	NULL,	'projects/Ivale10.jpg',	'projects/Ivale10.jpg',	10,	15,	NULL,	1,	NULL,	'2015-06-17 23:51:12',	'2015-06-17 23:51:12'),
(14,	2,	'Et numquam rerum iste.',	'Nisi quis.',	'Asperiores natus ex omnis.',	0,	'image/jpg',	NULL,	'projects/Uip13.jpg',	'projects/Uip13.jpg',	3,	16,	NULL,	1,	NULL,	'2015-06-17 23:51:15',	'2015-06-17 23:51:15'),
(17,	4,	'Facilis neque consequatur.',	'Ut tenetur dolor in rerum. Vel vel laudantium rerum quis. Minus odio soluta repellendus et et officia quisquam.',	'Ipsam consequuntur distinctio eum beatae quibusdam.',	0,	'image/jpg',	NULL,	'projects/Ivale16.jpg',	'projects/Ivale16.jpg',	15,	5,	NULL,	1,	NULL,	'2015-06-17 23:51:18',	'2015-06-17 23:51:18'),
(18,	2,	'Fugiat porro accusantium.',	'Sed.',	'Unde sed sunt nisi totam.',	0,	'image/jpg',	NULL,	'projects/Uip17.jpg',	'projects/Uip17.jpg',	19,	20,	NULL,	1,	NULL,	'2015-06-17 23:51:19',	'2015-06-17 23:51:19'),
(20,	4,	'Aut dolor id aut.',	'Facilis provident aspernatur inventore. Explicabo magni esse quos quas incidunt. Voluptatum voluptates consequatur ducimus nemo. Illum quis modi aut fugit voluptates qui.',	'Accusamus doloremque minus veritatis.',	0,	'image/jpg',	NULL,	'projects/Ivale19.jpg',	'projects/Ivale19.jpg',	15,	14,	NULL,	1,	NULL,	'2015-06-17 23:51:20',	'2015-06-17 23:51:20');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_03_01_000001_create_institutions_table',	1),
('2015_03_01_000002_create_tags_table',	1),
('2015_03_01_000010_create_users_table',	1),
('2015_03_01_000100_create_projects_table',	1),
('2015_03_01_001000_create_institution_project_table',	1),
('2015_03_01_002000_create_project_tag_table',	1),
('2015_03_01_003000_create_project_user_table',	1),
('2015_03_01_004000_create_media_table',	1),
('2015_03_01_005000_create_comments_table',	1);

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acronym` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8_unicode_ci,
  `started_at` date NOT NULL,
  `finished_at` date DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `used_software` text COLLATE utf8_unicode_ci,
  `used_hardware` text COLLATE utf8_unicode_ci,
  `observations` text COLLATE utf8_unicode_ci,
  `featured_until` date DEFAULT NULL,
  `replaces_id` int(10) unsigned DEFAULT NULL,
  `state` int(10) unsigned NOT NULL,
  `refusal_msg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `projects_created_by_foreign` (`created_by`),
  KEY `projects_updated_by_foreign` (`updated_by`),
  KEY `projects_approved_by_foreign` (`approved_by`),
  KEY `projects_replaces_id_foreign` (`replaces_id`),
  CONSTRAINT `projects_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_replaces_id_foreign` FOREIGN KEY (`replaces_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `projects_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `projects` (`id`, `name`, `acronym`, `description`, `type`, `theme`, `keywords`, `started_at`, `finished_at`, `created_by`, `updated_by`, `approved_by`, `used_software`, `used_hardware`, `observations`, `featured_until`, `replaces_id`, `state`, `refusal_msg`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Assimilated attitude-oriented conglomeration',	'Aaco',	'Eaque dolorem odit architecto error velit. Modi qui quas praesentium et est quam. Placeat molestiae voluptate sed aliquid.',	'Ratione ratione qui et enim aliquam.',	'et',	'vero, velit',	'2014-08-31',	NULL,	6,	13,	NULL,	'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/5350 (KHTML, like Gecko) Chrome/39.0.807.0 Mobile Safari/5350',	NULL,	NULL,	'2017-02-02',	NULL,	1,	NULL,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(2,	'Upgradable impactful processimprovement',	'Uip',	'Magnam odio et reprehenderit dolore sunt. Non quia tempora eum sunt. Incidunt blanditiis omnis aut dolorum.\r\nEt impedit dolor odit saepe asperiores non et. Est quod quidem aut laborum cumque pariatur quia. Sequi eaque sapiente reprehenderit laboriosam.\r\nDolorem autem voluptas enim aut est. Inventore dolor sapiente et odit harum corrupti architecto. Explicabo debitis perspiciatis et.',	'Quis commodi eum.',	'blanditiis',	'iste, accusamus, placeat, quidem, voluptas',	'2011-06-05',	NULL,	12,	20,	NULL,	NULL,	NULL,	'Maiores et nam asperiores error eveniet.',	'2017-10-29',	NULL,	1,	NULL,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(3,	'Decentralized homogeneous leverage',	'Dehole',	'Error perspiciatis placeat numquam asperiores. Nihil blanditiis vel laboriosam eaque. Aliquid aut sit perspiciatis molestias voluptates amet.\r\nAlias et laboriosam quae eius. Consectetur at et nulla accusantium nemo deleniti. Et quos laborum sit illum. In et beatae dolores ullam tempora eligendi.',	'Qui consectetur neque nostrum officiis.',	'facilis',	'consequatur, consequatur, odit, similique',	'2014-08-30',	NULL,	3,	14,	NULL,	'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_6_8) AppleWebKit/5310 (KHTML, like Gecko) Chrome/38.0.813.0 Mobile Safari/5310',	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(4,	'Implemented value-added leverage',	'Ivale',	'Accusantium nihil numquam mollitia quaerat. Itaque facilis eius nisi tempore consequatur. Sed quae consequuntur officiis eum et pariatur quam. Maiores voluptates expedita hic harum.',	'Odit ut reprehenderit eos voluptatum.',	'aut',	'debitis, illo, eligendi',	'2012-02-11',	NULL,	11,	14,	NULL,	'Opera/9.55 (X11; Linux i686; en-US) Presto/2.9.201 Version/10.00',	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00');

DROP TABLE IF EXISTS `project_tag`;
CREATE TABLE `project_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `state` int(11) NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_tag_project_id_tag_id_unique` (`project_id`,`tag_id`),
  KEY `project_tag_tag_id_foreign` (`tag_id`),
  KEY `project_tag_added_by_foreign` (`added_by`),
  KEY `project_tag_approved_by_foreign` (`approved_by`),
  CONSTRAINT `project_tag_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_tag_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_tag_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `project_tag` (`id`, `project_id`, `tag_id`, `state`, `added_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	1,	16,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(2,	1,	2,	1,	11,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(3,	2,	5,	1,	1,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(4,	2,	1,	1,	15,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(5,	2,	6,	1,	16,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(6,	3,	8,	1,	20,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(8,	4,	9,	1,	6,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(9,	4,	10,	1,	15,	8,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00');

DROP TABLE IF EXISTS `project_user`;
CREATE TABLE `project_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_user_user_id_project_id_unique` (`user_id`,`project_id`),
  KEY `project_user_project_id_foreign` (`project_id`),
  CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `project_user` (`id`, `user_id`, `project_id`, `position`, `created_at`, `updated_at`) VALUES
(1,	12,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(2,	2,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(3,	20,	1,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(4,	19,	2,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(5,	5,	2,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(6,	9,	3,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(7,	2,	3,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(8,	2,	4,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(9,	11,	4,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(10,	6,	4,	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tags` (`id`, `tag`) VALUES
(1,	'Web'),
(2,	'Engenharia de Software'),
(3,	'Computação Móvel'),
(4,	'Cloud'),
(5,	'Segurança'),
(6,	'Programação'),
(7,	'Investigação'),
(8,	'Licenciatura'),
(9,	'Mestrado'),
(10,	'Curso de Especialização Tecnológica');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `institution_id` int(10) unsigned NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flags` smallint(6) NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_alt_email_unique` (`alt_email`),
  KEY `users_institution_id_foreign` (`institution_id`),
  CONSTRAINT `users_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `alt_email`, `password`, `institution_id`, `position`, `photo_url`, `profile_url`, `flags`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Joaquim Nelson Valente Almeida',	'ralmeida@andrade.info',	NULL,	'$2y$10$zYZD8j3Kg.jBKooQAv8.T.hoAX.q0.4wodrefwaKF/yNvJiYLxUGO',	2,	'evolve innovative webservices',	'ralmeida.jpg',	'http://batista.com/non-neque-pariatur-fuga',	1,	2,	NULL,	'2015-06-19 13:37:45',	'2015-06-19 13:37:45'),
(2,	'Lara Silva de Torres',	'lara.torres@castro.net',	NULL,	'$2y$10$ILcivw8LiNzSxWYXT44zmeCXuVlJrHZjQvyXYWaZpmF9Qq3TMjPDO',	13,	'streamline revolutionary systems',	'lara.torres.jpg',	'http://www.jesus.com/alias-numquam-excepturi-dignissimos-nesciunt-exercitationem-perferendis',	0,	2,	NULL,	'2015-06-17 23:50:44',	'2015-06-17 23:50:44'),
(3,	'Renata Luna Domingues',	'domingues.renata@lourenco.com',	NULL,	'$2y$10$jd5QG07sNbGZ6rsB4OGUtezRnyThupzhHWiNEToqk/vjc4zksZqiS',	3,	'engage customized supply-chains',	'domingues.renata.jpg',	'http://marques.com/',	0,	2,	NULL,	'2015-06-17 23:50:45',	'2015-06-17 23:50:45'),
(5,	'Clara Joana Sá de Miranda',	'clara.miranda@machado.com',	NULL,	'$2y$10$cqWIkYTDv85rWr3y.IGSIO9KHXIZoRcQD7H/QOni2zbMRQaCOCzIu',	1,	'maximize front-end systems',	'clara.miranda.jpg',	'http://www.magalhaes.com/quo-non-quia-doloribus-mollitia-aut-voluptatem-laborum.html',	0,	2,	NULL,	'2015-06-17 23:50:47',	'2015-06-17 23:50:47'),
(6,	'Margarida Freitas de Henriques',	'margarida.henriques@matias.net',	NULL,	'$2y$10$ZgsPNMJwHFGlKryHsFf1u.Qfl5Ur7o1lO3DV4VKPu6052jXehjgO6',	4,	'harness open-source methodologies',	'margarida.henriques.jpg',	'http://www.vaz.biz/',	0,	1,	NULL,	'2015-06-17 23:50:48',	'2015-06-17 23:50:48'),
(7,	'Emanuel Assunção',	'iassuncao@morais.org',	NULL,	'$2y$10$gJbTw9cG8pQClBmUoT4Zdu9k1SDX.xFDbQbsoiF/kJ3QzS8NiYh1K',	11,	'repurpose viral channels',	'iassuncao.jpg',	'http://magalhaes.com/soluta-voluptas-qui-id-esse-ut-nisi',	0,	2,	NULL,	'2015-06-17 23:50:49',	'2015-06-17 23:50:49'),
(8,	'Xavier Xavier Pinheiro Jesus',	'xavier90@amaral.com',	'jesus.xavier@martins.com',	'$2y$10$0fCUzmXc7mq73CJemOTZyeyK0tdYLeKoF3rhbuNi0eVUpcroDhfEK',	14,	'morph virtual metrics',	'xavier90.jpg',	'http://www.pinheiro.info/et-quo-nisi-reiciendis-doloremque-ratione-inventore-qui',	0,	4,	NULL,	'2015-06-17 23:50:50',	'2015-06-17 23:50:50'),
(9,	'Letícia Oliveira',	'leticia77@lopes.com',	NULL,	'$2y$10$oVwgExf.cVpri0xuy2V1KOg1U6FVEJhL1RwwwwtER2n/dcwPPNjYG',	16,	'revolutionize one-to-one networks',	'leticia77.jpg',	'http://www.ramos.com/inventore-eligendi-dolor-exercitationem-rerum-ratione',	0,	2,	NULL,	'2015-06-17 23:50:51',	'2015-06-17 23:50:51'),
(10,	'Hélder Flávio Batista de Vicente',	'zvicente@brito.net',	NULL,	'$2y$10$Y/8nL55Gud62aK39xorXje1l1m6/v3Dg3tcG1vJyoydb.p.gccCVG',	11,	'strategize world-class initiatives',	'zvicente.jpg',	'http://www.marques.com/culpa-neque-beatae-ut-et.html',	0,	4,	NULL,	'2015-06-17 23:50:52',	'2015-06-17 23:50:52'),
(11,	'Jéssica Constança Assunção Matias Oliveira',	'jessica.oliveira@carvalho.com',	'oliveira.jessica@vicente.com',	'$2y$10$ECw8dECNR5gBC1DIFiWKcOL8wcEh5pZQjWrwhSlnSYBOUr6KYmT5C',	14,	'extend distributed e-markets',	'jessica.oliveira.jpg',	'https://www.azevedo.net/repellendus-repudiandae-deserunt-error-omnis-molestiae-provident-hic',	0,	2,	NULL,	'2015-06-17 23:50:53',	'2015-06-17 23:50:53'),
(12,	'Filipe Monteiro Santos',	'filipe.santos@nascimento.info',	'filipe.santos@loureiro.com',	'$2y$10$L4fIGiBNkw85l9Wm3DE/G.ioyYD8Z2SKQK4YAtkcbA3yFRg1P5JHS',	13,	'aggregate customized synergies',	'filipe.santos.jpg',	'http://faria.biz/aspernatur-qui-et-est-sed-sed-odio-rerum',	0,	1,	NULL,	'2015-06-17 23:50:54',	'2015-06-17 23:50:54'),
(13,	'Lia Tavares',	'lia14@guerreiro.org',	NULL,	'$2y$10$S2k4Npms0wshPQ7kPMJVmOaMHrkVxCMCpPb0NVy6hN4Nxh/eK6pMi',	13,	'scale cutting-edge solutions',	'lia14.jpg',	'http://www.nunes.com/autem-ut-consectetur-itaque-repudiandae-quae-in-non.html',	0,	1,	NULL,	'2015-06-17 23:50:55',	'2015-06-17 23:50:55'),
(14,	'Flávio Campos de Santos',	'nsantos@reis.net',	'flavio09@machado.com',	'$2y$10$1Z4uxzzVKE/5O3ISeDBSTuRIDMUSZUMlmH1lYp4LVx7nRcP1..Nx2',	6,	'recontextualize intuitive partnerships',	'nsantos.jpg',	'http://www.machado.com/',	0,	4,	NULL,	'2015-06-17 23:50:56',	'2015-06-17 23:50:56'),
(15,	'César Andrade Batista',	'batista.cesar@pinheiro.com',	'batista.cesar@esteves.biz',	'$2y$10$LBxIJ.bSz9/o8/5NcIMwtuS9QioAeyZ/YtpcPQrhDwUGRbIa0yygy',	16,	'seize value-added action-items',	'batista.cesar.jpg',	'https://www.freitas.biz/veritatis-et-quia-ad-nam-itaque',	0,	4,	NULL,	'2015-06-17 23:50:56',	'2015-06-17 23:50:56'),
(16,	'Martim Magalhães',	'martim.magalhaes@moreira.com',	'dmagalhaes@guerreiro.net',	'$2y$10$aWinrpiOJsmcvsQBwr8HX.GUpfQYc7FDlPATUOEHHK42Nao4Ds8Zu',	13,	'iterate proactive models',	'martim.magalhaes.jpg',	'http://pinho.com/consequuntur-quis-voluptatibus-laboriosam-quae',	0,	1,	NULL,	'2015-06-17 23:50:57',	'2015-06-17 23:50:57'),
(17,	'Joel Lopes',	'joel.lopes@campos.com',	NULL,	'$2y$10$KmTsN.Ln3XdBK1f3QH..1eI3niq5w1Gg6XfTM0BhAkAtvcoP.xpSu',	12,	'grow dynamic portals',	'joel.lopes.jpg',	'http://www.pires.com/',	0,	4,	NULL,	'2015-06-17 23:50:58',	'2015-06-17 23:50:58'),
(18,	'Alexandra Violeta de Fonseca',	'alexandra67@lopes.com',	'mfonseca@mota.com',	'$2y$10$p7cCWCH5wvK.PjUgcCbLjuQh82jnngq5EWohR4jxeWZfS6lqLDoY6',	8,	'drive sticky interfaces',	'alexandra67.jpg',	'http://reis.biz/tenetur-earum-similique-et-ut-doloribus',	0,	2,	NULL,	'2015-06-17 23:50:59',	'2015-06-17 23:50:59'),
(19,	'Vasco Xavier Guerreiro',	'guerreiro.vasco@azevedo.biz',	NULL,	'$2y$10$x1c0Jsl6Til6PbXvEyYU..5myFVIzACUvcX.mvqmfVfSM/Ayfzno2',	11,	'exploit viral technologies',	'guerreiro.vasco.jpg',	'http://www.matias.com/architecto-sint-vel-quam-doloribus-autem',	0,	2,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00'),
(20,	'César Ivo Barbosa Leal Rocha',	'cesar60@neves.com',	NULL,	'$2y$10$mqBtbhw5NyedyvA5AHMNluANzCUTVEuFxnOpvyG.GFT7hR5ULMCiW',	7,	'revolutionize robust supply-chains',	'cesar60.jpg',	'http://sa.net/non-soluta-ut-iste-in-maiores-rerum',	0,	1,	NULL,	'2015-06-17 23:51:00',	'2015-06-17 23:51:00');

-- 2015-06-22 13:46:07
