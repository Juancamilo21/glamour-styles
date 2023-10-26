<?php include_once(__DIR__ . "/../../controllers/user.controller.php");
    
    $userController = new UserController();
    $userController->header();
    
    $response = $userController->findById();
    $row = array();
    if($response) {
        $row = $response->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Customers</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/tables.css">
    <link rel="stylesheet" href="../../public/styles/sweet.alert.css">
    <script defer src="../../public/js/main.js"></script>
</head>

<body>


    <header class="header">
        <a href="./admin.home.php" class="link-logo">
            <img src="../../public/assets/logo.png" alt="Logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </a>
        <nav class="navbar">
            <ul class="menu">
                <li>
                    <a href="admin.home.php">Inicio</a>
                </li>
                <li>
                    <a href="admin.services.php">Servicios</a>
                </li>
                <li>
                    <a href="admin.stylist.php">Estilistas</a>
                </li>
                <li class="current-item-page">
                    <a href="admin.customers.php" class="current-page">Cientes</a>
                </li>
                <li>
                    <a href="admin.admin.php">Admins</a>
                </li>
                <li>
                    <a href="#">
                        <article class="card-content">
                        <img class="profile-photo" src="../../upload/default.png" alt="profile-photo">
                            <p> 
                                <?php 
                                    if (isset($row["names"])) {
                                        echo $row["names"];
                                    }
                                ?> 
                                +
                            </p>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Edad</th>
                            <th>Email</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>

                    <tbody id="tbody"></tbody>
                </table>
            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/admin/user.js"></script>
    <script src="../../public/js/admin/customer.js"></script>

</body>

</html>