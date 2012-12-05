<?php

require_once( 'Connection.php');

ini_set('display_errors', 1);
error_reporting('E_ALL');

class Model {
    private $_db;
    
    public function __Construct() 
    {
        $this->_db = new Connection();
        $this->_db = $this->_db->Connect();
    }    
    
    public function save($data) 
    {
        $row = $this->fetchOneByKey($data);
        //var_dump($row);exit;
        if(!$row) {
            $sql = 'insert into ' . $this->_name.' (';
            $separator = '';
            foreach($data as $k => $v) {
                $sql .= $separator . $k;
                $separator = ', ';
            }
            $sql.= ') values (';
            $separator = '';
            foreach($data as $k => $v) {
                if(is_numeric($v)) {
                    $sql .= $separator.$v;
                } else {
                    $sql .= $separator.'"'.$v.'"';
                }
                $separator = ', ';
            }
            $sql.= ')';
            //var_dump($sql);exit;
            $st = $this->_db->prepare($sql);
            $st->execute();
        } else {
            $sql = "update ".$this->_name." set ";
            $separator = '';
            foreach($data as $k => $v) {
                if(!in_array($k, $this->_key)) {
                    if(is_numeric($v)) {
                        $sql.= $separator.$k.'='.$v;
                    } else {
                        $sql.= $separator.$k.'="'.$v.'"';
                    }
                    $separator = ', '; 
                }
            }
            $sql.=' where ';
            foreach($this->_key as $v) {
                if(is_numeric($data[$v])) {
                    $sql.= $v.'='.$data[$v].' and ';
                } else {
                    $sql.= $v.'="'.$data[$v].'" and ';
                }                
            }
            $sql.= ' 1=1';
            //var_dump($sql);exit;
            $st = $this->_db->prepare($sql);
            $st->execute();            
        }
    }
    
    public function fetchAll($arrKey = null) 
    {
        $where = $this->convertKey($arrKey);
        $sql = 'select * from '.$this->_name.' '.$where;
        $st = $this->_db->prepare($sql);
        $st->execute();
        $return = array();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        while($row) {
            $return[] = $row;
            $row = $st->fetch(PDO::FETCH_ASSOC);
        }
        return $return;
    }

    public function fetchOneByKey($data) 
    {
        $where = $this->createWhereByKey($data);
        $sql = 'select * from '.$this->_name.' '.$where;
        $st = $this->_db->prepare($sql);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }  
    
    public function delete($arrKey = NULL) 
    {
        $where = $this->convertKey($arrKey);
        $sql = 'delete from '.$this->_name.' ' . $where;
        $st = $this->_db->prepare($sql);
        $st->execute();

        return true;
    }      
    
    public function deleteByKey($data) 
    {
        $where = $this->createWhereByKey($data);
        $sql = 'delete from '.$this->_name.' ' . $where;
        $st = $this->_db->prepare($sql);
        $st->execute();

        return true;
    }    

    private function createWhereByKey($data) {
        $arrKey = array();
        foreach($this->_key as $v) {
            $arrKey[$v] = $data[$v]; 
        }
        $where = $this->convertKey($arrKey);
        //var_dump($where);exit;
        return $where;
    }
    
    private function convertKey($arrKey = NULL) 
    {
        $where=' where 1=1';
        foreach($arrKey as $k=>$v) {
            if(is_numeric($v)) {
                $where.= ' and ' . $k . ' = ' . $v;
            } else {
                $where.= ' and ' . $k . " = '" . $v . "'" ;
            }
        }
        return $where;
    }
}

?>
