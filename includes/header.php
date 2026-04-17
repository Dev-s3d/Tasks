<?php
include '../config/config.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= clsPath::assets(); ?>css/style.css">
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= clsPath::public(); ?>">Tasks</a>
            <div>
                <?php if ($_SESSION['login'] === "yes") { ?>
                    <a href="<?= clsPath::tasks(); ?>" class="btn btn-outline-primary me-2">Dashboard</a>
                    <a href="<?= clsPath::auth(); ?>logout.php" class="btn btn-danger me-2">Logout</a>
                <?php } else { ?>
                    <a href="<?= clsPath::auth(); ?>login.php" class="btn btn-outline-primary me-2 saad">Login</a>
                    <a href="<?= clsPath::auth(); ?>register.php" class="btn btn-primary">Register</a>
                <?php } ?>
            </div>
        </div>
    </nav>