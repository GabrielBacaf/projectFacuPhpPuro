<?php

session_start();


$titulo = "Listar Livro";
ob_start(); // começa a capturar o HTML
?>

<section>
    <h1>Listar livros</h1>
    <div id="criarLivro">
        <form action="controller/bookController.php" method="GET" style="display:inline">
            <input type="hidden" name="action" value="create">
            <button type="submit">Criar Livro</button>
        </form>
    </div>
    <?php include_once __DIR__ . '/Pages/livro/listaLivros.php'; ?>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/Pages/fragments/layout.php'; // inclui o layout
?>