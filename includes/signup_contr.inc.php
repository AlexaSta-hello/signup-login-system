<?php

// hier Kontrolle der Eingaben ohne Zugriff auf DB
// mit string / object sagen wir welchen TYP wir erwarten

declare(strict_types=1); //true

function is_input_empty(string $vorname, string $nachname, string $pwd, string $email) {
    if (empty($vorname) || empty($nachname) || empty($pwd) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_vorname_wrong(string $vorname) {
    
    $pattern_name = "/^[a-zA-Z]{2,}$/"; // nur mind. 2 buchstaben

    if (!filter_var($vorname, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $pattern_name]])) {
        return true;
    } else {
        return false;
    }
}

function is_nachname_wrong(string $nachname) {
    
    $pattern_name = "/^[a-zA-Z]{2,}$/"; // nur mind. 2 buchstaben

    if (!filter_var($nachname, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $pattern_name]])) {
        return true;
    } else {
        return false;
    }
}

// für pwd nun etwas kompakter umgesetzt!
function is_pwd_wrong(string $pwd): bool {
    $pattern_pwd = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/"; // mind 8 zeichen, sowohl buchstbane als auch zahlen
    return !filter_var($pwd, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => $pattern_pwd]]);
}



// Hier Abfrage (query) an DB. Daher model file. NUR!! model file kommuniziert mit DB

function is_email_registered (object $pdo, string $email) {

    if (get_email ($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function create_user (object $pdo, string $vorname,  string $nachname, string $pwd, string $email) {

    set_user($pdo, $vorname, $nachname, $pwd, $email); // weiter in model.inc
}

