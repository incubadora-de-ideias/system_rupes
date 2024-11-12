<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Rupes</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/plugins.min.css">
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Barra Lateral -->
    <nav id="sidebar" class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed d-none d-md-block"
        style="height: 100vh; width: 250px; border-radius: 0 15px 15px 0; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="../index.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="./rupes.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="#" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="./vizualizar.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="./reports.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="./configuracao.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <!-- Botão de Menu Hambúrguer (visível em telas pequenas) -->
    <button id="menu-toggle" class="navbar-toggler d-md-none position-fixed" type="button" data-toggle="collapse" data-target="#sidebar"
        aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation" style="top: 20px; left: 20px; z-index: 1050;">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Conteúdo Principal -->
    <div id="content-wrapper" class="main-content" style="margin-left: 250px; padding: 30px; background-color: #f4f4f9; height: 100vh;">
        <div class="container mt-5">
            <h1 class="text-center mb-4"><i class="fas fa-upload"></i> Importação de Relatório</h1>
            
            <form action="../services/importarRelatorio.php" method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                <div class="mb-3">
                    <label for="arquivo" class="form-label">Escolha o arquivo CSV:</label>
                    <input type="file" class="form-control" name="arquivo" id="arquivo" accept=".csv" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
            <p class="text-center text-danger mt-3">* Por favor, selecione um arquivo CSV.</p>
        </div>
    </div>

    <!-- JS Files -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/js/kaiadmin.min.js"></script>
    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>

    <!-- Script para controlar o menu hambúrguer -->
    <script>
        // Mostrar e esconder a barra lateral ao clicar no menu hambúrguer
        document.getElementById("menu-toggle").addEventListener("click", function () {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("d-none");  // Alterna entre esconder e mostrar a barra lateral
        });
    </script>
</body>
</html>
