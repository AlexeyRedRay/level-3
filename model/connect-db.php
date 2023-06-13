<?php
$host = '127.0.0.1';
$db   = 'Books';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
$pdo = new PDO($dsn, $user, $pass, $opt);
} catch (Exception $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    header('Content-type: application/json');
    echo json_encode(['error' => ' 500 Internal Server Error']);
    exit();
}