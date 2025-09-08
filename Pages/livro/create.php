<?php
$titulo = "Cadastro do Livro";
session_start();
unset($_SESSION['book']);
$errors = $_SESSION['validade'] ?? [];
$book = $_SESSION['book'] ?? [];
unset($_SESSION['validade']);
unset($_SESSION['book']);

ob_start();

?>



    <section class="formCadastro">
        <form action="/projectFacuPhpPuro/controller/bookController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="store">

            <h1>Cadastrar Livro</h1>
            <?php include_once __DIR__ . '/_form.php'; ?>
            <div class="button-azul">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </section>



<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/../fragments/layout.php'; // inclui o layout, que vai usar $conteudo
?>