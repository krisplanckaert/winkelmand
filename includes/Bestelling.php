<?php

require_once( 'Model.php');
ini_set('display_errors', 1);
error_reporting('E_ALL');

class Bestelling extends Model{
    protected $_key = array('ID');
    protected $_name = 'bestellingen';
    
}

?>
