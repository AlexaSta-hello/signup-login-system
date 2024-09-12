<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];

        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Bitte füllen Sie alle Felder aus!";
        }

        $result = get_email($pdo, $email);

        if (is_email_wrong($result)) {
            $errors["login_incorrect"] = "Login nicht bekannt!";
        }

        if (!is_email_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Login nicht bekannt";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        $_SESSION['last_regeneration'] = time();

        header("Location: ../startseite.html?login=success");

        unset ($_SESSION["errors_login"]);
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