<?= $this->include('templates/header') ?>

<h2 class="mb-4">Relatório: Total de Reservas por Sala</h2>

<!-- Filtros por Data -->
<form method="get" action="<?= site_url('reports') ?>" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="start_date" class="form-label">Data Inicial:</label>
        <input type="date" name="start_date" class="form-control" value="<?= esc($startDate) ?>">
    </div>
    <div class="col-md-3">
        <label for="end_date" class="form-label">Data Final:</label>
        <input type="date" name="end_date" class="form-control" value="<?= esc($endDate) ?>">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>

<?php if (empty($report)): ?>
    <div class="alert alert-warning">
        Nenhuma reserva encontrada para o período selecionado.
    </div>
<?php else: ?>

    <!-- Botões de Exportação -->
    <div class="mb-4">
        <a href="<?= base_url('/reports/export-csv') ?>?start_date=<?= esc($startDate) ?>&end_date=<?= esc($endDate) ?>" class="btn btn-outline-primary me-2">Exportar CSV</a>
        <a href="<?= base_url('/reports/export-pdf') ?>?start_date=<?= esc($startDate) ?>&end_date=<?= esc($endDate) ?>" class="btn btn-outline-danger">Exportar PDF</a>
    </div>

    <!-- Seletor de gráfico -->
    <div class="mb-4">
        <label for="chartType" class="form-label">Escolha o tipo de gráfico:</label>
        <select id="chartType" class="form-select" onchange="updateChartDisplay()">
            <option value="both" selected>Ambos</option>
            <option value="bar">Gráfico de Barras</option>
            <option value="pie">Gráfico de Pizza</option>
        </select>
    </div>

    <!-- Gráficos com tamanho reduzido -->
    <div id="barContainer">
        <h4>Gráfico de Barras</h4>
        <canvas id="barChart" width="300" height="150"></canvas>
    </div>

    <div id="pieContainer" class="mt-5">
        <h4>Gráfico de Pizza</h4>
        <canvas id="pieChart" width="300" height="150"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const roomNames = <?= json_encode(array_column($report, 'room_name')) ?>;
        const reservationCounts = <?= json_encode(array_column($report, 'total_reservas')) ?>;

        // Gráfico de Barras
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: roomNames,
                datasets: [{
                    label: 'Total de Reservas por Sala',
                    data: reservationCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                aspectRatio: 2,  // Faz o gráfico ficar mais "largo e baixo"
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });

        // Gráfico de Pizza
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: roomNames,
                datasets: [{
                    label: 'Total de Reservas por Sala',
                    data: reservationCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                aspectRatio: 2,  // Faz a pizza ficar menor e menos "estourada"
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Controle de exibição
        function updateChartDisplay() {
            const selected = document.getElementById('chartType').value;
            document.getElementById('barContainer').style.display = (selected === 'bar' || selected === 'both') ? 'block' : 'none';
            document.getElementById('pieContainer').style.display = (selected === 'pie' || selected === 'both') ? 'block' : 'none';
        }
        updateChartDisplay();
    </script>

<?php endif; ?>

<a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary mt-4">Voltar ao Dashboard</a>

<?= $this->include('templates/footer') ?>
