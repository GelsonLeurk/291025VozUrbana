<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal de Turismo</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Portal de Turismo</h1>
        <p>Descubra destinos exclusivos e inesquecíveis</p>
    </header>

    <main>
        <div class="menu">
            <a href="index.php?action=form" class="btn">Cadastrar Ponto Urbano</a>
            <a href="index.php?action=listar" class="btn">Ver Todos os Pontos</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Turismo de Luxo</p>
    </footer>
</body>
</html>