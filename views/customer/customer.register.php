<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Style - Register</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/form.register.css">
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
                    <h4 class="title-form">Registrarse</h4>
                </div>
                <form class="form-register" method="post" id="form">

                    <div class="container-inputs">
                        <label>Nombres <span>*</span></label>
                        <input type="text" name="names" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Apellidos <span>*</span></label>
                        <input type="text" name="lastnames" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Edad <span>*</span></label>
                        <input type="number" name="age" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Dirección <span>*</span></label>
                        <input type="text" name="address" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Telefono <span>*</span></label>
                        <input type="number" name="phoneNumber" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Cedula <span>*</span></label>
                        <input type="number" name="dci" class="input" required>
                    </div>

                    <div class="container-inputs">
                        <label>Email <span>*</span></label>
                        <input type="email" name="email" class="input" placeholder="example@gamil.com" required>
                    </div>

                    <div class="container-inputs">
                        <label>Contraseña <span>*</span></label>
                        <input type="password" name="password" class="input" placeholder="*****************" required>
                    </div>

                    <div class="container-button">
                        <button type="submit" class="button-register" id="button-register">Registrarse</button>
                    </div>
                    
                </form>
                <div class="contaiter-redirect">
                    <p>¿Ya tienes cuenta? <a href="../../index.php">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/customer/register.js"></script>
</body>

</html>