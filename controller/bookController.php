<?php
require_once './config/conexao.php';
require_once '../services/bookService.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' || $method === 'GET') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'store':
            storeBook($_POST);
            header('Location: ./views/list.php');
            exit;
            break;

        case 'update':
            updateBook($_POST);
            header('Location: ./views/list.php');
            exit;
            break;

        case 'delete':
            deleteBook($_POST['id']);
            header('Location: ./views/list.php');
            exit;
            break;

        case 'get':
            listBooks();
            header('Location: ./views/list.php');
            exit;
            break;

        default:
            echo "Ação inválida.";
    }
}
