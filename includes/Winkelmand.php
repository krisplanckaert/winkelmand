<?php
require_once 'includes/Bestelling.php';
require_once 'includes/Product.php';
require_once( 'Model.php');
ini_set('display_errors', 1);
error_reporting('E_ALL');

class Winkelmand extends Model{
    protected $_key = array('ID' , 'ProductID');
    protected $_name = 'winkelmanden';
    
    public function save($data) 
    {
        $winkelmand = $this->fetchOneByKey($data);
        if($winkelmand) {
            $data['Aantal'] = $winkelmand['Aantal'] + (int)$data['Aantal'];
            if($data['Aantal']>0) {
                parent::save($data);
            } else {
                $this->deleteByKey($data);
            }
        } else {
            if($data['Aantal']>0) {
                parent::save($data);
            }
        }
    }
    
    public function order($session_id) {
        $bestellingModel = new Bestelling();
        $productModel = new Product();
        $arrKey = array(
            'ID' => $session_id,
        );
        $winkelmanden = $this->fetchAll($arrKey);
        foreach($winkelmanden as $winkelmand) {
            $data_product = array('ID' => $winkelmand['ProductID']);
            $product = $productModel->fetchOneByKey($data_product);
            $data = array(
                'UserID' => $session_id,
                'Product' => $product['Naam'],
                'Prijs' => $product['Prijs'],
                'Aantal' => $winkelmand['Aantal'],
            );
//var_dump($data);exit;
            $bestellingModel->save($data);
            $arrKey = array(
                'ID' => $session_id,
                'ProductID' => $winkelmand['ProductID'],
            );
            $this->delete($arrKey);
        }
    }
}

?>
