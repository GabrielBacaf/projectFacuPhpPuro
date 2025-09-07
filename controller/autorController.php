<?php

require_once __DIR__ . '/../services/autoraService.php';
require_once __DIR__ . '/../Request/autoraRequest.php';

// Determina o método da requisição (GET ou POST)
$method = $_SERVER['REQUEST_METHOD'];

// Pega a 'action' dos dados da requisição
$action = ($method === 'POST')
    ? ($_POST['action'] ?? '')
    : ($_GET['action'] ?? '');

// Roteador de ações
switch ($action) {
    // --- AÇÃO PARA MOSTRAR O FORMULÁRIO DE CRIAÇÃO ---
    case 'create':
        header('Location: /projectFacuPhpPuro/pages/autor/create.php');
        exit;
        break;

    // --- AÇÃO PARA SALVAR UM NOVO AUTOR NO BANCO ---
    case 'store':
        session_start();
        $file = $_FILES['imagem'] ?? null;
        
        // Valida os dados recebidos do formulário
        $validade = validAutora($_POST, $file);
        
        // Se tiver erros de validação
        if (!empty($validade)) {
            $_SESSION['validade'] = $validade;
            $_SESSION['autor_data'] = $_POST; // Guarda os dados para preencher o form novamente
            header('Location: /projectFacuPhpPuro/pages/autor/create.php');
            exit;
        }

        try {
            // Tenta salvar o autor no banco de dados
            if (storeAutor($_POST, $file)) {
                $_SESSION['success'] = 'Autor(a) cadastrado(a) com sucesso.';
                header('Location: /projectFacuPhpPuro/index.php'); // Ou para uma lista de autores
                exit;
            }
        } catch (Exception $e) {
            // Em caso de erro, guarda a mensagem e redireciona de volta
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['autor_data'] = $_POST;
            header('Location: /projectFacuPhpPuro/pages/autor/create.php');
            exit;
        }
        break;

    // --- AÇÃO PARA BUSCAR DADOS E MOSTRAR O FORMULÁRIO DE EDIÇÃO ---
    case 'edit':
        session_start();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if (!$id) {
            $_SESSION['error'] = 'ID do autor inválido.';
            header('Location: /projectFacuPhpPuro/index.php');
            exit;
        }

        try {
            // Recupera os dados do autor pelo ID
            $autor = recuperarAutorId($id);
            if ($autor) {
                $_SESSION['autor_data'] = $autor;
                header('Location: /projectFacuPhpPuro/pages/autor/edit.php');
                exit;
            } else {
                $_SESSION['error'] = 'Autor não encontrado.';
                header('Location: /projectFacuPhpPuro/index.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /projectFacuPhpPuro/index.php');
            exit;
        }
        break;

    // --- AÇÃO PARA ATUALIZAR UM AUTOR NO BANCO ---
       case 'update':
        session_start();
        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        // **CORREÇÃO AQUI TAMBÉM**
        // 1. Pega os dados do arquivo de imagem
        $file = $_FILES['imagem'] ?? null;
    
        $validade = validAutora($_POST, $file);

        if (!empty($validade)) {
            $_SESSION['validade'] = $validade;
            $_SESSION['autor_data'] = $_POST;
            header('Location: /projectFacuPhpPuro/pages/autor/edit.php?id=' . $id);
            exit;
        }

        try {
            if (updateAutor($_POST, $file)) {
                $_SESSION['success'] = 'Autor(a) atualizado(a) com sucesso!';
                header('Location: /projectFacuPhpPuro/index.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $_SESSION['autor_data'] = $_POST;
            header('Location: /projectFacuPhpPuro/pages/autor/edit.php?id=' . $id);
            exit;
        }
        break;

    // AÇÃO PARA EXCLUIR UM AUTOR DO BANCO ---
    case 'delete':
        session_start();
        $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

        try {
            if (deleteAutor($id)) {
                $_SESSION['success'] = 'Autor(a) excluído(a) com sucesso!';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao excluir o autor(a). ' . $e->getMessage();
        }
        
        header('Location: /projectFacuPhpPuro/index.php');
        exit;
        break;

    // --- AÇÃO PARA MOSTRAR OS DETALHES DE UM AUTOR ---
    case 'show':
        session_start();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if (!$id) {
            $_SESSION['error'] = 'ID do autor inválido.';
            header('Location: /projectFacuPhpPuro/index.php');
            exit;
        }
        
        try {
            $autor = recuperarAutorId($id);
            if ($autor) {
                $_SESSION['autor_data'] = $autor;
                header('Location: /projectFacuPhpPuro/pages/autor/show.php');
                exit;
            } else {
                $_SESSION['error'] = 'Autor não encontrado.';
                header('Location: /projectFacuPhpPuro/index.php');
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /projectFacuPhpPuro/index.php');
            exit;
        }
        break;

    // --- AÇÃO PADRÃO CASO NENHUMA VÁLIDA SEJA FORNECIDA ---
    default:
        // Pode redirecionar para o início ou mostrar uma mensagem de erro
        header('HTTP/1.0 404 Not Found');
        echo "Ação inválida.";
        exit;
}