<?php
ini_set('display_errors', 1);
error_reporting('E_ALL');
require_once 'includes/Product.php';
require_once 'includes/Winkelmand.php';
$product = new Product();
$producten = $product->fetchAll();
session_start();

?>

<html>
    <head>
        <title>
            Basket
        </title>
    </head>
    <body>
        <?php 
            foreach($producten as $key => $value) { ?>
                <div class="item">
                    <img src="http://placehold.it/150x100&text=<?= $value['Naam'];?>" />
                </div> 
                <p><a href="winkelmand.php?type=add&id=<?= $value['ID'];?>&aantal=1"><?= $value['Naam'];?>+1</a></p>
                <p><a href="winkelmand.php?type=add&id=<?= $value['ID'];?>&aantal=-1"><?= $value['Naam'];?>-1</a></p>
                <hr>
<?php       } ?>

    </body>
    
</html>