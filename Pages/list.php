<?php
session_start();
$books = $_SESSION['books'] ?? [];

if ($books) {
    echo '<table>';
    echo
    '<tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Editora</th>
        <th>Ano</th>
        <th>Gênero</th>
    </tr>';
    foreach ($books as $book) {
        echo "<tr>
            <td>" . ($book['titulo'] ?? '') . "</td>
            <td>" . ($book['autor'] ?? '') . "</td>
            <td>" . ($book['editora'] ?? '') . "</td>
            <td>" . ($book['ano_publicacao'] ?? '') . "</td>
            <td>" . ($book['genero'] ?? '') . "</td>
          </tr>";
    }
    echo '</table>';
} else {
    echo "<p>Nenhum livro encontrado.</p>";
}

unset($_SESSION['books']); // limpa a sessão
