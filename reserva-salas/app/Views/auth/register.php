<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="text-center mb-4">Crie sua Conta</h2>
            <p class="text-center">Preencha os campos abaixo para se registrar no sistema de reserva de salas.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('/register') ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Confirme a Senha</label>
                    <input type="password" name="password_confirm" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Registrar</button>
            </form>

            <div class="text-center mt-3">
                <a href="<?= base_url('/login') ?>">Já tem uma conta? Faça login aqui</a>
            </div>

        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
