<?php

namespace App\Controller;

use App\Crud;
use Exception;


/*Crud com todas CREATE, UPDATE, DELETE, SELECTION*/
class DeputadoController
{
    private $crud;


    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
    }

    //Método para cadastrar

    public function cadastramento()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST["nome"] ?? null;
            $email = $_POST["email"] ?? null;
            $senha = $_POST["senha"] ?? null;

            try {
                if ($nome && $email && $senha) {
                    $message = $this->crud->cadastrar($nome, $email, $senha);
                    echo $message;
                } else {
                    echo "Nome, e-mail e senha são obrigatórios!";
                }
            } catch (Exception $e) {
                echo "Erro ao cadastrar deputado: " . $e->getMessage();
            }
        } else {
            echo "Método de requisição inválido!";
        }
    }

    // Método para excluir 
    public function excluir($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($id) {
                try {
                    $message = $this->crud->excluir($id);
                    echo $message;
                } catch (Exception $e) {
                    echo "Erro ao excluir deputado: " . $e->getMessage();
                }
            } else {
                echo "ID do deputado é obrigatório!";
            }
        } else {
            echo "Método de requisição inválido!";
        }
    }

    //Método para atualizar

    public function atualizar($id, $nome, $email, $senha)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($id && $nome && $email && $senha) {
                try {
                    $message = $this->crud->atualizar($id, $nome, $email, $senha);
                    echo $message;
                } catch (Exception $e) {
                    echo "Erro ao atualizar deputado: " . $e->getMessage();
                }
            } else {
                echo "ID, nome, e-mail e senha são obrigatórios!";
            }
        } else {
            echo "Método de requisição inválido!";
        }
    }


    //Método de selecionar
    public function selecionar($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            if ($id) {
                try {
                    $deputado = $this->crud->selecionar($id);
                    if ($deputado) {
                        echo json_encode($deputado);
                    } else {
                        echo "Deputado não encontrado!";
                    }
                } catch (Exception $e) {
                    echo "Erro ao selecionar deputado: " . $e->getMessage();
                }
            } else {
                echo "ID do deputado é obrigatório!";
            }
        } else {
            echo "Método de requisição inválido!";
        }
    }

    //Método de verificar no Banco

    public function verificar($nome, email, senha){
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            if($nome && $email, && $senha){
                $verifique= $this->crud->verificar($nome, $email, $senha);
                echo json_encode($verifique)
            }
        }
    }

}
?>
