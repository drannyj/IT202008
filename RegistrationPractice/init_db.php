<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
echo "DBUser: " . $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
$db = new PDO($connection_string, $dbuser, $dbpass);
echo "Connected.";
$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS `Users` (
		`id` int AUTO_INCREMENT NOT NULL,
		`email` varchar(100) NOT NULL  UNIQUE,
		`password`  varchar(60) NOT NULL,
		`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		`modified date`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci"
	);
$stmt->execute();
echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
}
catch(Exception $e){
	echo $e->getMessage();
	exit("It didn't work");
}
		
?>
