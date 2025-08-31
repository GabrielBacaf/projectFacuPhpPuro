<?php
$titulo = "Cadastrar Livro";
ob_start(); // captura todo o conteúdo da página

?>

<section>
    <form action="/projectFacuPhpPuro/controller/bookController.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="store">

        <h1>Cadastre a Autora(o)</h1>
        <?php include_once __DIR__ . '/_form.php'; ?>
        <button type="submit">Enviar</button>
    </form>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/../fragments/layout.php'; // inclui o layout, que vai usar $conteudo
?>