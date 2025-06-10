<?php
if (!isset($title)) $title = 'Dashboard';
if (!isset($user)) $user = ['name' => 'User'];

function activeClass($segment) {
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return strpos($currentPath, $segment) !== false ? 'active' : '';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - Production Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
        }
        .main-content {
            padding: 20px;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('dashboard') ?>">Production Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?= htmlspecialchars($user['name']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('dashboard') ?>" href="<?= base_url('dashboard') ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('machines') ?>" href="<?= base_url('machines') ?>">
                        <i class="bi bi-gear"></i> Machines
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('stock') ?>" href="<?= base_url('stock') ?>">
                        <i class="bi bi-box"></i> Stock
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('planning') ?>" href="<?= base_url('planning') ?>">
                        <i class="bi bi-calendar"></i> Planning
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('staff') ?>" href="<?= base_url('staff') ?>">
                        <i class="bi bi-people"></i> Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('history') ?>" href="<?= base_url('history') ?>">
                        <i class="bi bi-clock-history"></i> History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeClass('report') ?>" href="<?= base_url('report') ?>">
                        <i class="bi bi-file-text"></i> Report
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-lg-10 main-content">
