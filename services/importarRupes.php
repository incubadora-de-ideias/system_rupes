<?php
echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Processados</title>
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
            max-width: 800px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 24px;
            color: #333333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
            color: #555555;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
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
        <h1>Dados do Arquivo Importado</h1>';

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $caminhoTemp = $_FILES['arquivo']['tmp_name'];

    if (($handle = fopen($caminhoTemp, 'r')) !== FALSE) {
        echo '<form action="processar_dados.php" method="post">';
        echo '<table>';
        echo '<tr><th>Nº Referência</th><th>Nº GPT</th><th>Data Vencimento</th><th>Situação</th><th>Data Pagamento</th></tr>';

        // Ignora a primeira linha (cabeçalho)
        fgetcsv($handle, 1000, ',');

        // Armazena as linhas em um array para enviar via POST
        $dados = [];
        while (($linha = fgetcsv($handle, 1000, ',')) !== FALSE) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($linha[0]) . '</td>';
            echo '<td>' . htmlspecialchars($linha[1]) . '</td>';
            echo '<td>' . htmlspecialchars($linha[2]) . '</td>';
            echo '<td>' . htmlspecialchars($linha[3]) . '</td>';
            echo '<td>' . htmlspecialchars($linha[4]) . '</td>';
            echo '</tr>';

            // Adiciona a linha ao array $dados
            $dados[] = [
                'referencia' => $linha[0],
                'gpt' => $linha[1],
                'data_vencimento' => $linha[2],
                'situacao' => $linha[3],
                'data_pagamento' => $linha[4],
            ];
        }

        // Codifica os dados para envio via input hidden
        echo '<input type="hidden" name="dados" value="' . htmlspecialchars(json_encode($dados)) . '">';
        
        echo '</table>';
        fclose($handle);

        echo '<div class="button-container">
                <button type="submit">Enviar para o Banco de Dados</button>
              </div>';
        echo '</form>';
    } else {
        echo "<p>Não foi possível ler o arquivo CSV.</p>";
    }
} else {
    echo "<p>Erro no upload do arquivo.</p>";
}

echo '</div>
</body>
</html>';
?>
