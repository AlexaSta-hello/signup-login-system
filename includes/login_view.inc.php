<?php

declare (strict_types=1);

function login_inputs() {
    if (isset($_SESSION["errors_login"]["empty_input"])) {
        echo '<p class="error">'. $_SESSION["errors_login"]["empty_input"] . '</p>';
    }

    if (isset($_SESSION["errors_login"]["login_incorrect"])) {
        echo '<p class="form-error">'. $_SESSION["errors_login"]["login_incorrect"] . '</p>';
        echo '<input type="text" name="email" placeholder="E-Mail">';
        echo '<input type="password" name="pwd" placeholder="Passwort">';
    } else {
        echo '<input type="text" name="email" placeholder="E-Mail">';
        echo '<input type="password" name="pwd" placeholder="Passwort">';
    }  
    

}


