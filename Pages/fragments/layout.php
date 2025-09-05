<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "Meu Projeto PHP" ?></title>
    <link rel="stylesheet" href="/projectFacuPhpPuro/static/css/style.css">
</head>

<body>
    <div class="grid-container">
        <header>
            <div class="header-container">
                <h1>Bibliotca Virtual</h1>
            </div>
        </header>

        <aside>
            <?php include_once __DIR__ . '/header.php'; ?>
        </aside>

        <main>
            <div class="container">
                <div>
                    <?php include_once __DIR__ . '/session.php'; ?>
                </div>

                <?= $conteudo ?? '' ?>
            </div>
        </main>

        <footer>
            <div class="footer-container">
                <p>Trabalho de avaliação prática da disciplina WEB1, desenvolvido com carinho pelo grupo CRIMPADORES!!.</p>
            </div>
        </footer>
    </div>
</body>

</html>