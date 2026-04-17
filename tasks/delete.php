<?php

include '../config/config.php';
session_start();

// حذف tasks
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_id'])) {

    $id = $_POST['delete_id'];

    $db = new clsDatabase();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['id']]);

    // إعادة تحميل الصفحة
    $path = clsPath::tasks();
    header("Location: " . $path);
    exit;
}
