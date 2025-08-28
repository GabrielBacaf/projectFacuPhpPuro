<?php

function conectaBanco()
{
    $server = "localhost";
    $user = "root";
    $password = "faeng123";
    $basedados = "projetophp";
    $porta = 3307;

    // Conecta ao MySQL sem especificar o banco
    $conn = mysqli_connect($server, $user, $password, "", $porta);

    if (!$conn) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    // Cria o banco se não existir
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $basedados";
    if (!mysqli_query($conn, $sqlCreateDB)) {
        die("Erro ao criar banco: " . mysqli_error($conn));
    }

    // Seleciona o banco
    mysqli_select_db($conn, $basedados);

    // Cria a tabela se não existir
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS books (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        author VARCHAR(100) NOT NULL,
        published_year INT(4) NOT NULL,
        genre VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($conn, $sqlCreateTable)) {
        die("Erro ao criar tabela: " . mysqli_error($conn));
    }

    echo"conectou no banco";

    return $conn ;
}