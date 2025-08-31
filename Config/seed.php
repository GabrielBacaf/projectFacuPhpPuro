<?php
include_once __DIR__ . '/conexao.php';

function seedBooks($conn)
{



    $sqlCheckAutores = "SELECT COUNT(*) as total FROM autoras";
    $result = mysqli_query($conn, $sqlCheckAutores);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 0) {
        $sqlInsertAutores = "
    INSERT INTO autoras (nome, idade, nacionalidade, descricao, premios, imagem)
    VALUES
    ('Machado de Assis', 69, 'Brasileira', 'Um dos maiores nomes da literatura brasileira, fundador da Academia Brasileira de Letras.', NULL, 'static/img/harryPotter'),
    ('Aluísio Azevedo', 52, 'Brasileira', 'Romancista naturalista, autor de O Cortiço.', NULL, 'static/img/harryPotter'),
    ('Clarice Lispector', 56, 'Brasileira', 'Uma das escritoras mais importantes do século XX no Brasil.', NULL, 'static/img/harryPotter'),
    ('Jorge Amado', 88, 'Brasileira', 'Um dos escritores mais populares do Brasil, autor de Capitães da Areia.', NULL, 'static/img/harryPotter'),
    ('Guimarães Rosa', 59, 'Brasileira', 'Autor de Grande Sertão: Veredas, mestre da literatura modernista.', NULL, 'static/img/harryPotter'),
    ('José de Alencar', 70, 'Brasileira', 'Romancista indianista, autor de Iracema e Senhora.', NULL, 'static/img/harryPotter')
";
        if (!mysqli_query($conn, $sqlInsertAutores)) {
            throw new Exception("Erro ao inserir autoras iniciais: " . mysqli_error($conn));
        }
    }

    // 2. Recupera os IDs das autoras
    $autoras = [];
    $res = mysqli_query($conn, "SELECT id, nome FROM autoras");
    while ($a = mysqli_fetch_assoc($res)) {
        $autoras[$a['nome']] = $a['id'];
    }


    $sqlCheckBooks = "SELECT COUNT(*) as total FROM books";
    $result = mysqli_query($conn, $sqlCheckBooks);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 0) {
        $sqlInsertBooks = "
            INSERT INTO books (titulo, autora_id, editora, ano_publicacao, genero, imagem)
            VALUES
            ('Dom Casmurro', {$autoras['Machado de Assis']}, 'Editora Garnier', 1899, 'Romance', 'static/img/harryPotter'),
            ('O Cortiço', {$autoras['Aluísio Azevedo']}, 'Livraria Garnier', 1890, 'Romance', 'static/img/harryPotter'),
            ('A Hora da Estrela', {$autoras['Clarice Lispector']}, 'Rocco', 1977, 'Ficção', 'static/img/harryPotter'),
            ('Memórias Póstumas de Brás Cubas', {$autoras['Machado de Assis']}, 'Garnier', 1881, 'Romance', 'static/img/harryPotter'),
            ('Capitães da Areia', {$autoras['Jorge Amado']}, 'Companhia das Letras', 1937, 'Romance', 'static/img/harryPotter'),
            ('Grande Sertão: Veredas', {$autoras['Guimarães Rosa']}, 'Nova Fronteira', 1956, 'Romance', 'static/img/harryPotter')
        ";

        if (!mysqli_query($conn, $sqlInsertBooks)) {
            throw new Exception("Erro ao inserir livros iniciais: " . mysqli_error($conn));
        }
    }
}
