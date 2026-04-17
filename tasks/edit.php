<?php
include '../config/config.php';
session_start();

$db = new clsDatabase();
$conn = $db->getConnection();

$alertMsg = [];

// التحقق من id
if (!isset($_GET['id'])) {
    header("Location: " . clsPath::tasks());
    exit;
}

$id = $_GET['id'];

// جلب المهمة
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['id']]);
$task = $stmt->fetch();

if (!$task) {
    header("Location: " . clsPath::tasks());
    exit;
}

// عند الإرسال (التعديل)
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = clsHelper::post('title');
    $description = clsHelper::post('description');
    $status = clsHelper::post('status');

    $stmt = $conn->prepare("
        UPDATE tasks 
        SET title = ?, description = ?, status = ?
        WHERE id = ? AND user_id = ?
    ");

    if ($stmt->execute([$title, $description, $status, $id, $_SESSION['id']])) {
        $alertMsg["success"] = "تم تحديث المهمة بنجاح";

        // تحديث البيانات المعروضة بعد التعديل
        $task['title'] = $title;
        $task['description'] = $description;
        $task['status'] = $status;

    } else {
        $alertMsg["failed"] = "فشل في تحديث المهمة";
    }
}
?>
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold">Edit Task</h2>
        <p class="text-muted">قم بتعديل المهمة الخاصة بك</p>
    </div>

    <?php if (!empty($alertMsg['success'])) : ?>
        <div class="alert alert-success"><?= $alertMsg['success']; ?></div>
    <?php endif ?>

    <?php if (!empty($alertMsg['failed'])) : ?>
        <div class="alert alert-danger"><?= $alertMsg['failed']; ?></div>
    <?php endif ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title"
                           value="<?= htmlspecialchars($task['title']) ?>"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              class="form-control" rows="6" required><?= htmlspecialchars($task['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="done" <?= $task['status'] == 'done' ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= clsPath::tasks() ?>" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Task</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
