<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ponto Urbano</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Cadastrar Ponto Urbano</h1>
        <p>Informe os dados para registrar um novo ponto</p>
    </header>

    <main>
        <form method="post" action="index.php?action=salvar" enctype="multipart/form-data" style="max-width:600px;margin:0 auto;">
            <label for="tipo">Tipo de Ponto:</label><br>
            <input type="text" id="tipo" name="tipo" required><br><br>

            <label for="descricao">Descrição:</label><br>
            <textarea id="descricao" name="descricao" rows="4" required></textarea><br><br>

            <label for="latitude">Latitude:</label><br>
            <input type="text" id="latitude" name="latitude" required><br><br>

            <label for="longitude">Longitude:</label><br>
            <input type="text" id="longitude" name="longitude" required><br><br>

            <label for="foto">Foto (opcional):</label><br>
            <input type="file" id="foto" name="foto" accept="image/*"><br><br>

            <button type="submit" class="btn">Salvar</button>
        </form>

        <div class="menu">
            <a href="index.php?action=listar" class="btn">Ver Lista</a>
        </div>
    </main>

    <footer>
        &copy; 2025 Sistema de Registro Urbano
    </footer>
</body>
</html>