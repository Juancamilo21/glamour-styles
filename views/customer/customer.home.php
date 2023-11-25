<?php include_once(__DIR__ . "/../../controllers/user.controller.php");

$userController = new UserController();
$userController->header();

$response = $userController->findById();
$row = array();
if ($response) {
    $row = $response->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glamour Styles - Home</title>
    <link rel="shortcut icon" href="../../public/assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/footer.css">
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
                    <a href="customer.appointments.php">Calendario</a>
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
        <section class="section-service" id="section-service"></section>
    </main>

    <footer class="footer">
        <div class="box-footer-logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </div>
        <div class="box-footer-info">
            <p>&copy; Derechos reservados - 2023</p>
        </div>
        <div class="box-footer-media">
            <a href="https://Wa.me/+573022294543" target="_blank"><i class="bi bi-whatsapp"></i></a>
            <a href="https://www.facebook.com/?locale=es_LA" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/es/" target="_blank"><i class="bi bi-tiktok"></i></a>
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/alerts.js"></script>
    <script src="../../public/js/format.js"></script>
    <script src="../../public/js/customer/home.js"></script>

</body>

</html>