<?php

require_once __DIR__ . '/../services/bookService.php';
require_once __DIR__ . '/../Request/bookRequest.php';

$method = $_SERVER['REQUEST_METHOD'];

$action = ($method === 'POST')
    ? ($_POST['action'] ?? '')
    : ($_GET['action'] ?? '');

$validade = validBook($_POST);
$file = $_FILES['imagem'] ?? null;



switch ($action) {
    case 'create':
        header('Location: /projectFacuPhpPuro/pages/livro/create.php');
        exit;
        break;


    case 'store':
        session_start();
        if (!empty($validade)) {
            $_SESSION['validade'] = $validade;
            $_SESSION['book'] = $_POST;
            header('Location: /projectFacuPhpPuro/pages/livro/create.php');
            exit;
        }

        try {
            if (storeBook($_POST, $file)) {
                $_SESSION['success'] = 'Livro Criado com sucesso.';
                header('Location: /projectFacuPhpPuro/index.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /projectFacuPhpPuro/pages/livro/create.php');
            exit;
        }

        break;

    case 'edit':
        session_start();
        if (!empty($validade)) {
            $_SESSION['validade'] = $validade;
            $_SESSION['book'] = $_POST;
            header('Location: /projectFacuPhpPuro/pages/livro/create.php');
            exit;
        }
        try {
            $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
            if ($id) {

                $_SESSION['book'] = editBook($id);
                header('Location:  /projectFacuPhpPuro/pages/livro/edit.php');
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
                header('Location:  /projectFacuPhpPuro/index.php');
                exit;
                break;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location:  /projectFacuPhpPuro/pages/livro/edit.php');
        exit;
        break;

    case 'delete':
        session_start();
        try {
            if (deleteBook((int)$_POST['id'])) {
                $_SESSION['success'] = 'Livro Excluido com sucesso!';

                header('Location:  /projectFacuPhpPuro/index.php');
                exit;
                break;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao excluir o livro';
        }

        header('Location:  /projectFacuPhpPuro/index.php');
        exit;
        break;

    default:
        echo "Ação inválida.";
}
