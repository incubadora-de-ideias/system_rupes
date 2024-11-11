<?php
    include('../config/config.php');

    try {
        $tableData = json_decode($_POST['dados'], true);
        if ($tableData) {
            foreach ($tableData as $row) {
                // Verificar e formatar a data
                $dataString = $row['data_solicitacao'];
                $data = DateTime::createFromFormat('d/m/Y', $dataString);
                if ($data === false) {
                    echo "Data inválida: " . $dataString;
                    continue;
                }
                $formato = $data->format('Y-m-d H:i:s');

                // Verificar se já existe o número de protocolo
                $checkSql = "SELECT * FROM relatorio WHERE n_protocolo = :numero_protocolo";
                $checkStmt = $pdo->prepare($checkSql);
                $checkStmt->bindParam(':numero_protocolo', $row['numero_protocolo'], PDO::PARAM_STR);
                $checkStmt->execute();
                $exists = $checkStmt->rowCount();

                // Se não existir, inserir os dados
                if ($exists == 0) {
                    $insertSql = "INSERT INTO relatorio (nome_servico, numero_protocolo, taxa, contribuinte, data_solicitacao, moeda) 
                                VALUES (:nome_servico, :numero_protocolo, :taxa, :contribuinte, :data_solicitacao, :moeda)";
                    $insertStmt = $pdo->prepare($insertSql);
                    
                    $insertStmt->bindParam(':nome_servico', $row['nome_servico'], PDO::PARAM_STR);
                    $insertStmt->bindParam(':numero_protocolo', $row['numero_protocolo'], PDO::PARAM_STR);
                    $insertStmt->bindParam(':taxa', $row['taxa'], PDO::PARAM_STR);
                    $insertStmt->bindParam(':contribuinte', $row['contribuinte'], PDO::PARAM_STR);
                    $insertStmt->bindParam(':data_solicitacao', $formato, PDO::PARAM_STR);
                    $insertStmt->bindParam(':moeda', $row['moeda'], PDO::PARAM_STR);
                    if ($insertStmt->execute()) {
                        echo "<script>alert('Dados enviados para a base de dados com sucesso!');</script>";
                    } else {
                        echo "<script>alert('Erro ao inserir dados.');</script>";
                    }
                }
            }
        }
    } catch (Exception $e) {
        echo "<script>alert('Erro ao processar os dados: " . $e->getMessage() . "');</script>";
    }
?>
