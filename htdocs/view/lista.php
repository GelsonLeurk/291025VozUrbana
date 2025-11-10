<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pontos Cadastrados</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Pontos Urbanos Registrados</h1>
        <p>Veja os registros enviados pela comunidade</p>
    </header>

    <main>
        <ul class="lista-pontos">
            <?php foreach ($pontos as $p): ?>
                <li>
                    <h3><?= htmlspecialchars($p->tipo) ?></h3>
                    <p><?= nl2br(htmlspecialchars($p->descricao)) ?></p>
                    <p><strong>Localização:</strong> <?= $p->latitude ?>, <?= $p->longitude ?></p>
                    <?php if ($p->foto): ?>
                        <p><img src="<?= $p->foto ?>" alt="Foto do ponto" style="max-width:100%;border-radius:8px;"></p>
                    <?php endif; ?>
                    <p><em>Enviado em: <?= date("d/m/Y H:i", strtotime($p->data_envio)) ?></em></p>
                    <a href="index.php?action=mapa&id=<?= $p->id ?>" class="btn-link">Ver no mapa</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="menu">
            <a href="index.php" class="btn">Voltar à Home</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Turismo de Luxo</p>
    </footer>
</body>
</html>