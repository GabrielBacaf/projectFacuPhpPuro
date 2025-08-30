<?php
require_once 'conexao.php';

function seedBooks($conn)
{
    
    $sqlCheck = "SELECT COUNT(*) as total FROM books";
    $result = mysqli_query($conn, $sqlCheck);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 0) {
        $sqlInsert = "
            INSERT INTO books (titulo, autor, editora, ano_publicacao, genero)
            VALUES
            ('Dom Casmurro', 'Machado de Assis', 'Editora Garnier', 1899, 'Romance'),
            ('O Cortiço', 'Aluísio Azevedo', 'Livraria Garnier', 1890, 'Romance'),
            ('A Hora da Estrela', 'Clarice Lispector', 'Rocco', 1977, 'Ficção'),
            ('Memórias Póstumas de Brás Cubas', 'Machado de Assis', 'Garnier', 1881, 'Romance'),
            ('Capitães da Areia', 'Jorge Amado', 'Companhia das Letras', 1937, 'Romance'),
            ('Grande Sertão: Veredas', 'Guimarães Rosa', 'Nova Fronteira', 1956, 'Romance'),
            ('Iracema', 'José de Alencar', 'B.L. Garnier', 1865, 'Romance'),
            ('Senhora', 'José de Alencar', 'B.L. Garnier', 1875, 'Romance'),
            ('Vidas Secas', 'Graciliano Ramos', 'José Olympio', 1938, 'Romance'),
            ('O Alienista', 'Machado de Assis', 'Revista Brasileira', 1882, 'Novela')
        ";

        if (!mysqli_query($conn, $sqlInsert)) {
            throw new Exception("Erro ao inserir dados iniciais: " . mysqli_error($conn));
        }
    }
}