<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {

        //Wir schnappen uns die Files  -> Reihenfolge wichtig. View wäre zwischen m und c
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        //Error Handlers im contr. file
        $errors = [];

        if (is_input_empty($vorname, $nachname, $pwd, $email)) {
            $errors["empty_input"] = "Bitte füllen Sie alle Felder aus!";
        }

        if (is_vorname_wrong($vorname)) {
            $errors["wrong_vorname"] = "Vorname: mind. 2 Zeichen. Nur Buchstaben!";
        }

        if (is_nachname_wrong($nachname)) {
            $errors["wrong_nachname"] = "Nachname: mind. 2 Zeichen. Nur Buchstaben!";
        }

        if (is_email_invalid($email)) {
            $errors["wrong_email"] = "Bitte korrekte Email-Adresse eingeben!";
        }
        if (is_email_registered ($pdo, $email)) {
            $errors["email_used"] = "Email bereits vergeben!";
        }

        if (is_pwd_wrong($pwd)) {
            $errors["wrong_pwd"] = "Passwort: mind. 8 Zeichen. Buchstaben & Zahlen!";
        }

        /* hier sollte zunächst eine session gestartet werden. Daher noch mal
            require ...php weil da eine session gestartet wird. 
            Wir könnten aus session_start() eingeben, aber es ist sicherer wenn
            wir die session über config_session starten. */
        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            /* last : usibility feature! wenn ich das falsche pwd eingebe, aber name 
            und email richtig, soll er username und email drin lassen in der anzeige,
            damit ich sie nicht noch mal eingeben muss! */
            $signupData = [     // nach dem user ihr daten geschickt haben schicken wir sie an die signup form
                "vorname" => $vorname,
                "nachname" => $nachname, // "nachname" ist random gewählter string
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData; // wir schicken die daten wieder in die signup form

            header("Location: ../index.php");
            die();
            /* jetzt weiter in index.php da wir mit header dahin zurück geführt werden
            bei error und die Messages da ausgegeben werden sollen */
        }

        // Jetzt kreieren wir die User -> weiter in signup_contr.inc
        create_user($pdo, $vorname, $nachname, $pwd, $email);

        header("Location: ../index.php?signup=success");

        unset($_SESSION["signup_data"]);
        unset($_SESSION["errors_signup"]);

        $pdo = null; 
        $stmt = null;

        
        die();


    } catch (PDOException $e) {
        die("Abfrage fehlgeschlagen: " . $e->getMessage());    
    }

} else {
    header("Location: ../index.php");
    die();
}