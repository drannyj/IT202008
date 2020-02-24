CREATE TABLE IF NOT EXISTS `BANKING INFORMATION` (

`id` int auto_increment not null,
`username` varchar(60) unique not null,
`password` varchar(30) not null,
PRIMARY KEY('id')

) CHARACTER_SET utf8 COLLATE utf8_general_ci
