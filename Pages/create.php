<?php
$titulo = "Cadastrar Livro";
ob_start(); // captura todo o conteúdo da página

?>

<section>
    <form action="../controller/bookController.php" method="POST">
        <input type="hidden" name="action" value="store">

        <h1>Cadastrar Livro</h1>
        <?php include_once __DIR__ . '/_form.php'; ?>

        <button type="submit">Enviar</button>
    </form>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/layout.php'; // inclui o layout, que vai usar $conteudo
?>