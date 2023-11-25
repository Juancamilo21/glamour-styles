<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Recuperar Contraseña</title>
    <link rel="shortcut icon" href="./public/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/form.login.css">
</head>

<body>

    <main class="main-forms">
        <div class="container">
            <div class="back"></div>
            <div class="container-form">
                <div class="container-title">
                    <h4 class="title-form">Recuperar Cuenta</h4>
                    <p class="alert" id="info-mail"></p>
                </div>
                <form class="form-login" method="post" id="form">
                    <label for="" class="email">Ingresa tu email <span>*</span></label>
                    <input type="email" name="email" class="input" placeholder="example@gmail.com" required>
                    <button type="submit" class="button-login" id="button">Recuperar</button>
                </form>

                <div class="contaiter-redirect">
                    <p>¿Has recuperado tu cuenta? <a href="../../index.php">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/user/mail.js"></script>
</body>

</html>