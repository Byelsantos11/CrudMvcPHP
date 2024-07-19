<?php

use Bramus\Router\Router;
use App\Database\Connect;
use App\Database\Crud;
use App\Controller\DeputadoController;

// Configuração da conexão com o banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = 'Gabrye140404.';
$db = 'cadastro';

// Cria uma instância da conexão
$connection = new Connect($host, $usuario, $senha, $db);

// Cria uma instância do Crud
$crud = new Crud($connection);

// Instância do DeputadoController Criada!
$deputadoController = new DeputadoController($crud);

// Cria uma instância do Router
$router = new Router();

// Rota Funcionando!
$router->post('/deputado/cadastrar', function() use ($deputadoController) {
    $deputadoController->cadastramento();
});

// Rota Funcionando!
$router->post('/deputado/excluir/(\d+)', function($id) use ($deputadoController) {
    $deputadoController->excluir($id);
});

// Rota Funcionando!
$router->post('/deputado/atualizar/(\d+)', function($id) use ($deputadoController) {
    $nome = $_POST["nome"] ?? null;
    $email = $_POST["email"] ?? null;
    $senha = $_POST["senha"] ?? null;
    $deputadoController->atualizar($id, $nome, $email, $senha);
});

// Rota Funcionando!
$router->get('/deputado/selecionar/(\d+)', function($id) use ($deputadoController) {
    $deputadoController->selecionar($id);
});

$router->get('deputado/verificar'), function () use ($deputadoController){
    $deputadoController->verificar()
}

// Executa o roteador
$router->run();

