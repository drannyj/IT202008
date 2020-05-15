<?php
//Error Handling
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])){
  $u = $_POST['username'];
  $e = $_POST['email'];
  $p = $_POST['password'];
  $c = $_POST['confirm']; 
  $t = $_POST['type'];
  $m = $_POST['min'];

  if($u == ''){
    echo "<div class = 'notif'>Please enter a username.</div>";
  }

  if($p == ''){
    echo "<div class = 'notif'>Please enter a password.</div>";
  }
  else{
    if($p != $c){
      echo "<div class = 'notif'>Your passwords don't match. Try again</div>";
    }
    else{
      if($m < 5){
        echo "<div class = 'notif'>You do not meet the minimum required deposit.</div>";
      }else{
      $p = password_hash($p, PASSWORD_BCRYPT);

      try{
        require('db/dbconnect.php');
        
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
          echo "<div class = 'notif'>Sorry, that username is taken.</div>";
        }
        if(!$y){
          echo "<div class = 'notif'>Sorry, that email is already registered.</div>";
        }
        if($x and $y){
          $insert = $d->prepare("INSERT INTO `BANKING INFORMATION` 
                              (username, password, email) 
                              VALUES (:username, :password, :email)");
          $info = array(":username"=>$u, ":password"=>$p,":email"=>$e);
          $insert->execute($info);
          //echo var_export($insert->errorInfo(), true);
          echo "<div class = 'notif'>" . $u . ", You've been registered with Jhae Banking. Thank you! </div>";

          $insert = $d->prepare("SELECT id from `BANKING INFORMATION` WHERE username = '$u'");
          $insert->execute();
          $r = $insert->fetch();
          
          $_SESSION['logged'] = true;
          $_SESSION['username'] = $u;
          $_SESSION['type'] = $t;
          require('accounthandling.php');
          require('accountinfo.php');
          $_SESSION['account'] = $acc;
          
          $_SESSION['dep'] = $m;

          header("Location: initialdepost.php");
          
        }
      }
      catch(Exception $E){
        echo $E->getMessage();
        exit();
        }
      }
    }
    }
}
?>

<html>
  
  <title>Welcome to Jhae Banking!</titLe>
  
  <head>
    <script>
    </script>
  </head>
  
  <style>
    .whole{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
    }

    .title{
      text-align: center;
      position: absolute;
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

    .notif{
      text-align: center;
      position: relative;
      background-color: #FFFFFF;
      border: 2px solid black;
      width: 500px;
      margin: 1px;
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

              <label for="type"><br>Account?<br></label>
              <select name = "type" id="type"><br>
                  <option value = "Checkings">Checkings</option>
              </br></select>
              <br><input type = 'number' id = 'min' name = "min" placeholder = "Minimum $5 Deposit"></br>
              <br><button type="submit">Done</button></br>
          
          </form>
    </div>
    <form action = 'banklogin.php'>
        <br><button type="submit">Have an account already?</button></br>
    </form>
    </body>

</html>