<?php
include 'classes/clsDatabase.php';

class clsUser
{

    public $IDuser;
    public $Name;
    public $Email;
    public $Password;
    public $createdAt;

    private $conn;

    public function __construct()
    {
        $db = new clsDatabase();
        $conn = $db->getConnection();
        $this->conn = $conn;
    }

    public function LoadByEmail($email)
    {
        // نجيب كل الأعمدة بدل email فقط
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        // جلب صف واحد
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // إذا وجد المستخدم
        if ($row) {

            // تعبئة خصائص الكلاس (Object)
            $this->IDuser    = $row['id'];
            $this->Name      = $row['name'];
            $this->Email     = $row['email'];
            $this->Password  = $row['password'];
            $this->createdAt = $row['created_at']; // تأكد من اسم العمود

            return true; // تم التحميل بنجاح
        }

        // إذا لم يتم العثور على المستخدم
        return false;
    }
    // check email exists
    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    // register user
    public function register($name, $email, $password)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("
            INSERT INTO users (name, email, password)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([$name, $email, $hashed]);
    }
}
