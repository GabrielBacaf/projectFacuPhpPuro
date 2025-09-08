<?php
include_once __DIR__ . '/conexao.php';

function seedBooks($conn)
{

    $sqlCheckAutores = "SELECT COUNT(*) as total FROM autoras";
    $result = mysqli_query($conn, $sqlCheckAutores);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 0) {
        $sqlInsertAutores = "
            INSERT INTO autoras (nome, idade, nacionalidade, descricao, premios, imagem, resumo)
            VALUES
            ('Machado de Assis', 69, 'Brasileira', 'Um dos maiores nomes da literatura brasileira, fundador da Academia Brasileira de Letras.', NULL, 'static/img/harryPotter.jpg', 'Machado de Assis nasceu no Rio de Janeiro e é autor de obras clássicas como Dom Casmurro e Memórias Póstumas de Brás Cubas.'),
            ('Aluísio Azevedo', 52, 'Brasileira', 'Romancista naturalista, autor de O Cortiço.', NULL, 'static/img/harryPotter.jpg', 'Aluísio Azevedo foi um dos maiores romancistas naturalistas do Brasil, destacando-se por suas obras realistas e críticas sociais.'),
            ('Clarice Lispector', 56, 'Brasileira', 'Uma das escritoras mais importantes do século XX no Brasil.', NULL, 'static/img/harryPotter.jpg', 'Clarice Lispector é conhecida por sua escrita introspectiva e profunda, explorando a psicologia de seus personagens.'),
            ('Jorge Amado', 88, 'Brasileira', 'Um dos escritores mais populares do Brasil, autor de Capitães da Areia.', NULL, 'static/img/harryPotter.jpg', 'Jorge Amado retratou a vida do povo baiano em romances cheios de cor e humanidade.'),
            ('Guimarães Rosa', 59, 'Brasileira', 'Autor de Grande Sertão: Veredas, mestre da literatura modernista.', NULL, 'static/img/harryPotter.jpg', 'Guimarães Rosa é mestre da linguagem e da narrativa modernista, autor de Grande Sertão: Veredas.'),
            ('José de Alencar', 70, 'Brasileira', 'Romancista indianista, autor de Iracema e Senhora.', NULL, 'static/img/harryPotter.jpg', 'José de Alencar destacou-se por seus romances indianistas e pela valorização da cultura brasileira.');
            ";
        if (!mysqli_query($conn, $sqlInsertAutores)) {
            throw new Exception("Erro ao inserir autoras iniciais: " . mysqli_error($conn));
        }
    }

  
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
            INSERT INTO books (titulo, autora_id, editora, ano_publicacao, genero, imagem, resumo)
            VALUES
            ('Dom Casmurro', {$autoras['Machado de Assis']}, 'Editora Garnier', 1899, 'Romance', 'static/img/harryPotter.jpg', 'Dom Casmurro é um romance clássico de Machado de Assis que trata de amor, ciúme e memória.'),
            ('O Cortiço', {$autoras['Aluísio Azevedo']}, 'Livraria Garnier', 1890, 'Romance', 'static/img/harryPotter.jpg', 'O Cortiço retrata a vida urbana e as tensões sociais do Rio de Janeiro do século XIX.'),
            ('A Hora da Estrela', {$autoras['Clarice Lispector']}, 'Rocco', 1977, 'Ficção', 'static/img/harryPotter.jpg', 'A Hora da Estrela narra a vida de Macabéa, uma jovem nordestina vivendo no Rio de Janeiro.'),
            ('Memórias Póstumas de Brás Cubas', {$autoras['Machado de Assis']}, 'Garnier', 1881, 'Romance', 'static/img/harryPotter.jpg', 'O livro apresenta a visão do narrador Brás Cubas após a morte, em tom irônico e crítico.'),
            ('Capitães da Areia', {$autoras['Jorge Amado']}, 'Companhia das Letras', 1937, 'Romance', 'static/img/harryPotter.jpg', 'Conta a vida de um grupo de meninos de rua em Salvador e seus conflitos com a sociedade.'),
            ('Grande Sertão: Veredas', {$autoras['Guimarães Rosa']}, 'Nova Fronteira', 1956, 'Romance', 'static/img/harryPotter.jpg', 'Romance modernista que explora a linguagem e a vida no sertão brasileiro.'),
            ('Memórias Póstumas de Brás Cubas', {$autoras['Machado de Assis']}, 'Garnier', 1881, 'Romance', 'static/img/harryPotter.jpg', 'O livro apresenta a visão do narrador Brás Cubas após a morte, em tom irônico e crítico.'),
            ('Dom Casmurro', {$autoras['Machado de Assis']}, 'Editora Garnier', 1899, 'Romance', 'static/img/harryPotter.jpg', 'Dom Casmurro é um romance clássico de Machado de Assis que trata de amor, ciúme e memória.');
            ";
        if (!mysqli_query($conn, $sqlInsertBooks)) {
            throw new Exception("Erro ao inserir livros iniciais: " . mysqli_error($conn));
        }
    }
}
