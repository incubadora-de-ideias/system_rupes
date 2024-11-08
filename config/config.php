<?php 
    $host = "localhost";
    $dbname = "teste_rupes";
    $user = "root";
    $password = "";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $th) {
        echo "<script>alert('Erro ao cadastrar com banco de dados". $th->getMessage()."')<script>";
    }
?>