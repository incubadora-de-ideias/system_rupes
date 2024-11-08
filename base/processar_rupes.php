<?php
    include('../config/config.php');
    try {
         // Decodifique os dados JSON
         $dados = json_decode($_POST['dados'], true);

         if ($dados) {
             foreach ($dados as $linha) {
                 $dataString = $linha['data_vencimento'];
                 $data = DateTime::createFromFormat('d/m/Y', $dataString);
                 $formato = $data->format('Y-m-d H:i:s');
                 $sql = "INSERT INTO rupes VALUES (Default, '".$linha['referencia']."', '".$linha['gpt']."', 0, '".$formato."')";
                 $pdo->query($sql);
             }
             echo "<script>alert('Dados inseridos com sucesso!')</script>";
         } else {
             echo "<script>alert('Erro ao processar os dados');</script>";
         }
    } catch (\Throwable $th) {
        echo "<script>alert('Erro ao processar os dados');</script>";
    }
?>
