<?php
$host = 'db';
$db = 'db';
$user = 'clothingapp';
$pass = 'a123';
$port = "3306";
$charset = 'utf8';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$pdo = new \PDO($dsn, $user, $pass, $options);
?>