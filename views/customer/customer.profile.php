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
    <title>Glamour Styles - Profile</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <script defer src="../js/main.js"></script>
</head>

<body>


    <header class="header">
        <a href="./customer.home.php" class="link-logo">
            <img src="../assets/logo.png" alt="Logo" class="logo">
            <h4 class="text-logo">Glamour Styles</h4>
        </a>
        <nav class="navbar">
            <ul class="menu">
                <li>
                    <a href="customer.home.php">Inicio</a>
                </li>
                <li class="current-item-page">
                    <a href="customer.appointments.php">Citas</a>
                </li>
                <li>
                    <a href="customer.bookings.php">Reservas</a>
                </li>
                <li>
                    <a href="#">
                        <article class="card-content">
                            <img class="profile-photo" src="../assets/hermosa-foto.jpg" alt="profile-photo">
                            <p><?php echo $row["names"]?> +</p>
                        </article>
                    </a>
                    <div class="dropdown">
                        <a href="./customer.profile.php" class="profile">
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
                <img src="../assets/hermosa-foto.jpg" alt="photo">
                <h4><?php echo $row["names"] . " " . $row["lastnames"]?></h4>
            </article>
            <div class="card-options">
                <a href="#"><i class="bi bi-pencil-square"></i> Editar datos del perfil</a>
                <a href="#" style="background-color: var(--color-danger);"><i class="bi bi-trash"></i> Eliminar perfil</a>
            </div>
        </section>

    </main>



</body>

</html>