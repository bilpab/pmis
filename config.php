<?php
$dbHost = 'localhost';
$dbName = 'pmis';
$dbUser = 'root';
$dbPasw = '';
try {
    $connect = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPasw);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>