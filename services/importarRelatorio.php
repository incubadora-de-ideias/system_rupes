<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            overflow-x: auto;
        }
        h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
            color: #555555;
        }
        th {
            background-color: #4CAF50;
            color: #ffffff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .message {
            color: #d9534f;
            font-size: 14px;
            margin-top: 15px;
        }
        button {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Relatório dos Rupes</h1>
        <?php
        $tableData = []; // Variável para armazenar os dados da tabela

        if (isset($_POST['submit'])) {
            if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
                $fileTmpPath = $_FILES['arquivo']['tmp_name'];
                $fileType = $_FILES['arquivo']['type'];
                $fileExtension = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

                if ($fileType == 'text/csv' || $fileExtension == 'csv') {
                    if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                        echo "<table>";
                        // Lê e exibe o cabeçalho
                        $header = fgetcsv($handle, 1000, ',');
                        if ($header) {
                            echo "<tr>";
                            foreach ($header as $col) {
                                echo "<th>" . htmlspecialchars($col) . "</th>";
                            }
                            echo "</tr>";

                            // Lê e exibe cada linha de dados
                            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                                $tableData[] = $data; // Armazena a linha de dados
                                echo "<tr>";
                                foreach ($data as $value) {
                                    echo "<td>" . htmlspecialchars($value) . "</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        echo "</table>";
                        fclose($handle);
                    } else {
                        echo "<p class='message'>Erro ao abrir o arquivo CSV.</p>";
                    }
                } else {
                    echo "<p class='message'>Por favor, envie um arquivo CSV válido.</p>";
                }
            } else {
                echo "<p class='message'>Erro no upload do arquivo.</p>";
            }
        } else {
            echo "<p class='message'>Nenhum arquivo enviado.</p>";
        }
        ?><br>

        <!-- Formulário para enviar os dados para a base de dados -->
        <form action="../base/processar_relatorio.php" method="POST">
            <input type="hidden" name="tableData" value='<?php echo json_encode($tableData); ?>'>
            <button type="submit">Enviar para a Base de Dados</button>
        </form>
    </div>
</body>
</html>
