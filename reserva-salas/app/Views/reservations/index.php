<?= $this->include('templates/header') ?>

<h2 class="mb-4">Lista de Reservas</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- formulario de filtro + ordenaçao -->
<form method="get" action="<?= site_url('reservations') ?>" class="mb-3 row g-3">
    <div class="col-md-2">
        <label for="room_id" class="form-label">Sala:</label>
        <select name="room_id" class="form-select">
            <option value="">Todas</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room['id'] ?>" <?= ($room['id'] == $selectedRoom) ? 'selected' : '' ?>>
                    <?= esc($room['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-2">
        <label for="start_date" class="form-label">De:</label>
        <input type="date" name="start_date" class="form-control" value="<?= esc($startDate) ?>">
    </div>

    <div class="col-md-2">
        <label for="end_date" class="form-label">Até:</label>
        <input type="date" name="end_date" class="form-control" value="<?= esc($endDate) ?>">
    </div>

    <div class="col-md-2">
        <label for="order_by" class="form-label">Ordenar por:</label>
        <select name="order_by" class="form-select">
            <option value="reservations.id" <?= ($orderBy == 'reservations.id') ? 'selected' : '' ?>>ID da Reserva</option>
            <option value="rooms.name" <?= ($orderBy == 'rooms.name') ? 'selected' : '' ?>>Nome da Sala</option>
            <option value="reservations.date" <?= ($orderBy == 'reservations.date') ? 'selected' : '' ?>>Data</option>
            <option value="users.name" <?= ($orderBy == 'users.name') ? 'selected' : '' ?>>Nome do Usuário</option>
        </select>
    </div>

    <div class="col-md-2">
        <label for="order_dir" class="form-label">Ordem:</label>
        <select name="order_dir" class="form-select">
            <option value="ASC" <?= ($orderDir == 'ASC') ? 'selected' : '' ?>>Ascendente</option>
            <option value="DESC" <?= ($orderDir == 'DESC') ? 'selected' : '' ?>>Descendente</option>
        </select>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filtrar / Ordenar</button>
    </div>
</form>

<!-- botão exportar CSV -->
<a href="<?= base_url('/reservations/export-csv') ?>" class="btn btn-outline-primary mb-3">Exportar Reservas (CSV)</a>

<a href="<?= base_url('/reservations/create') ?>" class="btn btn-success mb-3 ms-2">Nova Reserva</a>

<?php if (empty($reservations)): ?>
    <div class="alert alert-warning">
        Nenhuma reserva encontrada para os filtros selecionados.
    </div>
<?php else: ?>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID da Reserva</th>
                <th>ID da Sala</th>
                <th>Nome da Sala</th>
                <th>Capacidade da Sala</th>
                <th>Nome do Usuário</th>
                <th>Data</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reservations as $res): ?>
                <tr>
                    <td><?= esc($res['id']) ?></td>
                    <td><?= esc($res['room_id']) ?></td>
                    <td><?= esc($res['room_name']) ?></td>
                    <td><?= esc($res['room_capacity']) ?> pessoas</td>
                    <td><?= esc($res['user_name']) ?></td>
                    <td><?= esc($res['date']) ?></td>
                    <td><?= esc($res['start_time']) ?> - <?= esc($res['end_time']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?= $this->include('templates/footer') ?>
