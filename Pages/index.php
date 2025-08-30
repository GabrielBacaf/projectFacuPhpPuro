<?php

session_start();


$titulo = "Listar Livro";
ob_start(); // começa a capturar o HTML
?>

<section>
    <h2 >Listar livros</h2>
    <?php include_once __DIR__ . '/list.php'; ?>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/layout.php'; // inclui o layout
?>
