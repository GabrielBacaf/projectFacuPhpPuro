<?php
$titulo = "Listar Livro";
ob_start(); // começa a capturar o HTML

?>

<section>
    
        <h1>Listar Livros</h1>

        <?php include_once __DIR__ . '/lit.php'; ?>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/layout.php'; // inclui o layout
?>