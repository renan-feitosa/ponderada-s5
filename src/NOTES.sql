-- Criação do banco de dados
CREATE DATABASE NOTES;

-- Seleciona o banco de dados criado
USE NOTES;

-- Criação da tabela NOTES
CREATE TABLE NOTES (
    ID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    PRIORITY INT,
    NOTE VARCHAR(255),
    AUTHOR VARCHAR(45),
    CREATION_DATE DATE
);
