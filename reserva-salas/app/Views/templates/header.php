<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ProjetoDosMacacos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= session()->get('user_id') ? base_url('/dashboard') : base_url('/') ?>">Sistema Reservas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (session()->get('user_id')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/rooms') ?>">Salas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/reservations') ?>">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/my-reservations') ?>">Minhas Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/profile') ?>">Meu Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= base_url('/logout') ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/register') ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
