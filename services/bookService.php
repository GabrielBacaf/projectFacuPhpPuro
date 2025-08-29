<?php
require_once '../config/conexao.php';


// Exemplo de uso: inserir um livro
function storeBook(array $data): bool
{
    try {
        $conn = conectaBanco(); 

        $sql = "INSERT INTO books (titulo, autor, editora, ano_publicacao, genero) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a query.");
        }

        mysqli_stmt_bind_param(
            $stmt,
            "sssis",
            $data['titulo'],
            $data['autor'],
            $data['editora'],
            $data['ano_publicacao'],
            $data['genero']
        );

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if (!$result) {
            throw new Exception("Erro ao executar a query.");
        }

        return true;
    } catch (Exception $e) {
        // Repassa para o Controller
        throw $e;
    }
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
