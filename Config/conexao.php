<?php
require_once __DIR__ . '/seed.php';

function conectaBanco()
{
    $server     = "localhost";
    $user       = "root";
    $password   = "";
    $basedados  = "projetophp";
    $porta      = 3307;

    try {

        $conn = mysqli_connect($server, $user, $password, "", $porta);

        if (!$conn) {
            throw new Exception("Falha na conexão com o servidor MySQL.");
        }


        $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$basedados` 
                        CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        if (!mysqli_query($conn, $sqlCreateDB)) {
            throw new Exception("Erro ao criar banco de dados.");
        }


        if (!mysqli_select_db($conn, $basedados)) {
            throw new Exception("Erro ao selecionar o banco de dados.");
        }

        $sqlCreateAutoras = "CREATE TABLE IF NOT EXISTS autoras (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL UNIQUE,
            idade INT UNSIGNED DEFAULT NULL,
            nacionalidade VARCHAR(50) DEFAULT NULL,
            descricao TEXT DEFAULT NULL,
            premios TEXT DEFAULT NULL,
            imagem VARCHAR(255) DEFAULT NULL,
            resumo TEXT DEFAULT NULL, 
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
             )";

        if (!mysqli_query($conn, $sqlCreateAutoras)) {
            throw new Exception("Erro ao criar a tabela 'autoras'.");
        }

        $sqlCreateBooks = "CREATE TABLE IF NOT EXISTS books (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(100) NOT NULL,
            editora VARCHAR(100) DEFAULT NULL,
            ano_publicacao INT(4) NOT NULL,
            genero VARCHAR(50) DEFAULT NULL,
            imagem VARCHAR(255) DEFAULT NULL,
            resumo TEXT DEFAULT NULL, 
            autora_id INT UNSIGNED NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (autora_id) REFERENCES autoras(id) 
                ON DELETE CASCADE
             ON UPDATE CASCADE
            )";

        if (!mysqli_query($conn, $sqlCreateBooks)) {
            throw new Exception("Erro ao criar a tabela 'books'.");
        }
        seedBooks($conn);
        return $conn;
    } catch (Exception $e) {

        session_start();
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../pages/error.php");
        exit;
    }
}
