<?php
session_start();

$titulo = "Listar Livro";
ob_start(); // Começa a capturar o conteúdo
?>

<div class="main-header">
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Buscar por título, autor, gênero...">
        <button type="submit">Buscar</button>
    </form>
    <form class="button" action="controller/bookController.php" method="GET">
        <input type="hidden" name="action" value="create">
        <button type="submit">Cadastrar</button>
    </form>
</div>

<?php
// Inclui a lista de livros, que agora ficará corretamente dentro do container
include_once __DIR__ . '/Pages/livro/listaLivros.php';
?>

<?php
$conteudo = ob_get_clean(); // Pega tudo que foi "desenhado"
include_once __DIR__ . '/Pages/fragments/layout.php'; // Coloca no molde principal
?>