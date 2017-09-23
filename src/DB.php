<?php
/**
* User: Anderson Ismael
* Date: 20/set/2017
* IDE: Eclipse Oxygen 4.7.0
*/

namespace Basic;

use Medoo\Medoo;

class DB{
    function __construct($db){
        $this->db = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => $db['name'],
            'server' => $db['server'],
            'username' => $db['user'],
            'password' => $db['password'],
            // [optional]
            'charset' => 'utf8',
            'port' => 3306
        ]);
    }
    function create($table,$data){
        $data['created_at']=time();
        $this->db->insert($table,$data);
        $id=$this->db->id();
        if($id){
            return $id;
        }else{
            return false;
        }
    }
    function read($table,$where){
        return $this->db->get($table,'*',$where);
    }
    function update($table, $data, $where){
        $created_at = $this->db->get($table,'created_at',$where);
        $data['updated_at']=time();
        return $this->db->update($table, $data, $where);
        $data=[
            'created_at'=>$created_at
        ];
        return $this->db->update($table,$data,$where);
    }
    function delete($table, $where){
        return $this->db->delete($table, $where);
    }
    //extra
    function countResults($table,$where){
        return $this->db->count($table,$where);
    }
    function select($table,$where=null){
        return $this->db->select($table,'*',$where);
    }
    function query($sql){
        return $this->db->query($sql)->fetchAll();
    }
}
