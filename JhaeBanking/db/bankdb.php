<?php

//Error Handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");

$connectionString = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try{
  foreach(glob("sql/*.sql") as $file){
    $files[$file] = file_get_contents($file);
    }
  
  if(isset($files) && $files){
    ksort($files);
    $database = new PDO($connectionString, $dbuser, $dbpass);
    echo "<br> Connected to Database </br>";
  
  foreach($files as $key => $command){
    echo "<br>Running, " . $key . "</br>";
    
    $prep = $database->prepare($command);
    $xec = $prep->execute();
    
    $error = $prep->errorInfo();
    
    if($error && $error[0] !== '00000'){
        echo var_export($error,true);
			}
      echo "$key upload is a " . ($xec>0?"Success":"Fail");
      echo "<br> </br>";
    }  
  }
  else{
    echo "No files found.";
  }
  exit();
} 
catch(Exception $E){
  echo $E->getMessage();
  exit("Somethings wrong here");
}
?>
