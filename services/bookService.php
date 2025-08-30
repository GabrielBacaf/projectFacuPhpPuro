<?php
require_once '../config/conexao.php';

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
function editBook(int $id): array
{
    $conn = conectaBanco();

    $sql = "SELECT * FROM books WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $sql);

    $book = [];

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    return $book;
}


function updateBook(array $data): bool
{
    try {
        $conn = conectaBanco();

        if (empty($data['id'])) {
            throw new Exception("ID do livro não fornecido.");
        }

        $id = (int) $data['id'];
        $titulo = $data['titulo'] ?? '';
        $autor = $data['autor'] ?? '';
        $editora = $data['editora'] ?? '';
        $ano_publicacao = (int) ($data['ano_publicacao'] ?? 0);
        $genero = $data['genero'] ?? '';

        $sql = "UPDATE books 
                SET titulo = ?, autor = ?, editora = ?, ano_publicacao = ?, genero = ? 
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "sssisi", // tipos: string, string, string, int, string, int
            $titulo,
            $autor,
            $editora,
            $ano_publicacao,
            $genero,
            $id
        );

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if (!$result) {
            throw new Exception("Erro ao atualizar o livro: " . mysqli_stmt_error($stmt));
        }

        return true;
    } catch (Exception $e) {

        throw $e;
    }
}

function deleteBook(int $id): bool
{
    try {
        $conn = conectaBanco();

       
        if ($id <= 0) {
            throw new Exception("ID inválido para exclusão.");
        }

       
        $sql = "DELETE FROM books WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "i", $id);

        $result = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if (!$result) {
            throw new Exception("Erro ao deletar o livro: " . mysqli_stmt_error($stmt));
        }

        return true;
    } catch (Exception $e) {
        
        throw $e;
    }
}
