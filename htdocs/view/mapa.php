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
        <div id="map" style="height:500px;"></div>

        <div class="menu">
            <a href="index.php?action=listar" class="btn">Voltar à Lista</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Turismo de Luxo</p>
    </footer>

    <script>
        const lat = <?= isset($ponto) ? floatval($ponto->latitude) : '0' ?>;
        const lng = <?= isset($ponto) ? floatval($ponto->longitude) : '0' ?>;
        const tipoTexto = <?= isset($ponto) ? json_encode($ponto->tipo) : '""' ?>;
        const descricaoTexto = <?= isset($ponto) ? json_encode($ponto->descricao) : '""' ?>;

        var map = L.map('map').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup(`<strong>${tipoTexto}</strong><br>${descricaoTexto}`)
            .openPopup();
    </script>
</body>
</html>