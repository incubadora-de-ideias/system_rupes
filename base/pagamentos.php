<?php 

    $relatorioSql = "SELECT * FROM relatorio";
    $relatorio = $pdo->query($relatorioSql);
    $rupesSql = "SELECT * FROM rupes";
    $rupes = $pdo->query($rupesSql);

    $paga = 0;
    if($relatorio->rowCount() > 0 && $rupes->rowCount() > 0){
        foreach($relatorio as $rel){
            foreach($rupes as $rup){
                if($rel['n_protocolo'] == $rup['gpt']){
                    if($rel['situacao'] === 'Paga'){
                        $paga++;
                    }
                }
            }
        }
    }
?>