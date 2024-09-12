<?php
require_once 'includes/signup_view.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
    
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post">
        <?php login_inputs(); ?>
        <button>Login</button>
    </form>


    <h3>Signup</h3>

    <form action="includes/signup.inc.php" method="post">
        <?php 
        signup_inputs(); // in view
        ?>
        <button>Signup</button>
        <?php
        signup_success();
        ?>
    </form>
    
    


</body>
</html>