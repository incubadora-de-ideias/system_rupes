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

                 $checkSql = "SELECT * FROM rupes WHERE rupe = '".$linha['referencia']."'";
                 $checar = $pdo->query($checkSql);
                 $exists = $checar->rowCount();
                 if(!$exists){
                    $sql = "INSERT INTO rupes VALUES (Default, '".$linha['referencia']."', '".$linha['gpt']."', 0, '".$formato."')";
                    $pdo->query($sql);
                 }
             }
             echo "<script>alert('Dados inseridos com sucesso!')</script>";
             header('Location: ../routes/vizualizar.php');
         } else {
             echo "<script>alert('Erro ao processar os dados');</script>";
         }
    } catch (\Throwable $th) {
        echo "<script>alert('Erro ao processar os dados');</script>";
    }
?>
