<?php

namespace App;

use PDO;
use PDOException;


class Conn{

    protected $host = '127.0.0.1';
    protected $user = 'root';
    protected $pass = '';
    protected $dbname = 'phpoo';
    protected $pdo = false;

    public function connect(){
        try{
            # conectando com a database usando o PDO
            $this->pdo = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->pass);
            
            # definir a utilização de erros do tipo Exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            # Definindo padrão de codificação

            $this->pdo->exec("SET NAMES utf8");
        }
        catch(PDOException $e){
            echo "Erro: ". $e->getMessage();
        }
        return $this->pdo;
    }
}


