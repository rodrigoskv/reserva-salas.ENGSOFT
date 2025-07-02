<?= $this->include('templates/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="text-center mb-4">Bem-vindo ao Sistema de Reservas de Salas</h2>
            <p class="text-center">Faça login para acessar o sistema ou crie uma nova conta se ainda não tiver cadastro.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('/login') ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <div class="text-center mt-3">
                <a href="<?= base_url('/register') ?>">Não tem uma conta? Registre-se aqui</a>
            </div>

        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>
