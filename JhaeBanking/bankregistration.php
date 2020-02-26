<?php
//Error Handling
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm']))
{
$u = $_POST['username'];
$e = $_POST['email'];
$p = $_POST['password'];
$c = $_POST['confirm'];

  if($p != $c){
    echo "Your passwords don't match. Try again";
  }
  else{
    $p = $_POST['password'];
    $p = password_hash($p, PASSWORD_BCRYPT);
    require("config.php");
    $connectionString = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

    try{
      $d = new PDO($connectionString, $dbuser, $dbpass);
      
      $x = true;
      $check = $d->prepare("SELECT username FROM `BANKING INFORMATION` where username = :username");
      $par = array(":username"=>$u);
      $check->execute($par);
      
      if($check->rowCount() == 1){
          $x = false;
      }

      if($x){
        $insert = $d->prepare("INSERT INTO `BANKING INFORMATION` 
                            (username, password, email) 
                            VALUES (:username, :password, :email)");
        $info = array(":username"=>$u, ":password"=>$p,":email"=>$e);
        $insert->execute($info);
        //echo var_export($insert->errorInfo(), true);
        echo $u . ", You've been registered with Jhae Banking. Thank you!";
      }
      else{
        echo "Sorry, that username is already registered.";
      }
    }
    catch(Exception $E){
      echo $E->getMessage();
      exit();
    }
  }
}
?><html>
  <head>
  <br><pre>Welcome to Jhae Banking!</pre></br>
  <pre>When you're done filling in the form, please hit Submit!</pre>
  <script>
  </script>
  </head>
    <body>
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
      </form>
    </body>
</html>