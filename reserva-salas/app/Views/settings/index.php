<?= $this->include('templates/header') ?>

<div class="mt-5">
    <h2 class="mb-4">Sobre o Sistema</h2>

    <p><strong>Nome do Sistema:</strong> Room Reservation System</p>
    <p><strong>Versão:</strong> 1.0</p>
    <p><strong>Desenvolvido por:</strong> Rodrigo Miguel, Leonardo Costa e Leandro Bertocchi</p>
    <p><strong>Descrição:</strong> Sistema de gerenciamento de reservas de salas, desenvolvido em PHP com o framework CodeIgniter 4.</p>

    <h4 class="mt-4">Tecnologias Utilizadas:</h4>
    <ul>
        <li>PHP 8.x</li>
        <li>CodeIgniter 4</li>
        <li>MySQL</li>
        <li>Bootstrap 5</li>
        <li>Chart.js (para gráficos)</li>
        <li>Dompdf (para exportação de PDF)</li>
        <li>HTML5 & CSS3</li>
    </ul>

    <h4 class="mt-4">Funcionalidades Incluídas:</h4>
    <ul>
        <li>Login e Registro de Usuários</li>
        <li>Gerenciamento de Salas</li>
        <li>Gerenciamento de Reservas com Filtros, Ordenação e Exportações (CSV/PDF)</li>
        <li>Relatórios Gráficos (Barras e Pizza)</li>
        <li>Histórico de Reservas por Usuário</li>
        <li>Perfil de Usuário</li>
        <li>Página Sobre o Sistema</li>
    </ul>

    <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary mt-3">Voltar ao Dashboard</a>
</div>

<?= $this->include('templates/footer') ?>
