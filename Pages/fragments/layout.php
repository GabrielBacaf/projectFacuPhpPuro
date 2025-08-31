<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "Meu Projeto PHP" ?></title>
    <link rel="stylesheet" href="/projectFacuPhpPuro/static/css/style.css">
</head>

<body>
    <header>
        <?php include_once __DIR__ . '/header.php'; ?>
    </header>
   

    <main id="home">
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