CREATE TABLE IF NOT EXISTS `github_users` (
`id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `blog` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `github_id` varchar(50) DEFAULT NULL,
  `github_username` varchar(50) DEFAULT NULL,
  `profile_image` text,
  `github_url` text
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

