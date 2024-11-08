<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de rupes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: #333333;
        }
        label {
            font-weight: bold;
            color: #555555;
            display: block;
            margin-bottom: 8px;
        }
        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            color: #d9534f;
            font-size: 14px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Importação de Rupes</h1>
        <form action="../services/importarRupes.php" method="post" enctype="multipart/form-data">
            <label for="arquivo">Escolha o arquivo:</label>
            <input type="file" name="arquivo" id="arquivo" accept=".csv">
            <button type="submit">Enviar</button>
        </form>
        <p class="message">* Por favor, selecione um arquivo CSV.</p>
    </div>
</body>
</html>

