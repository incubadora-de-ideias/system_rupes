<?php 
    $host = "";
    $dbname = "";
    $user = "";
    $password = "";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$password");
    } catch (PDOException $th) {
        echo "<script>alert('Erro ao cadastrar com banco de dados')<script>";
    }
?>