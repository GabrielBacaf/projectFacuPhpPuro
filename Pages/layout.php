<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "Meu Projeto PHP" ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- <?php include 'header.php'; ?> -->

    <main>
        <div class="container">
            <?= $conteudo ?? '' ?>
        </div>
    </main>

    <!-- <?php include 'footer.php'; ?> -->
</body>
</html>