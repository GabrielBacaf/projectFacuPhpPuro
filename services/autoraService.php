<?php
require_once __DIR__ . '/../Config/conexao.php';

function listAutoras(): array
{
    $conn = conectaBanco();

    // $sql = "SELECT id, nome FROM autoras ORDER BY nome";
    $sql = "SELECT id, nome FROM autoras";

    $result = mysqli_query($conn, $sql);



    $autoras = [];

   if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $autoras[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);


    return $autoras;
}


// Usando prepared statements para buscar todas as informações da autora, não so nome
function recuperarAutoraId(int $id): ?array
{
    $conn = conectaBanco();
    
    $sql = "SELECT * FROM autoras WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $autor = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $autor ?: null;
}

//Crud autores
/**
 * Salva uma nova autora no banco de dados.
 */
function storeAutor(array $data, ?array $file): bool
{
    $conn = conectaBanco();
    $imagemPath = null;

    //upload de imagem
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../static/img/autores/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = uniqid() . '-' . basename($file['name']);
        $imagemPath = 'static/img/autores/' . $fileName;
        move_uploaded_file($file['tmp_name'], $uploadDir . $fileName);
    }

    $sql = "INSERT INTO autoras (nome, idade, nacionalidade, premios, descricao, imagem) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);

    // "sissss" -> s = string, i = inteiro
    mysqli_stmt_bind_param(
        $stmt,
        "sissss",
        $data['nome'],
        $data['idade'],
        $data['nacionalidade'],
        $data['premios'],
        $data['descricao'],
        $imagemPath
    );

    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $success;
}

/**
 * Atualiza os dados de uma autora no banco.
 */
function updateAutor(array $data, ?array $file): bool
{
    $conn = conectaBanco();
    $autorAtual = recuperarAutoraId((int)$data['id']);
    $imagemPath = $autorAtual['imagem']; // Mantém a imagem antiga por padrão

    // Se uma nova imagem foi enviada, processa o upload e remove a antiga
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        if ($imagemPath && file_exists(__DIR__ . '/../' . $imagemPath)) {
            unlink(__DIR__ . '/../' . $imagemPath);
        }
        $uploadDir = __DIR__ . '/../static/img/autores/';
        $fileName = uniqid() . '-' . basename($file['name']);
        $imagemPath = 'static/img/autores/' . $fileName;
        move_uploaded_file($file['tmp_name'], $uploadDir . $fileName);
    }
    
    $sql = "UPDATE autoras SET 
                nome = ?, idade = ?, nacionalidade = ?, 
                premios = ?, descricao = ?, imagem = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    
    // "sissssi" -> os 6 primeiros são os campos, o último 'i' é o id do WHERE
    mysqli_stmt_bind_param(
        $stmt,
        "sissssi",
        $data['nome'],
        $data['idade'],
        $data['nacionalidade'],
        $data['premios'],
        $data['descricao'],
        $imagemPath,
        $data['id']
    );

    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    return $success;
}

/**
 * Excluir uma autora do banco de dados.
 */
function deleteAutor(int $id): bool
{
    $conn = conectaBanco();
    
    // Antes de deletar, remove o arquivo da imagem do servidor
    $autor = recuperarAutoraId($id);
    if ($autor && !empty($autor['imagem']) && file_exists(__DIR__ . '/../' . $autor['imagem'])) {
        unlink(__DIR__ . '/../' . $autor['imagem']);
    }

    $sql = "DELETE FROM autoras WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $success;
}

// O controller usa a recuperarAutorId que retorna todos os dados.
function reuperarNomeAutoraId(int $id): ?array
{
    $conn = conectaBanco();
    $sql = "SELECT nome FROM autoras WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $autora = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $autora ?: null;

}
