<?php
require_once '../config/conexao.php';
require_once '../services/bookService.php';

$method = $_SERVER['REQUEST_METHOD'];

$action = ($method === 'POST')
    ? ($_POST['action'] ?? '')
    : ($_GET['action'] ?? '');

switch ($action) {
    case 'store':
        session_start();
        try {

            if (storeBook($_POST)) {
                $_SESSION['success'] = 'Livro salvo com sucesso.';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ../pages/create.php');
        exit;
        break;

    case 'edit':
        try {
            $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
            if ($id) {
                session_start();
                $_SESSION['book'] = editBook($id);
                header('Location: ../pages/edit.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        break;

    case 'update':
        session_start();
        try {
            if (updateBook($_POST)) {
                $_SESSION['success'] = 'Livro Atualizado com sucesso!';
                header('Location: ../pages/index.php');
                exit;
                break;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ../pages/edit.php');
        exit;
        break;

    case 'delete':
        session_start();
        try {
            if (deleteBook((int)$_POST['id'])) {
                $_SESSION['success'] = 'Livro Excluido com sucesso!';
                header('Location: ../pages/index.php');
                exit;
                break;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao excluir o livro';
        }

        header('Location: ../pages/index.php');
        exit;
        break;

    default:
        echo "Ação inválida.";
}
