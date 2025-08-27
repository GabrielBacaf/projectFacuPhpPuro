<?php
function conectaBanco()
{
    $server = "localhost";
    $user = "root";
    $password = "";
    $basedados = "projetophp";
    $porta = 3380; // porta que você configurou no XAMPP

    $conn = mysqli_connect($server, $user, $password, $basedados, $porta);

    return ($conn) ? true : false;
}
