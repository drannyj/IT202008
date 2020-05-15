CREATE TABLE IF NOT EXISTS `ACCOUNT NUMBERS` (
    `id` int auto_increment not null unique,
    `username` varchar(100) not null,
    `ACC#` int not null unique,
    `Checkings` boolean not null DEFAULT 0,
    `Savings` boolean not null DEFAULT 0,
    `Loan` boolean not null DEFAULT 0,
    PRIMARY KEY(`id`)
) CHARACTER SET utf8 COLLATE utf8_general_ci