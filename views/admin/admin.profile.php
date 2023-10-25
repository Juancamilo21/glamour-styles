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
    <title>Glamour Styles - Profile</title>
    <link rel="stylesheet" href="../../public/styles/main.css">
    <link rel="stylesheet" href="../../public/styles/header.css">
    <link rel="stylesheet" href="../../public/styles/profile.css">
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
                <li>
                    <a href="admin.home.php">Inicio</a>
                </li>
                <li>
                    <a href="admin.services.php">Servicios</a>
                </li>
                <li>
                    <a href="admin.stylist.php">Estilistas</a>
                </li>
                <li>
                    <a href="admin.customers.php">Cientes</a>
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

        <section class="section-profile">
            <article class="card-info">
                <img src="../../upload/default.png" alt="photo">
                <h4><?php
                    if (isset($row["names"]) && isset($row["lastnames"])) {
                        echo $row["names"] . " " . $row["lastnames"];
                    }
                
                ?></h4>
                <p style="font-size: var(--font-size-menu); margin-top: 1rem;">
                    <?php
                        if (isset($_SESSION["rol"])) {
                            echo "(".$_SESSION["rol"].")";
                        }
                    ?>
                </p>
            </article>
            <div class="card-options">
                <a href="#"><i class="bi bi-pencil-fill"></i> Editar datos del perfil</a>
                <a href="../../controllers/logOut.php" style="background-color: var(--color-danger);"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
            </div>
        </section>

    </main>



</body>

</html>