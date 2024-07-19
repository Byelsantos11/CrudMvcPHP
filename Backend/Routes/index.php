<?php

// Configuração de ambiente
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload do Composer
require 'vendor/autoload.php';

// Configuração do roteamento
use Bramus\Router\Router;

// Instancia o roteador
$router = new Router();

// Inclui o arquivo de configuração de rotas
require 'deputadosRoutes.php';

// Executa o roteador
$router->run();

