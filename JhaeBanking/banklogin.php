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
        $_SESSION['username'] = $u;
        //echo var_export($_SESSION, true);
        if(isset($_SESSION[$u]))
          $_SESSION['logged'] = true;
          echo $u . ", YOUR SESSION HAS STARTED.";
          header('Location: bankbuffpage.php');
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
      <title> Please login! </title> 
    </head>
    <style>
      .body{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
      }
      .back-form{
        text-align: center;
        vertical-align: middle;
        background-color: red;
        position: absolute;
        left: 700px;
        bottom: 0px;
        width: 500px;
        height: 1000px;
        border: 2px solid black;   
      }
      .form{
        background-color: #D0D0D0;
        border: 2px solid black;
        width: 250px;
        height: 150px;
        position: relative;
        left: 115px;
        top: 400px;
      }
    </style>
    <body class = "body">
        <form name="loginform" method="POST"> 
            <div class = "back-form">
              <div class = "form">
                <label for="user"><br> Username: </br></label>
                <input type="text" id="user" name="username" placeholder="Username"/>
                
                <label for="pass"><br> Password: <br></label>
                <input type="password" id="pass" name="password" placeholder="Password"/>
                
                <br><button type="submit" value ="Submit">Done</button></br>
              </div>
            </div>
        </form> 
    </body>
</html>

