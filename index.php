<?php

session_start();


$titulo = "Listar Livro";
ob_start(); // começa a capturar o HTML
?>

<section>
    <h2>Listar livros</h2>
   <div id="criarLivro">
    <form action="controller/bookController.php" method="GET" style="display:inline">
        <input type="hidden" name="action" value="create">
        <button type="submit">Criar Livro</button>
    </form>
</div>
    <?php include_once __DIR__ . '/Pages/list.php'; ?>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/Pages/layout.php'; // inclui o layout
?>