<?= $this->include('templates/header') ?>

<h2 class="mb-4">Lista de Salas</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('role') === 'admin'): ?>
    <a href="<?= base_url('/rooms/create') ?>" class="btn btn-success mb-3">Adicionar Nova Sala</a>
<?php endif; ?>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome da Sala</th>
            <th>Capacidade</th>
            <?php if (session()->get('role') === 'admin'): ?>
                <th>Ações</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= $room['id'] ?></td>
                <td><?= $room['name'] ?></td>
                <td><?= $room['capacity'] ?></td>
                <?php if (session()->get('role') === 'admin'): ?>
                    <td>
                        <a href="<?= base_url('/rooms/edit/' . $room['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?= base_url('/rooms/delete/' . $room['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta sala?')">Excluir</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->include('templates/footer') ?>
