<?php
session_start();
session_unset();
session_destroy();
echo "You have been logged out. Thanks for visiting! :)";
//echo var_export($_SESSION, true);
if (ini_get("session.use.cookies")){
    $cook = session_get_cookie_params();
    setcookie(session_name(), '' , time() - 42000,
    $cook["path"], $cook["domain"], 
    $cook["secure"], $cook["httponly"]
    );
}
header( "refresh:2;url=https://web.njit.edu/~drj27/IT202008/JhaeBanking/banklogin.php" );
exit();
?>