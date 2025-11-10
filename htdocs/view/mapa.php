<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($ponto->tipo) ?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="public/css/mapa.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($ponto->tipo) ?></h1>
    </header>

    <main>
        <p><?= nl2br(htmlspecialchars($ponto->descricao)) ?></p>
        <p><strong>Localização:</strong> <?= $ponto->latitude ?>, <?= $ponto->longitude ?></p>
        <?php if ($ponto->foto): ?>
            <p><img src="<?= $ponto->foto ?>" alt="Foto do ponto" style="max-width:100%;border-radius:8px;"></p>
        <?php endif; ?>
        <div id="map" style="height: 400px; margin-top: 20px;"></div>

        <div class="menu">
            <a href="index.php?action=listar" class="btn">Voltar à Lista</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Turismo de Luxo</p>
    </footer>

    <script>
        var map = L.map('map').setView([<?= $ponto->latitude ?>, <?= $ponto->longitude ?>], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);
        L.marker([<?= $ponto->latitude ?>, <?= $ponto->longitude ?>])
            .addTo(map)
            .bindPopup("<?= addslashes($ponto->tipo) ?>")
            .openPopup();
    </script>
</body>
</html>