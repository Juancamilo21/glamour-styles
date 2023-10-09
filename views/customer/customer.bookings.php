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
    <title>Glamour Styles - Bookings</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/tables.css">
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
                <li class="current-item-page">
                    <a href="customer.bookings.php" class="current-page">Reservas</a>
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

        <section class="section-table">
            <div class="container-table">
                <div class="box-info-tabla">
                    <h4>Citas Reservadas</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Eventos</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>2023-09-28</td>
                            <td>09:30:00 hasta 18:00:00</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>

    </main>




</body>

</html>