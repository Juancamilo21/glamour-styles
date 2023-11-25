<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Style - Login</title>
    <link rel="shortcut icon" href="./public/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/form.login.css">
</head>

<body>
    <header class="header">
        <div class="container-logo">
            <img src="../../public/assets/logo.png" alt="logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </div>
    </header>

    <main class="main-forms">
        <div class="container">
            <div class="back"></div>
            <div class="container-form">
                <div class="container-title">
                    <h4 class="title-form">Nueva Contraseña</h4>
                </div>
                <form class="form-login" id="form">
                    <input type="hidden" name="uid" id="uid">
                    <input type="hidden" name="token" id="token">
                    <label for="pass" class="password">Contraseña <span>*</span></label>
                    <input type="password" name="password" id="password" class="input" placeholder="*****************" required>
                    <label for="pass" class="email">Confirmar contraseña <span>*</span></label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="input" placeholder="*****************" required>

                    <button type="submit" class="button-login" id="button">Guardar cambios</button>
                </form>
            </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/user/update.password.js"></script>
</body>

</html>