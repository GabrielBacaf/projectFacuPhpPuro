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
            <?php include_once __DIR__ . '/header.php'; ?>
        </header>

        <aside>
            <?php include_once __DIR__ . '/aside.php'; ?>
        </aside>

        <main>
            <div class="container">
                <?php include_once __DIR__ . '/session.php'; // Inclui a sessão no topo do container ?>
                <?= $conteudo ?? '' // O conteúdo da página (index, etc.) vem logo depois ?>
            </div>
        </main>

        <footer>
            <?php include_once __DIR__ . '/footer.php'; ?>
        </footer>
    </div>
</body>
</html>