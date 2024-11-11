<?php 
    include('config.php');
    $total = $pdo->query("SELECT COUNT(*) FROM rupes")->fetchColumn();
    
    $disp = "SELECT COUNT(*) FROM rupes WHERE data_validade > NOW() AND usado = 0";
    $disponivel = $pdo->query($disp)->fetchColumn();

    $indip = "SELECT COUNT(*) FROM rupes WHERE usado = 1";
    $indisponivel = $pdo->query($indip)->fetchColumn();

    $exp = "SELECT COUNT(*) FROM rupes WHERE data_validade < NOW()";
    $expirados = $pdo->query($exp)->fetchColumn();
?>