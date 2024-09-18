<?php
include_once 'functions.php';
//Connection with database

$host = 'localhost';
$database = 'membership_administration'; // Change if necessary
$user = '';                    // Change if necessary
$pass = '';                   // Change if necessary
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$database;charset=$chrs";
$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $conn = new pdo($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    echo $error;
    exit();
}
