<?php
require_once '../config/conexao.php';
require_once '../services/bookService.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' || $method === 'GET') {
    $action = $_POST['action'] ?? ($_POST['_method'] ?? '');


    switch ($action) {
        case 'store':
            session_start();
            if (storeBook($_POST)) {
                $_SESSION['success'] = 'Livro salvo com sucesso.';
            } else {
                $_SESSION['error'] = 'Erro ao salvar o livro.';
            }

            header('Location: ../pages/create.php');
            exit;
            break;

        case 'update':
            session_start();
            if (updateBook($_POST)) {
                $_SESSION['success'] = 'Livro Atualizado com sucesso.';
            } else {
                $_SESSION['error'] = 'Erro ao atualizar o livro.';
            }

            header('Location: ../pages/edit.php');
            exit;
            break;

        case 'delete':
            deleteBook($_POST['id']);
            header('Location: ../pages/create.php');
            exit;
            break;

        case 'get':
            session_start();
            $_SESSION['books'] = listBooks();
            header('Location: ../pages/index.php');
            exit;
            break;

        default:
            echo "Ação inválida.";
    }
}
