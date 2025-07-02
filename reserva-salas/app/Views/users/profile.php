<?= $this->include('templates/header') ?>

<h2 class="mb-4">Meu Perfil</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Nome:</strong> <?= esc($user['name']) ?></p>
        <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
        <p><strong>Permissões:</strong> <?= esc($user['role']) === 'admin' ? 'Administrador' : 'Usuário' ?></p>
    </div>
</div>

<a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary mt-3">Voltar ao Dashboard</a>

<?= $this->include('templates/footer') ?>
