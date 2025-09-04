<?php
require_once __DIR__ . '/../Config/conexao.php';

function listAutoras(): array
{
    $conn = conectaBanco();

    // $sql = "SELECT id, nome FROM autoras ORDER BY nome";
    $sql = "SELECT id, nome FROM autoras";

    $result = mysqli_query($conn, $sql);



    $autoras = [];

   if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $autoras[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);


    return $autoras;
}


function reuperarNomeAutoraId(int $id): array
{
    $conn = conectaBanco();

    $sql = "SELECT nome FROM autoras WHERE id = $id LIMIT 1";

    $result = mysqli_query($conn, $sql);

    $book = [];

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    return $book;
}
