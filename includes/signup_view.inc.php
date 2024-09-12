<?php

declare(strict_types=1); //true


function signup_inputs() {
    
    // last but not least: statt der normalen Form anzuzeigen, zeigen wir schon mit Daten aus SESIION an, falls schon eingegeben!
    // do we have the signup_data and not the error? show username plus value in input

    if (isset($_SESSION["errors_signup"]["empty_input"])) {
        echo '<p class="error">'. $_SESSION["errors_signup"]["empty_input"] . '</p>';
    }

    // Vorname: Fehlermeldung & Input (ggf. mit Daten) 
    if (isset($_SESSION["errors_signup"]["wrong_vorname"])) {
        echo '<p class="form-error">'. $_SESSION["errors_signup"]["wrong_vorname"] . '</p>';
    } 
    if (isset($_SESSION["signup_data"]["vorname"]) && !isset($_SESSION
        ["errors_signup"]["wrong_vorname"])) {
        echo '<input type="text" name="vorname" placeholder="Vorname" value="' . 
        $_SESSION["signup_data"]["vorname"] . '">';    // mit Daten aus Session
    } else { 
        echo '<input type="text" name="vorname" placeholder="Vorname">'; // ohne Daten
    }

    // Nachname:
    if (isset($_SESSION["errors_signup"]["wrong_nachname"])) {
        echo '<p class="form-error">'. $_SESSION["errors_signup"]["wrong_nachname"] . '</p>';
    }
    if (isset($_SESSION["signup_data"]["nachname"]) && !isset($_SESSION
        ["errors_signup"]["wrong_nachname"])) {
        echo '<input type="text" name="nachname" placeholder="Nachname" value="' . 
        $_SESSION["signup_data"]["nachname"] . '">'; 
    } else { 
        echo '<input type="text" name="nachname" placeholder="Nachname">';
    }
    
    // E-Mail:
    if (isset($_SESSION["errors_signup"]["wrong_email"])) {
        echo '<p class="form-error">'. $_SESSION["errors_signup"]["wrong_email"] . '</p>';    
    } 
    if (isset($_SESSION["errors_signup"]["email_used"])) {
        echo '<p class="form-error">'. $_SESSION["errors_signup"]["email_used"] . '</p>';
    } 
    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION
        ["errors_signup"]["email_used"]) && !isset($_SESSION
        ["errors_signup"]["wrong_email"])) {
        echo '<input type="text" name="email" placeholder="E-Mail" value="' . 
        $_SESSION["signup_data"]["email"] . '">';    
    } else { 
        echo '<input type="text" name="email" placeholder="E-Mail">';
    }

    // Passwort:
    if (isset($_SESSION["errors_signup"]["wrong_pwd"])) {
        echo '<p class="form-error">'. $_SESSION["errors_signup"]["wrong_pwd"] . '</p>';
        echo '<input type="password" name="pwd" placeholder="Password">'; // Pwd muss immer eingegeben werden
    } else {
        echo '<input type="password" name="pwd" placeholder="Password">';
    }

    
    
}

function signup_success() {
    if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Signup success!</p>';     
    }
}


