<?php
include_once '../services/bookService.php';
$books = listBooks();
?>
<?php if ($books): ?>
    <table>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Ano</th>
            <th>Gênero</th>
            <th> Ação</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['titulo'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['autor'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['editora'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['ano_publicacao'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['genero'] ?? '') ?></td>
                <td>
                    <form action="../controller/bookController.php" method="GET" style="display:inline;">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?= $book['id'] ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form action="../controller/bookController.php" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $book['id'] ?>">
                        <button type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum livro encontrado.</p>
<?php endif; ?>