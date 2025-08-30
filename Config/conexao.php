<?php
require_once '../config/seed.php';

function conectaBanco()
{
    $server     = "localhost";
    $user       = "root";
    $password   = "";
    $basedados  = "projetophp";  
    $porta      = 3306;          

    try {
        // 1. Conecta ao MySQL sem especificar banco
        $conn = mysqli_connect($server, $user, $password, "", $porta);

        if (!$conn) {
            throw new Exception("Falha na conexão com o servidor MySQL.");
        }

        // 2. Cria o banco de dados se não existir
        $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$basedados` 
                        CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        if (!mysqli_query($conn, $sqlCreateDB)) {
            throw new Exception("Erro ao criar banco de dados.");
        }

        // 3. Seleciona o banco
        if (!mysqli_select_db($conn, $basedados)) {
            throw new Exception("Erro ao selecionar o banco de dados.");
        }

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
            throw new Exception("Erro ao criar a tabela 'books'.");
        }
        seedBooks($conn);
        return $conn;

    } catch (Exception $e) {
        // Redireciona para página de erro
        session_start();
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../pages/error.php");
        exit;
    }
}
