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
}
