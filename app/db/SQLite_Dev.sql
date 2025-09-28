CREATE TABLE IF NOT EXISTS `Users`(
    `account_id` integer primary key autoincrement,
    `profile_image` text,
    `username` varchar(100) not null,
    `email` varchar(100) not null,
    `password` text not null,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime
);

CREATE TABLE IF NOT EXISTS `Posts`(
    `post_id` integer primary key autoincrement,
    `title` varchar(100) not null,
    `text` text,
    `upvotes` integer default 0,
    `downvotes` integer default 0,
    `author` integer not null,
    `posted_at` datetime DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_author_user`
        FOREIGN KEY (`author`)
        REFERENCES `Users` (`account_id`)
);