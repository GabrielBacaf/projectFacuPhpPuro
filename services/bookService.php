<?php
require_once __DIR__ . '/../Config/conexao.php';

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


function storeBook(array $data, array $file): bool
{
    try {
        $conn = conectaBanco();

        $imagemPath = null;

        // Se veio arquivo de imagem (já validado no Request)
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $imagemNome = uniqid('book_') . '.' . $ext;
            $destino = __DIR__ . '/../static/img/' . $imagemNome;

            if (!move_uploaded_file($file['tmp_name'], $destino)) {
                throw new Exception("Falha ao mover o arquivo enviado.");
            }

            $imagemPath = 'static/img/' . $imagemNome; // caminho relativo para o banco
        }

        $sql = "INSERT INTO books (titulo, editora, ano_publicacao, genero, imagem, autora_id) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssissi", // s=string, i=int
            $data['titulo'],
            $data['editora'],
            $data['ano_publicacao'],
            $data['genero'],
            $imagemPath,
            $data['autor_id'] // vem do <select>
        );

        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            throw new Exception("Erro ao executar a query: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        return true;
    } catch (Exception $e) {
        throw $e; // repassa para o controller tratar
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
