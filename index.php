<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Style - Login</title>
    <link rel="shortcut icon" href="./public/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="public/styles/main.css">
    <link rel="stylesheet" href="public/styles/form.login.css">
</head>

<body>
    <header class="header">
        <div class="container-logo">
            <img src="public/assets/logo.png" alt="logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </div>
    </header>

    <main class="main-forms">
        <div class="container">
            <div class="back"></div>
            <div class="container-form">
                <div class="container-title">
                    <h4 class="title-form">Iniciar Sesión</h4>
                </div>
                <form class="form-login" method="post" id="form">
                    <label for="" class="email">Email <span>*</span></label>
                    <input type="email" name="email" class="input" placeholder="example@gmail.com" required>
                    <label for="" class="email">Contraseña <span>*</span></label>
                    <input type="password" name="password" class="input" placeholder="*****************">

                    <button type="submit" class="button-login" id="button-login">Acceder</button>

                    <a href="views/recover/recover.php" class="text-password">¿Olvidaste tu contraseña?</a>

                </form>

                <div class="contaiter-redirect">
                    <p>¿No tienes cuenta? <a href="views/customer/customer.register.php">Registrarse</a></p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/user/login.js"></script>

</body>

</html>