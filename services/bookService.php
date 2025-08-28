<?php
require_once '../config/conexao.php'; 

$conn = conectaBanco();

// Exemplo de uso: inserir um livro
function storeBook($title, $author, $year, $genre) {
    global $conn;

    $sql = "INSERT INTO books (title, author, published_year, genre) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssis", $title, $author, $year, $genre);

    if (mysqli_stmt_execute($stmt)) {
        echo "Livro inserido com sucesso!";
    } else {
        echo "Erro ao inserir livro: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}




function listBooks() {
    // Conexão com o banco de dados
  
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    $books = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }

    $conn->close();
    return $books;
}

function storeBook(array $data) {
    // Conexão com o banco de dados
    $conn = new mysqli('localhost
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     storeBook($_POST);
//     header('Location: ../views/listar.php');
//     exit;
// }