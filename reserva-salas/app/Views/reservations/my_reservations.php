<?= $this->include('templates/header') ?>

<h2 class="mb-4">Minhas Reservas</h2>

<?php if (empty($reservations)): ?>
    <div class="alert alert-warning">
        Você ainda não fez nenhuma reserva.
    </div>
<?php else: ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID da Reserva</th>
                <th>Sala</th>
                <th>Capacidade</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res): ?>
                <tr>
                    <td><?= esc($res['id']) ?></td>
                    <td><?= esc($res['room_name']) ?></td>
                    <td><?= esc($res['room_capacity']) ?> pessoas</td>
                    <td><?= esc($res['date']) ?></td>
                    <td><?= esc($res['start_time']) ?> - <?= esc($res['end_time']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary mt-3">Voltar ao Dashboard</a>

<?= $this->include('templates/footer') ?>
