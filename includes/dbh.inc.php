<?php

// Hier DB Connection

/*$host = 'localhost';
$dbname = 'loginsystem';*/
$dsn = "mysql:host=localhost;dbname=loginsystem";
$dbusername = 'root';
$dbpassword = '';

// neues PHP Data Object zum Aufbau der Verbindung
try {
    /*$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);*/
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Die Verbindung ist fehlgeschlagen: " . $e->getMessage());    
}