<?php
require_once __DIR__ . '/../../services/autoraService.php';
$titulo = "Destalhes do Livro";
session_start();
$book = $_SESSION['book'] ?? [];
$nome = reuperarNomeAutoraId($book['autora_id']);

ob_start();

?>

<section>
    <div>
         <h1> Livro <?= htmlspecialchars($book['titulo'] ?? 'Livro') . ' de ' . ' - ' . $nome['nome'] ?> </h1>
    </div>
    <article >
        <img src="/projectFacuPhpPuro/<?= htmlspecialchars($book['imagem'] ?? 'static/img/default.jpg') ?>"
            width="450" height="400" alt="<?= htmlspecialchars($book['genero'] ?? '---') ?></p>">
            
    </article>
    <!-- <div class="row" style="margin-top: 20px;">
        <p><strong>Ano de Publicação:</strong> <?= htmlspecialchars($book['ano_publicacao'] ?? '---') ?></p>
        <p><strong>Editora:</strong> <?= htmlspecialchars($book['editora'] ?? '---') ?></p>

    </div> -->
    <div class="row">
        <?php if (!empty($book['resumo'])): ?>
            <div class="row" style="margin-top: 20px;">
                <h3>Resumo</h3>
                <p><?= nl2br(htmlspecialchars($book['resumo'])) ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$conteudo = ob_get_clean();
include_once __DIR__ . '/../fragments/layout.php';
?>