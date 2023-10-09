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
    <title>Glamour Styles - Stylists</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/stylist.css">
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
                <li>
                    <a href="customer.appointments.php">Citas</a>
                </li>
                <li>
                    <a href="customer.bookings.php">Reservas</a>
                </li>
                <li>
                    <a href="#">
                        <article class="card-content">
                            <img class="profile-photo" src="../../upload/<?php echo basename($row["photo_path"]) ?>" alt="profile-photo">
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
        <section class="section-stylist">
            <article class="article-info-styles">
                <div class="container-info">
                    <img src="../../public/assets/peluquera.jpg" alt="photo">
                    <div class="info-stylist">
                        <h4>Martha Sanchez Benitez</h4>
                        <p>Fecha: 2023-09-08</p>
                        <p>Horario: 08:00:00 hasta 16:00:00</p>
                    </div>
                </div>
                <a href="#">Agregar a citas</a>
            </article>

            <article class="article-info-styles">
                <div class="container-info">
                    <img src="../../public/assets/peluquera.jpg" alt="photo">
                    <div class="info-stylist">
                        <h4>Martha Sanchez Benitez</h4>
                        <p>Fecha: 2023-09-08</p>
                        <p>Horario: 08:00:00 hasta 16:00:00</p>
                    </div>
                </div>
                <a href="#">Agregar a citas</a>
            </article>

            <article class="article-info-styles">
                <div class="container-info">
                    <img src="../../public/assets/peluquera.jpg" alt="photo">
                    <div class="info-stylist">
                        <h4>Martha Sanchez Benitez</h4>
                        <p>Fecha: 2023-09-08</p>
                        <p>Horario: 08:00:00 hasta 16:00:00</p>
                    </div>
                </div>
                <a href="#">Agregar a citas</a>
            </article>

            <article class="article-info-styles">
                <div class="container-info">
                    <img src="../../public/assets/peluquera.jpg" alt="photo">
                    <div class="info-stylist">
                        <h4>Martha Sanchez Benitez</h4>
                        <p>Fecha: 2023-09-08</p>
                        <p>Horario: 08:00:00 hasta 16:00:00</p>
                    </div>
                </div>
                <a href="#">Agregar a citas</a>
            </article>
        </section>
    </main>




</body>

</html>