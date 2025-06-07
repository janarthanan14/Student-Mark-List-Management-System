<?php include './db/db_connection.php'; ?>

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/responsive.css">

    <link rel="stylesheet" href="./assets/style/css-pro-layout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css">
    <!-- <link rel="stylesheet" href="./assets/style/remixicon.css"> -->
    <link rel="stylesheet" href="./assets/style/jquery.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./ajax/ajax.js"></script>
</head>

<body>
    <!-- Main Code -->

    <div class="layout has-sidebar fixed-sidebar fixed-header">

        <?php include './templates/side-bar.php'; ?>

        <div id="overlay" class="overlay"></div>

        <div class="layout">

            <header class="header">
                <a id="btn-toggle" class="sidebar-toggler break-point-lg">
                    <i class="ri-menu-line ri-xl"></i>
                </a>

                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav header-content">
                            <li class="">
                                <a href="#" class="notify-btn swing-icon"><img src="./assets/icon/header/notification-icon.svg" alt="notify-btn"></a>
                            </li>
                            <li class="dropdown userWrapper">
                                <a class="dropdown-toggle profile-btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./assets/icon/header/profile-icon.svg" alt="user-icon"><?= $_SESSION['name'] ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>