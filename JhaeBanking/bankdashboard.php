<?php
#ini_set('display_errors',1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
session_start();

if(isset($_SESSION['logged']) && isset($_SESSION['username'])){
    require('db/dbconnect.php');
    require('accountinfo.php');
    require('transactions/balance.php');

    echo '<div class = "title"> Hello, ' . $_SESSION['username'] . "!" . ' Your acccount number is: ' . $_SESSION['account'];
    echo '. Your account type is: ' . $_SESSION['type'];
    echo '. Your balance is: '. $balance . "</div>";

    if(isset($_POST['depositNum'])){
        $_SESSION['dep'] = $_POST['depositNum'];
        header('Location: transactions/deposit.php');
    }

    if(isset($_POST['withdrawNum'])){
        $_SESSION['with'] = $_POST['withdrawNum'];
        header('Location: transactions/withdraw.php');
    }

    if(isset($_POST['transferNum']) && isset($_POST['transferAcc'])){
        $_SESSION['transferNum'] = $_POST['transferNum'];
        $_SESSION['transferAcc'] = $_POST['transferAcc'];
        header('Location: transactions/transfer.php');
    }
}else{
    header('Location: restricted.php');
}
?>

<html>
    <head>
        <title> Logged in </title>
        <style>
        .whole{
      background-image: url(bankreg-background.jpg);
      background-size: 2000px 1000px;
    }

    .title{
      text-align: center;
      position: absolute;
      left: 575px;
      top: 125px;
      background-color: red;
      color: white;
      width: 800px;
      height: 50px;
      border: 2px solid black;
    }
    .body{
      text-align: center;
      position: absolute;
      left: 615px;
      top: 200px;
      background-color: #D0D0D0;
      border: 2px solid black;
      width: 700px;
      height: 550px;
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
    </head>
        <body class = "whole">
            <div class = "body">            
                <br><button type = 'button' onclick = 'displayCreate()'>Create/Change Account</button></br>
                <div id='change' style = "display:none">
                </div>

                <br><button type = 'button' onclick = 'displayDeposit()'>Deposit</button></br>
                <div id='deposit' style = "display:none">
                    <form name = 'dep' method = 'POST'>
                    <input type = 'number' id = 'depositNum' name = 'depositNum' placeholder = '$'>
                    <br><button type = 'submit'>Done<button></br>
                    </form> 
                </div>
                
                <br><button type = 'button' onclick = 'displayWithdraw()'>Withdraw</button></br>
                <div id='withdraw' style = "display:none">
                    <form name = 'with' method = 'POST'>
                    <input type = 'number' id = 'withdrawNum' name = 'withdrawNum' placeholder = '$'>
                    <br><button type = 'submit' for = 'withdrawNum'>Done<button></br>
                    </form>
                </div>
                
                <br><button type = 'button' onclick = 'displayTransfer()'>Transfer</button></br>
                <div id='transfer' style = "display:none">
                    <form name = 'tran' method = 'POST'>
                    <input type = 'text' id = "transferAcc" name = 'transferAcc' placeholder = 'Send to'/>
                    <input type = 'number' id = 'transferNum' name = 'transferNum' placeholder = '$'/>
                    <br><button type = 'submit'>Done<button></br>
                    </form>
                </div>
                <br><button type = 'button' onclick = 'lastTransactions()'>Transactions</br></button>
                <br> </br>
                <br><button type ='button' onclick = 'Password()'>Change Password</button></br>
                <br><button type ='button' onclick = 'Logout()'>Logout</button></br>
                <br><button type ='button' onclick = 'deleteAcc()'>Delete Account?</button></br>
        </div>
        <form action = 'rolecheck.php'>
            <br><button type ='submit'>Are you an admin?</button></br>
        </form>
        </body>
    <script>
        function lastTransactions(){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/lasttransactions.php";
        }
        function Logout(){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/banklogout.php";
        }
        function Password(){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/changepassword.php";
        }
        function displayCreate(){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/accountchoice.php";
        }
        function deleteAcc(){
            if(confirm('Are you sure?')){
            window.location.href = "https://web.njit.edu/~drj27/IT202008/JhaeBanking/deleteaccount.php";
            }
        }
        function displayDeposit(){
            document.getElementById('deposit').style.display = "block";
        }
        function displayWithdraw(){
            document.getElementById('withdraw').style.display = "block";
        }
        function displayTransfer(){
            document.getElementById('transfer').style.display = "block";
        }
    </script>

</html>