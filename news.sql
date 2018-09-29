CREATE TABLE `news` (
    `id` int(11) NOT NULL auto_increment,
    `news_title` varchar(255) NOT NULL,
    `news_body` TEXT NOT NULL,
    `user_id` int(11) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
 
INSERT INTO `news` VALUES(1, 'Hello World', '你好世界', 1, '2018-09-27 15:30:00', NULL);
INSERT INTO `news` VALUES(2, '测试标题', '测试内容', 1, '2018-09-26 15:30:00', NULL);