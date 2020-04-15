<?php
//Error Handling
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])){
  $u = $_POST['username'];
  $e = $_POST['email'];
  $p = $_POST['password'];
  $c = $_POST['confirm']; 

  if($u == ''){
    echo "<pre>Please enter a username.</pre>";
  }

  if($p == ''){
    echo "<pre>Please enter a password.</pre>";
  }
  else{
    if($p != $c){
      echo "Your passwords don't match. Try again";
    }
    else{
      $p = password_hash($p, PASSWORD_BCRYPT);
      require("config.php");
      $connectionString = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

      try{
        $d = new PDO($connectionString, $dbuser, $dbpass);
        
        $x = true;
        $check = $d->prepare("SELECT count(*) FROM `BANKING INFORMATION` where username = '$u'");
        $check->execute();
        $r1 = $check->fetch();

        $y = true;
        $check2 = $d->prepare("SELECT count(*) from `BANKING INFORMATION` where email = '$e'");
        $check2->execute();
        $r2 = $check2->fetch();

        if($r1[0][0] >= 1){
          $x = false;
        }
        
        if($r2[0][0] >= 1){
          $y = false;
        }
        
        if(!$x){
          echo "Sorry, that username is taken.";
        }
        if(!$y){
          echo "Sorry, that email is already registered.";
        }
        if($x and $y){
          $insert = $d->prepare("INSERT INTO `BANKING INFORMATION` 
                              (username, password, email) 
                              VALUES (:username, :password, :email)");
          $info = array(":username"=>$u, ":password"=>$p,":email"=>$e);
          $insert->execute($info);
          //echo var_export($insert->errorInfo(), true);
          echo $u . ", You've been registered with Jhae Banking. Thank you!";
        }
      }
      catch(Exception $E){
        echo $E->getMessage();
        exit();
        }
      }
    }
}
?>

<html>
  
  <title>Welcome to Jhae Banking!</titLe>
  
  <head>
  
  </head>
  
  <style>
    .whole{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
    }

    .title{
      text-align: center;
      position: relative;
      left: 700px;
      top: 150px;
      background-color: red;
      color: white;
      width: 500px;
      border: 2px solid black;
    }
    .body{
      text-align: center;
      position: absolute;
      left: 800px;
      top: 300px;
      background-color: #D0D0D0;
      border: 2px solid black;
      width: 300px;
      margin: 10px;

    }
  </style>
    
    <body class = "whole">
      <div class="title">
      <br><pre> Welcoming to Jhae Banking!
      When you're done filling in the form, please hit Submit! </pre></br>
      
      </div>
      <div class = "body">
      <form name="reg" action="bankregistration.php" method="POST">

      <label for="user"><br> Username: </br></label>
      <input type="text" id="user" name="username" placeholder="Username"/>
       
      <label for="email"><br> Email: </br></label>
      <input type="email" id="email" name="email" placeholder="Email"/>

      <label for="pass"><br> Password: <br></label>
      <input type="password" id="pass" name="password" placeholder="Password"/>
        
      <label for="conf"><br>Confirm Password:<br></label>
      <input type="password" id="conf" name="confirm" placeholder="Confirm Password"/>

      <br><button type="submit">Done</button></br>
      </div>
      </form>
    </body>

</html>