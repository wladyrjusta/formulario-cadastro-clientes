CREATE DATABASE IF NOT EXISTS clientes;

USE clientes;

CREATE TABLE IF NOT EXISTS cliente (
  id_cliente INT NOT NULL AUTO_INCREMENT,
  nome_cliente VARCHAR(255),
  cpf_cliente VARCHAR(11),
  email_cliente VARCHAR(255),
  data_nascimento_cliente TIMESTAMP,
  PRIMARY KEY (id_cliente)
);

