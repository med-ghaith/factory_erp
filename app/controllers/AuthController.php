<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matricule = $_POST['matricule'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($matricule, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_matricule'] = $user['matricule'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $this->redirect('/dashboard');
            } else {
                $error = "Invalid credentials";
                $this->view('auth/login', ['error' => $error], false);
            }
        } else {
            $this->view('auth/login', [],false);
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }
}
?>