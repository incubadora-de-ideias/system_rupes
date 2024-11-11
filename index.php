<?php 
    include('./config/estatistica.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css">
    <link rel="stylesheet" href="assets/css/demo.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Barra Lateral -->
    <nav class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed" style="height: 100vh; width: 250px;">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="#" class="text-white py-2 d-block"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="routes/rupes.php" class="text-white py-2 d-block"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="routes/relatorio.php" class="text-white py-2 d-block"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="routes/vizualizar.php" class="text-white py-2 d-block"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="routes/reports.php" class="text-white py-2 d-block"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="routes/configuracao.php" class="text-white py-2 d-block"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="main-content" style="margin-left: 250px; padding: 30px; background-color: #f4f4f9;">
        
        <!-- Cabeçalho -->
        <header class="mb-4">
            <div class="header-icons">
                <i class="fas fa-bell mr-3"></i> <!-- Ícone de notificação -->
                <i class="fas fa-cogs mr-3"></i> <!-- Ícone de configurações -->
                <img src="assets/img/profile.jpg" alt="Foto de Perfil" class="profile-img" style="width: 40px; height: 40px; border-radius: 50%;">
            </div>
        </header>

        <!-- Estatísticas -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-primary mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Indisponíveis</h5>
                        <p class="card-text display-4"><?php echo $indisponivel?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-success mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Disponíveis</h5>
                        <p class="card-text display-4"><?php echo $disponivel?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-warning mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total de Rupes</h5>
                        <p class="card-text display-4"><?php echo $total ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-white bg-danger mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Expirados</h5>
                        <p class="card-text display-4"><?php echo $expirados?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Vendas -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title">Gráfico de Vendas</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Erros -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title">Gráfico de Erros</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="errorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>

    <!-- Script de gráficos -->
    <script>
        var salesCtx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Vendas',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });

        var errorCtx = document.getElementById('errorChart').getContext('2d');
        var errorChart = new Chart(errorCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Erros no Sistema',
                    data: [3, 6, 2, 4, 5, 7],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
    </script>

</body>
</html>
