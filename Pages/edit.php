<?php
session_start();
$titulo = "Editar Livro";
$book = $_SESSION['book'] ?? null;
ob_start(); 

?>

<section>
   <form action="../controller/bookController.php" method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= $book['id']?>">
        <h1>Editar Livro</h1>
        <?php include_once __DIR__ . '/_form.php'; ?>
        
        <button type="submit">Enviar</button>
    </form>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/layout.php'; // inclui o layout, que vai usar $conteudo
?>