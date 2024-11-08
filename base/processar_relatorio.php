<?php
    include('../config/config.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tableData = json_decode($_POST['tableData'], true);

        // Preparando a inserção dos dados
        $stmt = $pdo->prepare("INSERT INTO tabela_nome (coluna1, coluna2, coluna3) VALUES (?, ?, ?)");

        foreach ($tableData as $row) {

            $stmt->execute([$row[0], $row[1], $row[2]]);
        }

        echo "<script>alert('Dados enviados para a base de dados com sucesso!')</script>";
    }
?>
