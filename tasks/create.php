<?php
include '../config/config.php';
session_start();

$alertMsg = [];
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['login'] == 'yes') {

    $title = clsHelper::post('title');
    $description = clsHelper::post('description');
    $status = clsHelper::post('status');
    $NewTask = new clsTask($_SESSION['id'], $title, $description, $status);

    if ($NewTask->addNew() != null) {
        $alertMsg["success"] = "A task was successfully added";
    } else {
        $alertMsg["Failed"] = "Failed to insert task";
    }
}


?>


<div class="container py-5">


    <div class="mb-4">
        <h2 class="fw-bold">Add New Task</h2>
        <p class="text-muted">أضف مهمة جديدة ونظّم وقتك بشكل أفضل</p>
    </div>


    <?php if (!empty($alertMsg) && $alertMsg['success']) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $alertMsg['success']; ?>
        </div>
    <?php endif ?>

    <?php if (!empty($alertMsg) && $alertMsg['Failed']) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $alertMsg['Failed']; ?>
        </div>
    <?php endif ?>


    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter task title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="8" placeholder="Enter task description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= clsPath::tasks()?>" class="btn btn-outline-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php


include '../includes/footer.php';
