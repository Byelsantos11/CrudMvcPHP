<?php

namespace App\Database;
use PDO;
use PDOException;

/*Conexão com Banco de dados*/
class Connect
{
    private $pdo;

    public function __construct($host, $usuario, $senha, $db)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
