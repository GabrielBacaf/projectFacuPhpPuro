<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "Meu Projeto PHP" ?></title>
     <link rel="stylesheet" href="/projectFacuPhpPuro/css/style.css">
</head>

<body>
    <!-- <?php include_once __DIR__ . '/header.php'; ?> -->

    <main>
        <div class="container">
            <div>
                <?php include_once __DIR__ . '/session.php'; ?>
            </div>
            
            <?= $conteudo ?? '' ?>
        </div>
    </main>

    <!-- <?php include_once __DIR__ . '/footer.php'; ?> -->
</body>

</html>