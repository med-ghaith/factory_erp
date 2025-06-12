<?php
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/DashboardController.php';
require_once __DIR__ . '/app/controllers/MachinesController.php';
require_once __DIR__ . '/app/controllers/StaffController.php';
require_once __DIR__ . '/app/controllers/HistoryController.php';
require_once __DIR__ . '/app/controllers/ReviewController.php';
require_once __DIR__ . '/app/controllers/PlanningController.php';
require_once __DIR__ . '/app/controllers/StockController.php';

session_start();
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Parse the URL
$request = $_SERVER['REQUEST_URI'];
if ($request === '/' || $request === '/index.php') {
    if (isLoggedIn()) {
        header('Location: /dashboard');
    } else {
        header('Location: /login');
    }
    exit;
}
$base_path = '/';
$request_path = parse_url($request, PHP_URL_PATH);
$route = ltrim($request_path, '/');

// Simple routing
$parts = explode('/', $route);
$controller_name = $parts[0] ?? 'dashboard';
$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

// Map URL to controllers
switch ($controller_name) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'dashboard':
        $controller = new DashboardController();
        if ($action === 'statistics') {
            $controller->statistics();
        } else {
            $controller->index();
        }
        break;
    case 'machines':
        $controller = new MachinesController();
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($param)) {  // Added edit route
            $controller->edit($param);
        } elseif ($action === 'update-status' && isset($param)) {
            $controller->updateStatus($param);
        } elseif ($action === 'delete' && isset($param)) {
            $controller->delete($param);
        } else {
            $controller->index();
        }
        break;
    case 'staff':
        $controller = new StaffController();
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'assign' && isset($param)) {
            $controller->assignPlanning($param);
        } elseif ($action === 'edit' && isset($param)) {
            $controller->create($param);
        }  else {
            $controller->index();
        }
        break;
    case 'history':
        $controller = new HistoryController();
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'complete' && isset($param)) {
            $controller->complete($param);
        } else {
            $controller->index();
        }
        break;
    
    case 'planning':
        $controller = new PlanningController();
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($param)) {
            $controller->edit($param);
        } elseif ($action === 'delete' && isset($param)) {
            $controller->delete($param);
        } elseif ($action === 'current') {
            $controller->current();
        } else {
            $controller->index();
        }
        break;
    case 'stock':
        $controller = new StockController();
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($param)) {
            $controller->edit($param);
        } elseif ($action === 'update-quantity' && isset($param)) {
            $controller->updateQuantity($param);
        } elseif ($action === 'delete' && isset($param)) {
            $controller->delete($param);
        } elseif ($action === 'by-machine' && isset($param)) {
            $controller->byMachine($param);
        } else {
            $controller->index();
        }
        break;
        case 'reviews':
            $controller = new ReviewController();
            if ($action === 'select-history') {
                $controller->selectHistory();
            } elseif ($action === 'create' && isset($param)) {
                $controller->create($param);
            } elseif ($action === 'view' && isset($param)) {
                $controller->viewReview($param);
            } else {
                $controller->index();
            }
            break;
            
    default:
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        break;
}
?>