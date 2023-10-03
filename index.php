<?php include("login/login.users.php");

/*$email = $_POST["email"];
    $password = $_POST["password"];

    if(isset($email) && isset($password)) {
        $login = new LoginUsers();
        $login->setEmail($email);
        $login->setPassword($password);
        $login->login();
    }*/


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Style - Login</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/form.login.css">
</head>

<body>
    <header class="header">
        <div class="container-logo">
            <img src="assets/logo.png" alt="logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </div>
    </header>

    <main class="main-forms">
        <div class="container">
            <div class="back"></div>
            <div class="container-form">
                <div class="container-title">
                    <h4 class="title-form">Iniciar Sesión</h4>
                    <?php
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        if (isset($email) && isset($password)) {
                            $login = new LoginUsers();
                            $login->setEmail($email);
                            $login->setPassword($password);
                            $login->login();
                        }
                    ?>
                </div>
                <form action="./index.php" class="form-login" method="post">
                    <label for="" class="email">Email <span>*</span></label>
                    <input type="email" name="email" class="input" placeholder="example@gmail.com" required>
                    <label for="" class="email">Contraseña <span>*</span></label>
                    <input type="password" name="password" class="input" placeholder="*****************" required>

                    <button type="submit" class="button-login">Acceder</button>

                    <a href="#" class="text-password">¿Olvidaste tu contraseña?</a>

                </form>

                <div class="contaiter-redirect">
                    <p>¿No tienes cuenta? <a href="customer/customer.register.php">Registrarse</a></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>