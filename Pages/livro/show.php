<?php
$titulo = "Destalhes do Livro";
ob_start();
?>

<section>
    <div class="row">
       <img src="/static/img/harryPotter.jpg" alt="" width="750px" height="250px">
    </div >
    <div class="row">
        <span>Titulo</span>
    </div>
</section>

<?php
$conteudo = ob_get_clean(); // guarda o HTML capturado
include_once __DIR__ . '/../fragments/layout.php'; // inclui o layout, que vai usar $conteudo
?>