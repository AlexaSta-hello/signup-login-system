<?php

declare(strict_types=1); //true


function get_email (object $pdo, string $email) {

    // Query Statement, das wir mit unserer pdo Connection an die DB schicken können
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query); // -> point to a prepare statement. Verhindert SQL Injection
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result; // hiermit kriegen wir den username aus der DB. Wenn nciht vorhanden dann false

}

function set_user(object $pdo, string $vorname,  string $nachname, string $pwd, string $email) {
    $query = "INSERT INTO users (vorname, nachname, pwd, email) VALUES (:vorname, :nachname, :pwd, :email);";
    $stmt = $pdo->prepare($query); // -> point to a prepare statement. Verhindert SQL Injection

    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':vorname', $vorname);
    $stmt->bindParam(':nachname', $nachname);
    $stmt->bindParam(':pwd', $hashedPwd);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}