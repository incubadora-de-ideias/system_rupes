<?php
    include('../config/config.php');

    // Decodifique os dados JSON
    $dados = json_decode($_POST['dados'], true);

    if ($dados) {
        $stmt = $pdo->prepare("INSERT INTO sua_tabela (referencia, gpt, data_vencimento, situacao, data_pagamento) VALUES (?, ?, ?, ?, ?)");
        foreach ($dados as $linha) {
            $stmt->execute([
                $linha['referencia'],
                $linha['gpt'],
                $linha['data_vencimento'],
                $linha['situacao'],
                $linha['data_pagamento']
            ]);
        }
        echo "<script>alert('Dados inseridos com sucesso!')</script>";
    } else {
        echo "<script>alert('Erro ao processar os dados').</script>";
    }
?>
