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
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars($book['titulo'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['autor'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['editora'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['ano_publicacao'] ?? '') ?></td>
                <td><?= htmlspecialchars($book['genero'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum livro encontrado.</p>
<?php endif; ?>