<?php
class Controller {
    public function __construct() {
        // Ensure session is available to all controllers
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . '/../helpers/helper.php';
    }
    protected function view($view, $data = [], $useLayout = true) {
        extract($data); 
        if ($useLayout) {
            require_once __DIR__ . '/../views/templates/header.php';
        }
        require_once __DIR__ . '/../views/' . $view . '.php';

        if ($useLayout) {
            require_once __DIR__ . '/../views/templates/footer.php';
        }
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    protected function requireAdmin() {
        $this->requireLogin();
        if (!$this->isAdmin()) {
            $this->redirect('/');
        }
    }
}
?>