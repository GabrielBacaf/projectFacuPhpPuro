<?php
include_once __DIR__ . '/../../services/bookService.php';
$books = listBooks();
?>
<section class="lista-livros">
    <?php if ($books): ?>
        <?php foreach ($books as $key => $book): ?>
            <a href="/projectFacuPhpPuro/controller/bookController.php?action=show&id=<?= $book['id'] ?>"
                style="text-decoration: none; color: inherit;">
                <article class="livro">
                    <img src="<?= htmlspecialchars($book['imagem'] ?? 'static/img/default.jpg') ?>"
                        alt="<?= htmlspecialchars($book['titulo'] ?? 'Livro') ?>">

                    <h2><?= htmlspecialchars($book['titulo'] ?? 'Sem título') ?></h2>
                    <div class="acoes">
                        <form action="/projectFacuPhpPuro/controller/bookController.php" method="GET" style="display:inline;">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= $book['id'] ?>">
                            <button type="submit" style="background-color: green;">Editar</button>
                        </form>
                        <form action="/projectFacuPhpPuro/controller/bookController.php" method="POST" style="display:inline;"
                            onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $book['id'] ?>">
                            <button type="submit" style="background-color: red;">Deletar</button>
                        </form>
                    </div>
                </article>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum livro encontrado.</p>
    <?php endif; ?>
</section>