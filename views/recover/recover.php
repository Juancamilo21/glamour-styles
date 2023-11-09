<!DOCTYPE html>
<html lang="es">

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
                    <h4 class="title-form">Recuperar Cuenta</h4>
                    <?php include_once(__DIR__ . "/../../controllers/user.controller.php");

                        $userController = new UserController();
                        $userController->recoverPassword();

                    ?>
                </div>
                <form action="./recover.php" class="form-login" method="post">
                    <label for="" class="email">Ingresa tu email <span>*</span></label>
                    <input type="email" name="email" class="input" placeholder="example@gmail.com" required>
                    <button type="submit" class="button-login">Recuperar</button>

                </form>

                <div class="contaiter-redirect">
                    <p>¿Has recuperado tu cuenta? <a href="../../index.php">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </main>

</body>

</html>