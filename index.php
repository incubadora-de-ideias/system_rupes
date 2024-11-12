<?php 
    include('./config/estatistica.php');
    include('./base/pagamentos.php');
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

<style>
    .card-title {
        font-size: 1.5rem;
    }

    .card-text {
        font-size: 1.7rem;
    }

    @media (max-width: 768px) {
        /* Ajustes para telas menores */
        .sidebar {
            width: 0;
            position: fixed;
            z-index: 1000;
            transition: width 0.3s ease;
        }

        .sidebar.open {
            width: 250px;
        }

        .main-content {
            margin-left: 0;
            padding: 10px;
        }

        .header-icons {
            display: flex;
            justify-content: space-between;
        }

        .profile-img {
            width: 35px;
            height: 35px;
        }

        .menu-toggle {
            display: block;
            font-size: 1.5rem;
            color: #fff;
            cursor: pointer;
        }

        .menu-toggle.active {
            color: #007bff; /* Cor para quando o menu está aberto */
        }
    }

    @media (min-width: 769px) {
        .sidebar {
            width: 250px;
        }

        .main-content {
            margin-left: 250px;
        }

        .menu-toggle {
            display: none;
        }
    }
</style>

<body>

    <!-- Barra Lateral -->
    <nav class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed" style="height: 100vh; width: 250px; border-radius: 0 15px 15px 0; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="#" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="routes/rupes.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="routes/relatorio.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="routes/vizualizar.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="routes/reports.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="routes/configuracao.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <!-- Menu Hamburguer (ícone de 3 barras) -->
    <div class="menu-toggle d-block d-sm-none" id="menuToggle">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content" style="padding: 30px; background-color: #f4f4f9;">
        <!-- Estatísticas -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card text-white bg-primary mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Indisponíveis</h5>
                        <p class="card-text display-4"><?php echo $indisponivel?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card text-white bg-success mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Disponíveis</h5>
                        <p class="card-text display-4"><?php echo $disponivel?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card text-white bg-warning mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total de Rupes</h5>
                        <p class="card-text display-4"><?php echo $total ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card text-white bg-danger mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Rupes Expirados</h5>
                        <p class="card-text display-4"><?php echo $expirados?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Estatísticas de Rupes -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title">Estatísticas de Rupes</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="statisticsChart" width="600" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Rupes Usados -->
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title">Rupes Usados</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="usedRupesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Rupes Pagos vs Não Pagos -->
            <div class="col-lg-4 col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title">Rupes Pagos vs Não Pagos</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="paidRupesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>

    <!-- Script para o menu hamburguer -->
    <script>
        // Alternar a classe da sidebar (aberta/fechada)
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');
        
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            menuToggle.classList.toggle('active');
        });
    </script>

    <!-- Script para gráficos -->
    <script>
        // Gráfico de Estatísticas de Rupes
        var statsCtx = document.getElementById('statisticsChart').getContext('2d');
        var statisticsChart = new Chart(statsCtx, {
            type: 'bar',
            data: {
                labels: ['Indisponíveis', 'Disponíveis', 'Total', 'Expirados'],
                datasets: [{
                    label: 'Rupes',
                    data: [
                        <?php echo $indisponivel; ?>,
                        <?php echo $disponivel; ?>,
                        <?php echo $total; ?>,
                        <?php echo $expirados; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 
                        'rgba(75, 192, 192, 0.2)', 
                        'rgba(255, 159, 64, 0.2)', 
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 
                        'rgba(75, 192, 192, 1)', 
                        'rgba(255, 159, 64, 1)', 
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 0 // Desativa animação
                },
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

        // Gráfico de Rupes Usados
        var usedRupesCtx = document.getElementById('usedRupesChart').getContext('2d');
        var usedRupesChart = new Chart(usedRupesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Rupes Usados',
                    data: [5, 9, 7, 8, 10, 12], // Dados fictícios, substitua conforme necessário
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 0
                },
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

        // Gráfico de Rupes Pagos vs Não Pagos
        var paidRupesCtx = document.getElementById('paidRupesChart').getContext('2d');
        var paidRupesChart = new Chart(paidRupesCtx, {
            type: 'pie',
            data: {
                labels: ['Pagos', 'Não Pagos'],
                datasets: [{
                    label: 'Status de Pagamento',
                    data: [
                        10, 
                        15 
                    ], 
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)', 
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', 
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 0
                },
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
