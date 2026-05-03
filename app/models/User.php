<?php
require_once(__DIR__ . '/Database.php');

class User {

    private function db() {
        $cnx = new connexion();
        return $cnx->CNXbase();
    }

    public function findByEmail($email) {
        $db = $this->db();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyLogin($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return false;
    }
}
?>
