<?php

include '../config/config.php';

session_start();
$path = clsPath::tasks();

if ($_SESSION['login'] == "yes") {
    header("Location: {$path}");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = clsHelper::post('email');
    $password = clsHelper::post('password');

    $loadUser = new clsUser();
    if ($loadUser->LoadByEmail($email)) {
        if ($loadUser != null && password_verify($password, $loadUser->Password)) {
            $_SESSION['login'] = 'yes';
            $_SESSION['id'] = $loadUser->IDuser;
            $_SESSION['name'] = $loadUser->Name;
            $_SESSION['email'] = $loadUser->Email;
            $_SESSION['password'] = $loadUser->Password;
            $_SESSION['createdAt'] = $loadUser->createdAt;
            header("Location: {$path}");
            exit;
        } else {
            $errors[] = "Incorrect password";
        }
    } else {
        $errors[] = "Invalid email address";
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
    <div class="card">
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label for="InputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="InputEmail" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck">
                    <label class="form-check-label" for="exampleCheck">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>




<?php
include '../includes/footer.php';