<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'includes/User.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $user = new User;
    if($user->login($_POST['login'], $_POST['wachtwoord'])) {
        header("Location: product.php");
    }
}
?>

<html>
    
    <head>
       <title>Winkelmand Db</title> 
    </head>
    
    <body>
        <h1>Inloggen</h1>
        <a href="registreer.php">Registreer</a>
        <form method="post" action="#">
            <input type="text" name="login">
            <input type="password" name="wachtwoord">
            <input type="submit" value="Inloggen">
        </form>
        <a href="product.php">product</a>        
    </body>
</html>