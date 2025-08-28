<?php
require_once '../config/conexao.php';


// Exemplo de uso: inserir um livro
function storeBook(array $data): bool
{
    $conn = conectaBanco();

    $sql = "INSERT INTO books (titulo, autor, editora, ano_publicacao, genero) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        // Se não conseguiu preparar, retorna false
        return false;
    }

    // Faz o bind dos parâmetros (s = string, i = integer)
    mysqli_stmt_bind_param(
        $stmt,
        "sssis", // s = string, s = string, s = string, i = integer, s = string
        $data['titulo'],
        $data['autor'],
        $data['editora'],
        $data['ano_publicacao'],
        $data['genero']
    );

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result; // true se sucesso, false se erro
}

function listBooks(): array
{
    $conn = conectaBanco();

    $sql = "SELECT * FROM books";


    $result = mysqli_query($conn, $sql);

    $books = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $books;
}

function updateBook(array $data) {}

function deleteBook(int $id) {}

