<?php
    try {
        $dns = 'mysql:host=localhost; dbname=ozerulukan';
        $user = 'root';
        $pass = 'root';
        $pdo = new PDO($dns, $user, $pass);
        $pdo->exec('SET CHARSET UTF8');
        $pdo->exec('SET NAMES UTF8');
    } catch(PDOException $e) {
        die('Bağlantı kurulamadı.' . $e->getMessage());
        exit;
    }
?>