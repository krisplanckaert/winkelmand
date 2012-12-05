<?php
ini_set('display_errors', 1);
//error_reporting['E_ALL'];
require_once 'includes/Winkelmand.php';
require_once 'includes/Connection.php';

$session_id = session_id();
if(empty($session_id)) {
    session_start();
    $session_id= session_id();
}  

$winkelmand = new Winkelmand();

if($_GET['type'] === 'add') {
    $data = array(
        'ID' => $session_id,
        'ProductID' => $_GET['id'],
        'Aantal' => $_GET['aantal'],
    );
    $winkelmand->save($data);
}

if($_GET['type'] === 'empty') {
    $winkelmand->delete(array('ID'=>$session_id));
}

if($_GET['type'] === 'order') {
    $winkelmand->order($session_id);
}

$array = array(
    'ID' => $session_id,
);
$winkelmanden = $winkelmand->fetchAll($array);
?>

<html>
    <head>
        <title>
            Basket
        </title>
    </head>
    <body>
        <?php
            $totaalAantal = 0;
            $totaalPrijs = 0;
            
            $basket = '<ul>';
            foreach( $winkelmanden as $winkelmand) {
                $totaalAantal += $winkelmand['Aantal'];
                $totaalPrijs += $winkelmand['Aantal'] * $winkelmand['Prijs'];
                
                $basket .= '<li>Product:' . $winkelmand['Naam'] . ' - aantal:' . 
                    $winkelmand['Aantal'] . ' - prijs' . $winkelmand['Prijs'] . '&euro;</li>';
            }
            $basket .= '</ul>';            
            
            echo '<hr />Totale prijs voor : ' . $totaalAantal . 'stuk(s) is '. $totaalPrijs . '&euro;';
            echo $basket;
        ?>
        <a href='product.php'>Terug</a> | 
        <a href='winkelmand.php?type=empty'>Winkelmand leeg maken</a> |
        <a href='winkelmand.php?type=order'>Winkelmand bestellen</a>
    </body>
    
</html>