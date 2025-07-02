<?= $this->include('templates/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="mb-4 text-center">
                    <?= isset($room) ? 'Editar Sala' : 'Adicionar Nova Sala' ?>
                </h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= isset($room) ? base_url('/rooms/update/'.$room['id']) : base_url('/rooms/store') ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome da Sala</label>
                        <input type="text" name="name" value="<?= isset($room) ? esc($room['name']) : '' ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidade</label>
                        <input type="number" name="capacity" value="<?= isset($room) ? esc($room['capacity']) : '' ?>" class="form-control" required min="1">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Salvar</button>
                </form>

                <div class="mt-3">
                    <a href="<?= base_url('/rooms') ?>" class="btn btn-secondary w-100">Voltar à Lista de Salas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
