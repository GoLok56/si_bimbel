<?php

require_once('core/init.php');
if (isset($_SESSION['has_login'])) {
    header('location: /bimbel');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Informasi Bimbel</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <main class="flex center-vertical center-horizontal">
        <form action="controllers/login_controller.php" method="post" onsubmit="return validateForm()">
            <fieldset>
                <legend>Login</legend>
                
                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="Username">
                    <small class="hide">* Isi ini dulu yuk</small>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <small class="hide">* Isi ini dulu yuk</small>
                </div>

                <div class="form-group">
                    <input type="submit" value="Masuk" class="btn accent-color">
                </div>
            </fieldset>
        </form>
    </main>

    <script src="assets/js/login.js"></script>
</body>
</html>