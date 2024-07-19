<?php

namespace App\Database;

use Exception;

class Crud
{
    private $conexao;

    // Construtor da classe
    public function __construct(Connection $conexao)
    {
        $this->conexao = $conexao->getPdo(); 
    }

    // Método para cadastrar um deputado
    public function cadastrar($nome, $email, $senha)
    {
        try {
            $sql = "INSERT INTO deputados (nome, email, senha) VALUES (?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$nome, $email, $senha]);
            return "Deputado cadastrado com sucesso!";
        } catch (Exception $e) {
            return "Erro ao cadastrar deputado: " . $e->getMessage();
        }
    }

    // Método para excluir um deputado
    public function excluir($id)
    {
        try {
            $sql = "DELETE FROM deputados WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$id]);
            return "Deputado excluído com sucesso!";
        } catch (Exception $e) {
            return "Erro ao excluir deputado: " . $e->getMessage();
        }
    }

    // Método para atualizar dados de um deputado
    public function atualizar($id, $nome, $email, $senha)
    {
        try {
            $sql = "UPDATE deputados SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$nome, $email, $senha, $id]);
            return "Deputado atualizado com sucesso!";
        } catch (Exception $e) {
            return "Erro ao atualizar deputado: " . $e->getMessage();
        }
    }

    // Método para selecionar um deputado por ID
    public function selecionar($id)
    {
        try {
            $sql = "SELECT * FROM deputados WHERE id = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$id]);
            $deputado = $stm->fetch(\PDO::FETCH_ASSOC);

            if ($deputado) {
                return $deputado;
            } else {
                return "Deputado não encontrado!";
            }
        } catch (Exception $e) {
            return "Erro ao selecionar deputado: " . $e->getMessage();
        }
    }

    // Método para verificar se existe um deputado com o nome e senha fornecidos
    public function verificar($nome, $email, $senha)
    {
        try {
           
            $sql = "SELECT * FROM deputados WHERE nome = ? AND email = ? AND senha = ?";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([$nome, $email, $senha]);

            // Retorna verdadeiro se a consulta encontra
        }
    }


}

?>
