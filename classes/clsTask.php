<?php
include 'classes/clsDatabase.php';

class clsTask
{
    public $IDtask;
    public $user_id;
    public $title;
    public $description;
    public $status;
    public $created_at;

    private $conn;

    public function __construct($user_id, $title, $description, $status)
    {
        $db = new clsDatabase();
        $this->conn = $db->getConnection();

        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function addNew()
    {
        $stmt = $this->conn->prepare("
            INSERT INTO tasks (user_id, title, description, status, created_at)
            VALUES (?, ?, ?, ?, ?)
        ");

        if (
            $stmt->execute([
                $this->user_id,
                $this->title,
                $this->description,
                $this->status,
                $this->created_at
            ])
        ) {
            $this->IDtask = $this->conn->lastInsertId();
            return $this;
        }

        return null;
    }

    public static function getAllByUserId($user_id)
    {
        $db = new clsDatabase();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
        SELECT * FROM tasks 
        WHERE user_id = ?
        ORDER BY id DESC
    ");

        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getByTaskId($TaskId)
    {
        $db = new clsDatabase();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("
        SELECT * FROM tasks 
        WHERE id = ?
    ");

        $stmt->execute([$TaskId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
