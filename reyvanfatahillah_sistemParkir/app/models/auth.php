<?php
class auth {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function auth($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return false;
        } return $user;
    }
}
?>