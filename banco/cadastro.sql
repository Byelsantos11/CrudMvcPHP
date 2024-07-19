CREATE DATABASE IF NOT EXISTS cadastro;
USE cadastro;

-- Criação da tabela `usuarios`
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nome VARCHAR(255) NOT NULL,       
    email VARCHAR(255) NOT NULL UNIQUE, 
    senha VARCHAR(255) NOT NULL        
);

-- Tabela ligada com gatilho
CREATE TABLE IF NOT EXISTS usuarios_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    alterado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    alterado_por VARCHAR(255),
    acao VARCHAR(50),
    dados_anteriores TEXT,
    dados_novos TEXT
);

-- Adiciona um índice para melhorar a pesquisa pelo email
CREATE UNIQUE INDEX IF NOT EXISTS idx_email ON usuarios(email);

DELIMITER //

CREATE TRIGGER before_usuario_update
BEFORE UPDATE ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO usuarios_log (usuario_id, alterado_por, acao, dados_anteriores, dados_novos)
    VALUES (
        OLD.id,
        'system',  
        'update',
        CONCAT('nome: ', OLD.nome, ', email: ', OLD.email, ', senha: ', OLD.senha),
        CONCAT('nome: ', NEW.nome, ', email: ', NEW.email, ', senha: ', NEW.senha)
    );
END //

DELIMITER ;
