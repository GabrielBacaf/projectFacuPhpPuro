<?php

function conectaBanco()
{
    $server     = "localhost";
    $user       = "root";
    $password   = "";
    $basedados  = "projetophp";  // nome do banco que você vai usar
    $porta      = 3380;          // sua porta customizada

    // 1. Conecta ao MySQL sem especificar banco
    $conn = mysqli_connect($server, $user, $password, "", $porta);

    if (!$conn) {
        die(" Falha na conexão: " . mysqli_connect_error());
    }

    // 2. Cria o banco de dados se não existir
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$basedados` 
                    CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

    if (!mysqli_query($conn, $sqlCreateDB)) {
        die(" Erro ao criar banco: " . mysqli_error($conn));
    }

    // 3. Seleciona o banco
    mysqli_select_db($conn, $basedados);

    // 4. Cria a tabela se não existir
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS books (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(100) NOT NULL,
        autor VARCHAR(100) NOT NULL,
        editora VARCHAR(100) DEFAULT NULL,
        ano_publicacao INT(4) NOT NULL,
        genero VARCHAR(50) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sqlCreateTable)) {
        die(" Erro ao criar tabela: " . mysqli_error($conn));
    }

    return $conn;
}
