CREATE TABLE IF NOT EXISTS `TRANSACTIONS` (
    `id` int auto_increment not null unique,
    `SendingAcc` int(20) not null,
    `ReceivingAcc` int(20) not null,
    `Change` int(50) not null,
    `Type` varchar(100) not null,
    `Total` int(50) not null,
    PRIMARY KEY(`id`)

) CHARACTER SET utf8 COLLATE utf8_general_ci