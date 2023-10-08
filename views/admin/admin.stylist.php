<?php include(__DIR__ . "/../../controllers/admin.controller.php");

    $adminController = new AdminController();
    $adminController->header();
    $row = $adminController->findById();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Stylists</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/tables.css">
    <script defer src="../../public/js/main.js"></script>
</head>

<body>


    <header class="header">
        <a href="./admin.service.php" class="link-logo">
            <img src="../../public/assets/logo.png" alt="Logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </a>
        <nav class="navbar">
            <ul class="menu">
                <li class="current-item-page">
                    <a href="admin.services.php">Inicio</a>
                </li>
                <li>
                    <a href="admin.stylist.php" class="current-page">Estilistas</a>
                </li>
                <li>
                    <a href="admin.customers.php">Cientes</a>
                </li>
                <li>
                    <a href="admin.admin.php">Administradores</a>
                </li>
                <li>
                    <a href="#">
                        <article class="card-content">
                            <img class="profile-photo" src="../../public/assets/hermosa-foto.jpg" alt="profile-photo">
                            <p><?php echo $row["names"] ?> +</p>
                        </article>
                    </a>
                    <div class="dropdown">
                        <a href="admin.profile.php">
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
                    <h4>Servicios</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Eventos</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Definicion de cejas</td>
                            <td>Lorem ipsum dolor sit amet consectetur</td>
                            <td>$ 30.000</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>Lorem ipsum dolor sit amet consectetur</td>
                            <td>$ 30.000</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>Lorem ipsum dolor sit amet consectetur</td>
                            <td>$ 30.000</td>
                            <td>
                                <a href="#" style="color: var(--color-secondary);"><i class="bi bi-eye-fill"></i></a>
                                <a href="#"><i class="bi bi-x-octagon-fill"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>Definicion de cejas</td>
                            <td>Lorem ipsum dolor sit amet consectetur</td>
                            <td>$ 30.000</td>
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