<?php
$session_id = session_id();
if(empty($session_id)) {
    session_start();
    $session_id= session_id();
}  
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'includes/User.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){   
    
    $_POST['ID']=$session_id;  
    $user = new User;
    if ($user->registreer($_POST)) {
        echo "Registratie gelukt. Klik ". "<a href='index.php'>". "hier". " om terug te keren naar de login-pagina"."</a>";
        exit();
    }
    else {
        echo "Registratie mislukt";
    }
}
?>

<html>
    
    <head>
       <title>Winkelmand Db</title> 
    </head>
    
    <body>
        <h1>Registreer</h1>
        <form method="post" action="#">
            voornaam:<input type="text" name="Voornaam" value="">
            <br/>
            email: <input type="text" name="Email" value="">
            <br/>
            login: <input type="text" name="Login" value="">
            <br/>
            wachtwoord:<input type="password" name="Wachtwoord" value="">
            <br/>
            <input type="submit" value="Registreer">
        </form>
    </body>
</html>