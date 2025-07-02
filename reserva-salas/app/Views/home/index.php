<?= $this->include('templates/header') ?>

<div class="text-center mt-5">
    <h1 class="mb-3">Sistema de Reservas de Salas</h1>
    <p class="mb-4">Gerencie suas salas e mantenha o controle das reservas de forma rápida e eficiente.</p>

    <div class="d-flex justify-content-center gap-3">
        <a href="<?= base_url('/login') ?>" class="btn btn-primary">Login</a>
        <a href="<?= base_url('/register') ?>" class="btn btn-success">Criar Conta</a>
    </div>
</div>

<?= $this->include('templates/footer') ?>
