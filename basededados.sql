-- Conecte-se ao servidor MySQL
mysql -h localhost -u root

-- Crie o banco de dados "LojadeTenis"
CREATE DATABASE IF NOT EXISTS LojadeTenis;

-- Use o banco de dados criado
USE LojadeTenis;

-- Crie a tabela "clientes"
CREATE TABLE IF NOT EXISTS clientes (
  nome VARCHAR(20) PRIMARY KEY,
  email VARCHAR(30),
  senha VARCHAR(100),
  lvl INT
);

INSERT INTO clientes VALUES("adm", "adm@gmail.com",123,2);

-- Crie a tabela "tenis"
CREATE TABLE IF NOT EXISTS tenis (
  nome_tenis VARCHAR(20) PRIMARY KEY,
  marca VARCHAR(20),
  preco int,
  img VARCHAR(30)
);

INSERT INTO tenis VALUES("AirForce 1", "Nike",105,"airforce1.png");
INSERT INTO tenis VALUES("Panda Dunk", "Nike",120,"panda.png");
INSERT INTO tenis VALUES("Air Max TN Plus", "Nike",180,"tn.png");
INSERT INTO tenis VALUES("Air Jordan 4", "Jordan",200,"jordan4.webp");
INSERT INTO tenis VALUES("Air Jordan Mid 1", "Jordan",150,"mid.jpg");
INSERT INTO tenis VALUES("Air Jordan 1", "Jordan",170,"jordan1.webp");
INSERT INTO tenis VALUES("SuperStar", "Addidas",80,"super.avif");
INSERT INTO tenis VALUES("Ultrabounce", "Addidas",90,"ultra.avif");
INSERT INTO tenis VALUES("Campus", "Addidas",100,"campus.avif");

-- Crie a tabela carrinho
CREATE TABLE IF NOT EXISTS carrinho (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(20),
    nome_tenis VARCHAR(20),
    tamanho INT,
    preco INT,
    FOREIGN KEY (nome_cliente) REFERENCES clientes(nome),
    FOREIGN KEY (nome_tenis) REFERENCES tenis(nome_tenis)
);

CREATE TABLE IF NOT EXISTS encomenda (
  codigo_encomenda INT PRIMARY KEY AUTO_INCREMENT,
  nome_cliente VARCHAR(20),
  nome_tenis VARCHAR(20),
  tamanho INT,
  preco_total DECIMAL(10,2), -- Corrigido para ser do tipo DECIMAL para valores monetários
  metodo_pagamento VARCHAR(20),
  FOREIGN KEY (nome_cliente) REFERENCES clientes(nome),
  FOREIGN KEY (nome_tenis) REFERENCES tenis(nome_tenis)
) AUTO_INCREMENT=1325;
