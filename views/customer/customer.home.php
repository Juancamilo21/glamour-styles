<?php include_once(__DIR__ . "/../../controllers/customer.controller.php");
    
    $customerController = new CustomerController();
    $customerController->headerSecurity();

    $row = $customerController->getByIdCustomer();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Home</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/home.css">
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
                <li class="current-item-page">
                    <a href="customer.home.php" class="current-page">Inicio</a>
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
        <section class="section-service">
            <article class="article-service">
                <div class="container-img-service">
                    <img src="../../public/assets/cortar-cabello.jpg" alt="image">
                </div>
                <div class="container-content-service">
                    <h4>Corte de cabello</h4>
                    <p>$ 20.000</p>
                    <a href="#" class="button-detail-service">Detalles</a>
                    <a href="#" class="button-appoint">Agendar</a>
                </div>
            </article>

            <article class="article-service">
                <div class="container-img-service">
                    <img src="../../public/assets/cortar-cabello.jpg" alt="image">
                </div>
                <div class="container-content-service">
                    <h4>Corte de cabello</h4>
                    <p>$ 20.000</p>
                    <a href="#" class="button-detail-service">Detalles</a>
                    <a href="#" class="button-appoint">Agendar</a>
                </div>
            </article>


            <article class="article-service">
                <div class="container-img-service">
                    <img src="../../public/assets/cortar-cabello.jpg" alt="image">
                </div>
                <div class="container-content-service">
                    <h4>Corte de cabello</h4>
                    <p>$ 20.000</p>
                    <a href="#" class="button-detail-service">Detalles</a>
                    <a href="#" class="button-appoint">Agendar</a>
                </div>
            </article>


            <article class="article-service">
                <div class="container-img-service">
                    <img src="../../public/assets/cortar-cabello.jpg" alt="image">
                </div>
                <div class="container-content-service">
                    <h4>Corte de cabello</h4>
                    <p>$ 20.000</p>
                    <a href="#" class="button-detail-service">Detalles</a>
                    <a href="#" class="button-appoint">Agendar</a>
                </div>
            </article>


            <article class="article-service">
                <div class="container-img-service">
                    <img src="../../public/assets/cortar-cabello.jpg" alt="image">
                </div>
                <div class="container-content-service">
                    <h4>Corte de cabello</h4>
                    <p>$ 20.000</p>
                    <a href="#" class="button-detail-service">Detalles</a>
                    <a href="#" class="button-appoint">Agendar</a>
                </div>
            </article>


        </section>

    </main>



</body>

</html>