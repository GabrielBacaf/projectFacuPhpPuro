<?php

session_start();


$titulo = "Listar Livro";
ob_start(); // começa a capturar o HTML
?>

<section>
    <div class="row">
        <?php include_once __DIR__ . 
'/Pages/fragments/session.php'; ?> 
    </div>
    <div class="main-header">
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Buscar por título, autor, gênero...">
            <button type="submit">Buscar</button>
        </form>
        <form class="button" action="controller/bookController.php" method="GET">
            <input type="hidden" name="action" value="create">
            <button type="submit">Cadastrar </button>
        </form>
    </div>

    <div>
        <?php include_once __DIR__ . 
'/Pages/livro/listaLivros.php'; ?>
    </div>
    
    
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . 
'/Pages/fragments/layout.php'; // inclui o layout
?>
