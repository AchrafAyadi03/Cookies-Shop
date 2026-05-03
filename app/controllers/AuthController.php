<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once(__DIR__ . '/../models/User.php');

class AuthController {

    public static function isLoggedIn() {
        return isset($_SESSION['user']) && !empty($_SESSION['user']['id']);
    }

    public static function isAdmin() {
        return self::isLoggedIn() && $_SESSION['user']['role'] === 'admin';
    }

    public static function requireLogin($redirect = null) {
        if (!self::isLoggedIn()) {
            $url = '/Cookies-Shop/app/views/auth/login.php';
            if ($redirect) $url .= '?redirect=' . urlencode($redirect);
            header('Location: ' . $url);
            exit;
        }
    }

    public static function requireAdmin() {
        self::requireLogin();
        if (!self::isAdmin()) {
            header('Location: /Cookies-Shop/index.php');
            exit;
        }
    }

    public function login() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $redirect = $_POST['redirect'] ?? '';

            $user = (new User())->verifyLogin($email, $password);
            if ($user) {
                $_SESSION['user'] = [
                    'id'     => (int)$user['id'],
                    'nom'    => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email'  => $user['email'],
                    'role'   => $user['role'],
                ];

                if ($user['role'] === 'admin') {
                    header('Location: /Cookies-Shop/app/views/admin/dashboard.php');
                } elseif ($redirect === 'cart') {
                    header('Location: /Cookies-Shop/app/views/products/cart.php');
                } else {
                    header('Location: /Cookies-Shop/index.php');
                }
                exit;
            }
            $error = 'Email ou mot de passe incorrect';
        }
        return $error;
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        header('Location: /Cookies-Shop/index.php');
        exit;
    }
}

if (basename($_SERVER['SCRIPT_FILENAME']) === 'AuthController.php') {
    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    $ctrl = new AuthController();
    if ($action === 'logout') {
        $ctrl->logout();
    }
}
?>
