<?php
//Error Handling
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
$u = $_POST['username'];
$p = $_POST['password'];

require("config.php");
$connectionString = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

  try{
    $d = new PDO($connectionString, $dbuser, $dbpass);
    $sesh = $d->prepare("SELECT id, username, password from 
            `BANKING INFORMATION` where username = :username LIMIT 1");
    $info = array(":username" => $u);
    $sesh->execute($info);
    $fetch = $sesh->fetch(PDO::FETCH_ASSOC);
        
    //echo var_export($sesh->errorInfo(),true);

    if($fetch){
      $password = $fetch['password'];
      if(password_verify($p, $password)){
        $acc = $fetch['id'];
        echo "Welcome " . $u . "! BANK ACCOUNT NUMBER: " . $acc;
        $_SESSION[$u] = $u;
        //echo var_export($_SESSION, true);
        if(isset($_SESSION[$u]))
        echo ", YOUR SESSION HAS STARTED.";
        }
      else{
        echo "Sorry, that's the wrong password. Please try again.";
        }
      }
    else{
      echo "Sorry, you've entered the wrong username :(.";
      }
    }
  catch(Exception $E){
    echo $E->getMessage();
    exit();
    }
}
?>




<html>
    <head>
    <pre>Please login to Jhae Banking!</pre>   
    </head>
    <body>
        <form name="loginform" action="banklogin.php" method="POST">
            
            <label for="user"><br> Username: </br></label>
            <input type="text" id="user" name="username" placeholder="Username"/>
            
            <label for="pass"><br> Password: <br></label>
            <input type="password" id="pass" name="password" placeholder="Password"/>
            
            <br><button type="submit">Done</button></br>
        </form> 
    </body>
</html>

