<?php

require_once( 'Model.php');

class User extends Model
{
    protected $_key = array('ID');
    protected $_name = 'users';
    
    public function login ($login, $wachtwoord)
    {
        if (!empty($login) && !empty($wachtwoord)) {
            $arrKey = array(
                'login' => $login,
                'wachtwoord' => $wachtwoord,
            );
            $users = $this->fetchAll($arrKey);
            if ($users) {
                return true;              
            } else {
                return false;   
            }
        } else {
            return false;
        }
    }
    
    public function registreer ($data)            
    {      
        if (!empty($data)) {
            $this->save($data);
            return true;
        }
        else {
            return false;
        }
    }

}

?>
