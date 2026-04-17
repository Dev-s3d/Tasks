<?php

include '../config/config.php';

session_start();
$path = clsPath::tasks();

if ($_SESSION['login'] == "yes") {
    header("Location: {$path}");
    exit;
}


$user = new clsUser();
$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = clsHelper::post('name');
    $email = clsHelper::post('email');
    $password = clsHelper::post('password');
    $confirmPassword = clsHelper::post('confirmPassword');

    // validation
    if (!clsHelper::minLength($name, 3)) {
        $errors[] = "The name is very short";
    }
    if (!clsHelper::email($email)) {
        $errors[] = "Invalid email format";
    }
    if (!clsHelper::minLength($password, 5) && !clsHelper::minLength($confirmPassword, 5)) {
        $errors[] = "The password has too few characters; you must enter more than 4.";
    }
    if (!clsHelper::match($password, $confirmPassword)) {
        $errors[] = "Passwords do not match";
    }

    // check DB only if no errors
    if (empty($errors)) {

        if ($user->findByEmail($email)) {
            $errors[] = "Email already exists";
        } else {

            if ($user->register($name, $email, $password)) {
                $success = "User registered successfully";
            }
        }
    }
}
?>


<div class="container mt-5">
    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $alert) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> <?php echo htmlspecialchars($alert); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>successfully!</strong> <?php echo htmlspecialchars($success); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>


    <div class="card">
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label for="InputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="InputName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" name="email" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="InputConfirmPassword" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="InputConfirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php


include '../includes/footer.php';
