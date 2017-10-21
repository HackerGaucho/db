<?php
/**
* Basic
* Micro framework em PHP
*/
namespace Basic;

use Medoo\Medoo;

/**
* Classe DB
*/
class DB
{
    /**
    * Dados SQL
    * @var array
    */
    private $db;
    /**
    * Seta a variável $db
    * @param array $db Dados SQL
    */
    public function __construct(array $db)
    {
        $this->db = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => $db['db_name'],
            'server' => $db['db_server'],
            'username' => $db['db_user'],
            'password' => $db['db_password'],
            // [optional]
            'charset' => 'utf8',
            'port' => 3306
        ]);
    }
    /**
    * Criar linha no banco de dados
    * @param  string $table Nome da tabela
    * @param  array  $data  Dados da linha
    * @return mixed         Retorna o ID da linha ou false
    */
    public function create(string $table, array $data)
    {
        $data['created_at']=time();
        $this->db->insert($table, $data);
        $id=$this->db->id();
        if ($id) {
            return $id;
        } else {
            return false;
        }
    }
    /**
    * Retorna uma linha do banco de dados
    * @param  string $table Nome da tabela
    * @param  array  $where Dados WHERE
    * @return mixed         Retorna os dados da linha ou false
    */
    public function read(string $table, array $where)
    {
        return $this->db->get($table, '*', $where);
    }
    /**
    * Atualiza uma linha do banco de dados
    * @param  string $table Nome da tabela
    * @param  array  $data  Dados a serem atualizados
    * @param  array  $where Dados WHERE
    * @return bool          Retorna true ou false
    */
    public function update(string $table, array $data, array $where):bool
    {
        $created_at = $this->db->get($table, 'created_at', $where);
        $data['updated_at']=time();
        return $this->db->update($table, $data, $where);
        $data=[
            'created_at'=>$created_at
        ];
        return $this->db->update($table, $data, $where);
    }
    /**
    * Apaga uma linha do banco de dados
    * @param  string $table Nome da tabela
    * @param  array  $where Dados WHERE
    * @return bool          Retorna true ou false
    */
    public function delete(string $table, array $where):bool
    {
        return $this->db->delete($table, $where);
    }
    /**
    * Retorna o número de linhas
    * @param  string $table Nome da tabela
    * @param  array  $where Dados WHERE
    * @return integer       Número de linhas
    */
    public function countResults(string $table, array $where):integer
    {
        return $this->db->count($table, $where);
    }
    /**
    * Seleciona uma ou mais linhas
    * @param  string $table Nome da tabela
    * @param  array  $where Dados WHERE
    * @return mixed         Retorna true ou false
    */
    public function select(string $table, array $where)
    {
        return $this->db->select($table, '*', $where);
    }
    /**
    * Consulta SQL RAW
    * @param  string $sql Código SQL RAW
    * @return mixed       Resposta RAW
    */
    public function query(string $sql)
    {
        return $this->db->query($sql)->fetchAll();
    }
}
