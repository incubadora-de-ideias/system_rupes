<?php
echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Processados</title>
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <style>
        /* Responsividade da Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
                border-radius: 0;
                margin-bottom: 20px;
            }

            .main-panel {
                margin-left: 0;
            }

            .sidebar-link {
                font-size: 14px;
            }

            .footer {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        /* Ajustes para Tabelas em Telas Menores */
        @media (max-width: 576px) {
            .table-responsive {
                margin-bottom: 15px;
            }
            .table th, .table td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <nav class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed" style="height: 100vh; width: 250px; border-radius: 0 15px 15px 0; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="../index.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="../routes/rupes.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="../routes/relatorio.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="../routes/vizualizar.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="../routes/reports.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="../routes/configuracao.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <div class="main-panel" style="margin-left: 250px;">
        <div class="content">
            <div class="container-fluid">
                <h1 class="text-center mb-4"><i class="fas fa-file-alt"></i> Dados do Arquivo Importado</h1>';

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $caminhoTemp = $_FILES['arquivo']['tmp_name'];

    if (($handle = fopen($caminhoTemp, 'r')) !== FALSE) {
        echo '<form action="../base/processar_rupes.php" method="post">';
        echo '<div class="table-responsive"><table class="table table-striped table-bordered">';
        echo '<thead class="thead-dark"><tr><th>Nº Referência</th><th>Nº GPT</th><th>Data Vencimento</th><th>Situação</th><th>Data Pagamento</th></tr></thead><tbody>';

        // Ignora a primeira linha (cabeçalho)
        fgetcsv($handle, 1000, ',');

        // Armazena as linhas em um array para enviar via POST
        $dados = [];
        while (($linha = fgetcsv($handle, 1000, ',')) !== FALSE) {
            // Verifica se a linha possui o número esperado de colunas (ou mais)
            $referencia = isset($linha[0]) ? htmlspecialchars($linha[0]) : 'N/A';
            $gpt = isset($linha[1]) ? htmlspecialchars($linha[1]) : 'N/A';
            $data_vencimento = isset($linha[2]) ? htmlspecialchars($linha[2]) : 'N/A';
            $situacao = isset($linha[3]) ? htmlspecialchars($linha[3]) : 'N/A';
            $data_pagamento = isset($linha[4]) ? htmlspecialchars($linha[4]) : 'N/A';

            echo '<tr>';
            echo '<td>' . $referencia . '</td>';
            echo '<td>' . $gpt . '</td>';
            echo '<td>' . $data_vencimento . '</td>';
            echo '<td>' . $situacao . '</td>';
            echo '<td>' . $data_pagamento . '</td>';
            echo '</tr>';

            // Adiciona a linha ao array $dados
            $dados[] = [
                'referencia' => $referencia,
                'gpt' => $gpt,
                'data_vencimento' => $data_vencimento,
                'situacao' => $situacao,
                'data_pagamento' => $data_pagamento,
            ];
        }

        // Codifica os dados para envio via input hidden
        echo '<input type="hidden" name="dados" value="' . htmlspecialchars(json_encode($dados)) . '">';

        echo '</tbody></table></div>';
        fclose($handle);

        echo '<div class="text-center">
                <button type="submit" class="btn btn-success"><i class="fas fa-database"></i> Enviar para o Banco de Dados</button>
              </div>';
        echo '</form>';
    } else {
        echo "<p>Não foi possível ler o arquivo CSV.</p>";
    }
} else {
    echo "<p>Erro no upload do arquivo.</p>";
}

echo '</div>
</div>
</div>

<!-- Core JS Files -->
<script src="../assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script src="../assets/js/kaiadmin.min.js"></script>
</body>
</html>';
?>
