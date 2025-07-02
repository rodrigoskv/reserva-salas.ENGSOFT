<?= $this->include('templates/header') ?>

<div class="text-center mt-5">
    <h1 class="mb-3">Dashboard</h1>
    <p class="mb-4">Aqui você pode gerenciar salas, reservas e visualizar relatórios do sistema.</p>

    <!-- Botões principais (Rotas) - Agora no topo e na horizontal -->
    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
        <a href="<?= base_url('/rooms') ?>" class="btn btn-outline-primary">Gerenciar Salas</a>
        <a href="<?= base_url('/reservations') ?>" class="btn btn-outline-success">Ver Reservas</a>
        <a href="<?= base_url('/reports') ?>" class="btn btn-outline-warning">Ver Relatórios</a>
        <a href="<?= base_url('/settings') ?>" class="btn btn-outline-dark">Sobre o Sistema</a>
        <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger">Sair</a>
    </div>

    <!-- Contadores -->
    <div class="row justify-content-center mb-4">
        <div class="col-6 col-md-3 mb-3">
            <div class="alert alert-primary">
                <strong><?= esc($totalRooms) ?></strong><br> Salas Cadastradas
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="alert alert-success">
                <strong><?= esc($totalUsers) ?></strong><br> Usuários Registrados
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="alert alert-warning">
                <strong><?= esc($totalReservations) ?></strong><br> Total de Reservas
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="alert alert-info">
                <strong><?= esc($userReservations) ?></strong><br> Suas Reservas
            </div>
        </div>
    </div>

    <!-- Atalhos Rápidos -->
    <h4 class="mt-4">Atalhos Rápidos:</h4>
    <div class="d-grid gap-2 col-12 col-md-6 mx-auto mb-4">
        <a href="<?= base_url('/reservations?start_date=' . date('Y-m-d') . '&end_date=' . date('Y-m-d')) ?>" class="btn btn-outline-secondary">Reservas de Hoje</a>
        <a href="<?= base_url('/my-reservations') ?>" class="btn btn-outline-secondary">Minhas Reservas Futuras</a>
        <a href="<?= base_url('/rooms') ?>" class="btn btn-outline-secondary">Salas Sem Reservas Futuras</a>
    </div>

    <!-- Próximas Reservas -->
    <h4 class="mt-4">Próximas 5 Reservas Agendadas:</h4>
    <?php if (empty($upcomingReservations)): ?>
        <p>Nenhuma reserva futura encontrada.</p>
    <?php else: ?>
        <ul class="list-group mb-4">
            <?php foreach ($upcomingReservations as $res): ?>
                <li class="list-group-item">
                    <strong><?= esc($res['room_name']) ?></strong> - <?= esc($res['date']) ?> <?= esc($res['start_time']) ?> - <?= esc($res['end_time']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>
