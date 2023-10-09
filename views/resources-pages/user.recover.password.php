<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Recuperar Contraseña</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/form.login.css">
</head>

<body>

    <main class="main-forms">
        <div class="container">
            <div class="back"></div>
            <div class="container-form">
                <div class="container-title">
                    <h4 class="title-form">¿Olvidaste tu Contrseña?</h4>
                </div>
                <form action="./index.php" class="form-login" method="post">
                    <label for="" class="email">Ingresa tu email <span>*</span></label>
                    <input type="email" name="email" class="input" placeholder="example@gmail.com" required>
                    <label for="" class="email">Nueva contraseña <span>*</span></label>
                    <input type="password" name="password" class="input" placeholder="*****************" required>

                    <button type="submit" class="button-login">Actualizar</button>

                </form>

                <div class="contaiter-redirect">
                    <a href="../../index.php">Regresar</a>
                </div>
            </div>
        </div>
    </main>

</body>

</html>