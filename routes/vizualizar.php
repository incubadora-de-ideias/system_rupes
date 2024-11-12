<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Dados</title>
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ["../assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <!-- Barra Lateral -->
    <nav class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed" style="height: 100vh; width: 250px; border-radius: 0 15px 15px 0; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="../index.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="./rupes.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="./relatorio.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="#" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="./reports.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="./configuracao.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="main-panel" style="margin-left: 250px; margin-right: 0;">
        <div class="content">
            <div class="container-fluid">
                <!-- Cabeçalho -->
                <header class="mb-4">
                    <div class="header-icons d-flex justify-content-end">
                        <i class="fas fa-bell mr-3"></i> <!-- Ícone de notificação -->
                        <i class="fas fa-cogs mr-3"></i> <!-- Ícone de configurações -->
                        <img src="../assets/img/profile.jpg" alt="Foto de Perfil" class="profile-img" style="width: 40px; height: 40px; border-radius: 50%;">
                    </div>
                </header>

                <!-- Caixa de pesquisa e seletor de quantidade de registros -->
                <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <input class="form-control form-control-sm w-100" type="text" id="search" placeholder="Pesquisar...">
                    </div>
                    <div class="col-12 col-md-6 text-right">
                        <form class="d-flex" method="GET" action="">
                            <select class="form-control form-control-sm w-100" id="limit" onchange="searchData(1)">
                                <option value="10" selected>10 Registros</option>
                                <option value="25">25 Registros</option>
                                <option value="50">50 Registros</option>
                                <option value="100">100 Registros</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Tabela de Dados -->
                <div id="tableResults" class="table-responsive"></div>

                <!-- Navegação por Páginas -->
                <div id="pagination" class="mt-3"></div>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../assets/js/kaiadmin.min.js"></script>

    <script>
        // Função para realizar a pesquisa via AJAX
        function searchData(page = 1) {
            var search = document.getElementById('search').value;
            var limit = document.getElementById('limit').value;

            $.ajax({
                url: 'search.php', // A página que processará a pesquisa
                type: 'GET',
                data: {
                    search: search,
                    limit: limit,
                    page: page
                },
                success: function (response) {
                    var responseData = JSON.parse(response);
                    $('#tableResults').html(responseData.table);
                    $('#pagination').html(responseData.pagination);
                }
            });
        }

        // Chamar a função ao digitar na caixa de pesquisa
        document.getElementById('search').addEventListener('input', function () {
            searchData(1); // Voltar para a página 1 sempre que pesquisar
        });

        // Chamar a função ao mudar a quantidade de registros
        document.getElementById('limit').addEventListener('change', function () {
            searchData(1); // Voltar para a página 1 ao mudar o limite
        });

        // Carregar todos os dados inicialmente
        $(document).ready(function () {
            searchData(1);
        });
    </script>

</body>

</html>
