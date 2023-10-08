<?php include_once(__DIR__ . "/../../controllers/customer.controller.php");
    
    $customerController = new CustomerController();
    $customerController->header();

    $row = $customerController->findById();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Appointments</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/appointment.css">
    <script defer src="../../public/js/main.js"></script>
</head>

<body>


    <header class="header">
        <a href="./customer.home.php" class="link-logo">
            <img src="../../public/assets/logo.png" alt="Logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </a>
        <nav class="navbar">
            <ul class="menu">
                <li>
                    <a href="customer.home.php">Inicio</a>
                </li>
                <li class="current-item-page">
                    <a href="customer.appointments.php" class="current-page">Citas</a>
                </li>
                <li>
                    <a href="customer.bookings.php">Reservas</a>
                </li>
                <li>
                    <a href="#">
                        <article class="card-content">
                            <img class="profile-photo" src="../../public/assets/hermosa-foto.jpg" alt="profile-photo">
                            <p><?php echo $row["names"]?> +</p>
                        </article>
                    </a>
                    <div class="dropdown">
                        <a href="./customer.profile.php">
                            <div class="item-menu">
                                <i class="bi bi-person"></i> Perfil
                            </div>
                        </a>
                        <a href="../../controllers/logOut.php">
                            <div class="item-menu">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <button class="button-menu">
            <i class="bi bi-list"></i>
        </button>
    </header>

    <main class="main">

        <section class="section-title">
            <h1>Citas por confirmar</h1>
        </section>

        <section class="section-appoint">
            <article class="article-info-appoint">
                <div class="container-info">
                    <img src="../../public/assets/pestañas.jpg" alt="photo">
                    <div class="info-appoint">
                        <h4>Definición de pestañas</h4>
                        <div class="box-buttons">
                            <a href="#" style="background-color: #dc3545;">Eliminar</a>
                            <a href="#" style="background-color: #6c757d;">Detalles</a>
                            <a href="#">Reservar</a>
                        </div>
                    </div>
                </div>
                <p>Precio: $ 35.000</p>
            </article>

            <article class="article-info-appoint">
                <div class="container-info">
                    <img src="../../public/assets/pestañas.jpg" alt="photo">
                    <div class="info-appoint">
                        <h4>Definición de pestañas</h4>
                        <div class="box-buttons">
                            <a href="#" style="background-color: #dc3545;">Eliminar</a>
                            <a href="#" style="background-color: #6c757d;">Detalles</a>
                            <a href="#">Reservar</a>
                        </div>
                    </div>
                </div>
                <p>Precio: $ 35.000</p>
            </article>
        </section>

        <section class="section-total">
            <div class="container-total">
                <p>Total: $70.000</p>
                <a href="#">Reservar todo</a>
            </div>
        </section>

    </main>



</body>

</html>