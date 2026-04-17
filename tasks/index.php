<?php
include '../config/config.php';
session_start();
$tasks = clsTask::getAllByUserId($_SESSION['id']);
?>

<div class="container py-5">

    <!-- العنوان -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Tasks</h2>
        <a href="<?= clsPath::tasks(); ?>create.php" class="btn btn-primary">+ Add Task</a>
    </div>

    <!-- في حالة وجود مهام -->

    <?php if (!empty($tasks)) : ?>
        <div class="row g-4">
            <?php foreach ($tasks as $task) : ?>
                <!-- Task Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold"><?php echo htmlspecialchars($task['title']); ?></h5>
                            <p class="text-muted small">
                                <?php echo htmlspecialchars($task['description']); ?>
                            </p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <?php if ($task['status'] == "pending"): ?>
                                    <span class="badge bg-secondary py-2">pending</span>
                                <?php else: ?>
                                    <span class="badge bg-success py-2">Done</span>
                                <?php endif ?>
                                <div>
                                    <a href="<?= clsPath::tasks(); ?>edit.php?id=<?= $task['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                    <form action="<?= clsPath::tasks(); ?>delete.php" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف المهمة؟');">
                                        <input type="hidden" name="delete_id" value="<?= $task['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <hr>
                                <p class="text-secondary"><?= $task['created_at'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <!-- في حالة عدم وجود مهام -->
        <div class="row">
            <div class="col-12 text-center mt-3">
                <div class="bg-white p-5 rounded shadow-sm ">
                    <h4 class="fw-bold mb-3">No Tasks Yet 😴</h4>
                    <p class="text-muted">ابدأ بإضافة أول مهمة لك الآن</p>
                    <a href="<?= clsPath::tasks(); ?>create.php" class="btn btn-primary">Create Task</a>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>


<?php


include '../includes/footer.php';
