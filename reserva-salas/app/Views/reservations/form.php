<?= $this->include('templates/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="mb-4 text-center">Criar Nova Reserva</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('/reservations/store') ?>">
                    <div class="mb-3">
                        <label for="date" class="form-label">Data:</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="start_time" class="form-label">Hora de Início:</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_time" class="form-label">Hora de Término:</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Sala:</label>
                        <select name="room_id" class="form-select" required>
                            <?php foreach($rooms as $room): ?>
                                <option value="<?= $room['id'] ?>"><?= esc($room['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Reservar</button>
                </form>

                <div class="mt-3">
                    <a href="<?= base_url('/reservations') ?>" class="btn btn-secondary w-100">Voltar à Lista de Reservas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
