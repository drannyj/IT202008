<?php
#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

session_start();
require('accountinfo.php');

if($c){
    echo '<div class = "back-form"><div class = "form"><button type = "button" onClick = "checkings()">Checkings</button></div></div>';
}

function checkings(){
    $_SESSION['type'] = 'Checkings';
}

?>

<html>
    <head>
      <style>
      .title{
      top: 200px;
      right: 5px;
      text-align: center;
      position: relative;
      color: white;
    }
    .title2{
      top: 400px;
      right: 5px;
      text-align: center;
      position: relative;
      color: white;
    }
    .title3{
      top: 410px;
      right: 0px;
      text-align: center;
      position: relative;
      color: grey;
    }
      .whole{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
    }
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
        position: relative;
        left: 0px;
        top: 300px;
      }

    </style>
    </head>
    <body class = "whole">
      <div class = body>
        <div class = title>Current Accounts</div>
        <div class = title2>Create Account</div>
        <div class = title3>currently not available...</div>
      </div>
    </body>
    <script>
      function checkings(){
        var echo = "<?php checkings()?>";
        window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/bankdashboard.php";
      }

    </script>
</html>