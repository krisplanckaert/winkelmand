<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author webmaster
 */
class Connection {
    //put your code here
    
   const HOST   = 'localhost';
   const PORT   = '8889';
   const DBNAME = 'Winkelmand';
   const USER   = 'root';
   const PASS   = 'root';
   
   public function connect () {
       
       try {
           $conn=  new PDO('mysql:host='.self::HOST.'; port='.self::PORT.'; dbname='.self::DBNAME,self::USER,self::PASS);
           //$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ATTR_ERRMODE_EXCEPTION); //PRODUCTION=commentaar
           return $conn;           
        } catch(PDOException $e) {
            var_dump($e->getMessage());
            die;
        }
        
       
   }
   
   
}

?>
