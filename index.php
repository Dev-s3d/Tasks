<?php
include_once './classes/clsPath.php';
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
    <link rel="stylesheet" href="<?= clsPath::assets(); ?>fontawesome/css/all.min.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= clsPath::public(); ?>">Tasks</a>
            <div>
                <?php if ($_SESSION['login'] === "yes") : ?>
                    <a href="<?= clsPath::tasks(); ?>" class="btn btn-outline-primary me-2">Dashboard</a>
                <?php else : ?>
                    <a href="<?= clsPath::auth(); ?>login.php" class="btn btn-outline-primary me-2 saad">Login</a>
                    <a href="<?= clsPath::auth(); ?>register.php" class="btn btn-primary">Register</a>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 text-center bg-white mt-4">
        <div class="container">
            <h1 class="fw-bold mb-3">Manage Your Tasks Smarter</h1>
            <p class="lead text-muted">
                Plan, track, and complete your tasks in one simple and powerful system.
            </p>
            <a href="<?= clsPath::auth(); ?>register.php" class="btn btn-primary btn-lg me-2">Get Started</a>
            <a href="#about" class="btn btn-outline-secondary btn-lg">Learn More</a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">

                <div class="col-md-4 cad">
                    <div class="p-4 bg-white shadow-sm rounded">
                        <i class="fa-solid fa-user-check fa-2x text-primary mb-3"></i>
                        <h5 class="fw-bold">Easy to Use</h5>
                        <p class="text-muted">Simple and user-friendly interface.</p>
                    </div>
                </div>

                <div class="col-md-4 cad">
                    <div class="p-4 bg-white shadow-sm rounded">
                        <i class="fa-solid fa-bolt fa-2x text-primary mb-3"></i>
                        <h5 class="fw-bold">Fast Performance</h5>
                        <p class="text-muted">Quick and smooth experience.</p>
                    </div>
                </div>

                <div class="col-md-4 cad">
                    <div class="p-4 bg-white shadow-sm rounded">
                        <i class="fa-solid fa-shield-halved fa-2x text-primary mb-3"></i>
                        <h5 class="fw-bold">Secure</h5>
                        <p class="text-muted">Your data is safe and protected.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <h2 class="fw-bold">What is Tasks?</h2>
                    <p class="text-muted">
                        Tasks is a smart and simple task management system designed to help you
                        organize your day, track your progress, and stay focused on achieving your goals efficiently.
                    </p>
                    <a href="<?= clsPath::auth(); ?>register.php" class="btn btn-primary">
                        Get Started
                    </a>
                </div>

                <div class="col-md-6 text-center">
                    <img src="<?= clsPath::assets(); ?>img/about.png" class="img-fluid rounded shadow" alt="Tasks App">
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 text-center">
        <div class="container">
            <h3 class="fw-bold mb-3">Start now and be more productive 🚀</h3>
            <a href="<?= clsPath::auth(); ?>register.php" class="btn btn-danger btn-lg">Create Account</a>
        </div>
    </section>

    <section class="py-5 bg-white mb-5">
        <div class="container text-center">
            <div class="row">

                <div class="col-md-4">
                    <h2 class="fw-bold text-primary">+100</h2>
                    <p class="text-muted">Tasks Created</p>
                </div>

                <div class="col-md-4">
                    <h2 class="fw-bold text-primary">+50</h2>
                    <p class="text-muted">Active Users</p>
                </div>

                <div class="col-md-4">
                    <h2 class="fw-bold text-primary">99%</h2>
                    <p class="text-muted">Productivity Boost</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2026 Tasks - All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>