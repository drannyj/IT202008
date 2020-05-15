CREATE TABLE IF NOT EXISTS `BANKING INFORMATION` (
    `id` int auto_increment not null,
    `username` varchar(100) not null unique,
    `email` varchar(100) not null unique,
    `password` varchar(21358) not null,
    `created` timestamp not null default current_timestamp,
    `modified` timestamp not null default current_timestamp on update current_timestamp,
    PRIMARY KEY(`id`)

) CHARACTER SET utf8 COLLATE utf8_general_ci
