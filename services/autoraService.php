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
