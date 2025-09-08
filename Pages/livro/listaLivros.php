<?php
require_once __DIR__ . '/../../services/bookService.php';

$searchTerm = $_GET['search'] ?? null;
$books = listBooks($searchTerm);

if (empty($books)) { ?>
    <p>Nenhum livro encontrado.</p>
<?php } else { ?>
    <section class="lista-livros">
        <?php foreach ($books as $book): ?>
            <article class="livro">
                <img src="<?= htmlspecialchars($book['imagem']) ?>" alt="<?= htmlspecialchars($book['titulo']) ?>">
                <h2><?= htmlspecialchars($book['titulo']) ?></h2>
                <p>Autor: <?= htmlspecialchars($book['autora_nome']) ?></p>
                <p>Editora: <?= htmlspecialchars($book['editora']) ?></p>
                <p>Ano: <?= htmlspecialchars($book['ano_publicacao']) ?></p>
                <p>Gênero: <?= htmlspecialchars($book['genero']) ?></p>
                <div class="acoes">
                    <form action="/projectFacuPhpPuro/controller/bookController.php" method="GET" style="display:inline;">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">
                        <button type="submit" style="background-color: green;">Editar</button>
                    </form>
                    <form action="/projectFacuPhpPuro/controller/bookController.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja deletar este livro?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">
                        <button type="submit" style="background-color: red;">Deletar</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php }
