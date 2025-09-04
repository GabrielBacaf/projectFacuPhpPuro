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

        if ($file && $file['error'] === UPLOAD_ERR_OK) {

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));


            // gera nome único com extensão
            $imagemNome = uniqid('book_') . '.' . $ext;
            $destino = __DIR__ . '/../static/img/' . $imagemNome;

            if (!move_uploaded_file($file['tmp_name'], $destino)) {
                throw new Exception("Falha ao mover o arquivo enviado.");
            }

            $imagemPath = 'static/img/' . $imagemNome;
        }

        $sql = "INSERT INTO books (titulo, editora, ano_publicacao, genero, imagem, autora_id) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            throw new Exception("Erro ao preparar a query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssissi",
            $data['titulo'],        // s
            $data['editora'],       // s
            $data['ano_publicacao'], // i
            $data['genero'],        // s
            $imagemPath,            // s
            $data['autor_id']       // i
        );
        
        

        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            throw new Exception("Erro ao executar a query: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        return true;
    } catch (Exception $e) {
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

function updateBook(array $data, array $file ): bool
{
    try {
        $conn = conectaBanco();

        if (empty($data['id'])) {
            throw new Exception("ID do livro não fornecido.");
        }

        $id = (int) $data['id'];
        $titulo = $data['titulo'] ?? '';
        $autor = $data['autor_id'] ?? ''; 
        $editora = $data['editora'] ?? '';
        $ano_publicacao = (int) ($data['ano_publicacao'] ?? 0);
        $genero = $data['genero'] ?? '';

        
        $sqlSelect = "SELECT imagem FROM books WHERE id = ?";
        $stmtSelect = mysqli_prepare($conn, $sqlSelect);
        mysqli_stmt_bind_param($stmtSelect, "i", $id);
        mysqli_stmt_execute($stmtSelect);
        mysqli_stmt_bind_result($stmtSelect, $imagemAtual);
        mysqli_stmt_fetch($stmtSelect);
        mysqli_stmt_close($stmtSelect);

        $imagemPath = $imagemAtual;

        // se enviar nova imagem, substitui
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($ext, $extensoesPermitidas)) {
                throw new Exception("Formato de imagem inválido. Use jpg, jpeg, png ou gif.");
            }

            // gera nome único
            $imagemNome = uniqid('book_') . '.' . $ext;
            $destino = __DIR__ . '/../static/img/' . $imagemNome;

            if (!move_uploaded_file($file['tmp_name'], $destino)) {
                throw new Exception("Falha ao mover o arquivo enviado.");
            }

            // apaga a imagem antiga se existir
            if ($imagemAtual && file_exists(__DIR__ . '/../' . $imagemAtual)) {
                unlink(__DIR__ . '/../' . $imagemAtual);
            }

            $imagemPath = 'static/img/' . $imagemNome;
        }

        // atualiza os dados
        $sql = "UPDATE books 
                SET titulo = ?, editora = ?, ano_publicacao = ?, genero = ?, imagem = ?, autora_id = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "ssissii",
            $titulo,        // s
            $editora,       // s
            $ano_publicacao, // i
            $genero,        // s
            $imagemPath,    // s
            $autor,         // i
            $id             // i
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
        // Primeiro, pega o caminho da imagem do livro
        $sqlSelect = "SELECT imagem FROM books WHERE id = ?";
        $stmtSelect = mysqli_prepare($conn, $sqlSelect);
        if (!$stmtSelect) {
            throw new Exception("Erro ao preparar query de seleção: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmtSelect, "i", $id);
        mysqli_stmt_execute($stmtSelect);
        mysqli_stmt_bind_result($stmtSelect, $imagemPath);
        mysqli_stmt_fetch($stmtSelect);
        mysqli_stmt_close($stmtSelect);

        // Se existe imagem, tenta apagar do servidor
        if ($imagemPath && file_exists(__DIR__ . '/../' . $imagemPath)) {
            unlink(__DIR__ . '/../' . $imagemPath);
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
