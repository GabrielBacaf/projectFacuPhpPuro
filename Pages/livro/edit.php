<?php
session_start();
$titulo = "Editar Livro";
session_start();
$errors = $_SESSION['validade'] ?? [];
$book = $_SESSION['book'] ?? [];
unset($_SESSION['validade']);
unset($_SESSION['book']);
ob_start();

?>

<section>
    <form action="/projectFacuPhpPuro/controller/bookController.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">
        <h1>Editar Livro</h1>
        <?php include_once __DIR__ . '/_form.php'; ?>

        <button type="submit">Enviar</button>
    </form>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/../fragments/layout.php'; // inclui o layout, que vai usar $conteudo
?>