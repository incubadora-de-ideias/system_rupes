<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
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
</head>

<body>

    <!-- Barra Lateral (oculta em telas pequenas, visível em telas maiores) -->
    <nav id="sidebar" class="sidebar d-flex flex-column align-items-start p-4 bg-dark text-white position-fixed d-none d-md-block"
        style="height: 100vh; width: 250px; border-radius: 0 15px 15px 0; box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);">
        <h2 class="h4 mb-4">Painel de Administração</h2>
        <a href="../index.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="./rupes.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Rupes</a>
        <a href="./relatorio.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-upload"></i> Importar Relatórios</a>
        <a href="./vizualizar.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-chart-bar"></i> Rupes</a>
        <a href="./reports.php" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-file-alt"></i> Relatórios</a>
        <a href="#" class="text-white py-2 d-block sidebar-link mb-2"><i class="fas fa-cogs"></i> Configurações</a>
    </nav>

    <!-- Botão de Menu Hambúrguer (visível em telas pequenas) -->
    <button id="menu-toggle" class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#sidebar"
        aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Conteúdo Principal -->
    <div class="main-panel" style="margin-left: 250px;">
        <div class="content">
            <div class="container-fluid">
                <h1 class="text-center mb-4"><i class="fas fa-cogs"></i> Configurações</h1>

                <!-- Formulário de Configurações -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Configurações de Perfil</h5>
                            </div>
                            <div class="card-body">
                                <form action="processar_config.php" method="POST">
                                    <div class="form-group">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome"
                                            value="Usuário Exemplo">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                                            value="usuario@exemplo.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_image">Foto de Perfil</label>
                                        <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Atualizar Perfil</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Configurações Gerais</h5>
                            </div>
                            <div class="card-body">
                                <form action="processar_config.php" method="POST">
                                    <div class="form-group">
                                        <label for="language">Idioma</label>
                                        <select class="form-control" id="language" name="language">
                                            <option value="pt-br" selected>Português</option>
                                            <option value="en">Inglês</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="theme">Tema</label>
                                        <select class="form-control" id="theme" name="theme">
                                            <option value="light" selected>Claro</option>
                                            <option value="dark">Escuro</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="notifications">Notificações</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="notifications" name="notifications" checked>
                                            <label class="form-check-label" for="notifications">
                                                Habilitar notificações
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Salvar Configurações</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configurações de Segurança -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning text-white">
                                <h5 class="mb-0">Segurança</h5>
                            </div>
                            <div class="card-body">
                                <form action="processar_segurança.php" method="POST">
                                    <div class="form-group">
                                        <label for="current_password">Senha Atual</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Digite sua senha atual">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Nova Senha</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Digite a nova senha">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirmar Nova Senha</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirme a nova senha">
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100">Alterar Senha</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Preferências de Conta</h5>
                            </div>
                            <div class="card-body">
                                <form action="processar_preferencias.php" method="POST">
                                    <div class="form-group">
                                        <label for="2fa">Autenticação de Dois Fatores (2FA)</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="2fa" name="2fa" checked>
                                            <label class="form-check-label" for="2fa">
                                                Habilitar 2FA para maior segurança
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="session_timeout">Tempo de Expiração de Sessão (minutos)</label>
                                        <input type="number" class="form-control" id="session_timeout" name="session_timeout" value="30">
                                    </div>
                                    <button type="submit" class="btn btn-info w-100">Salvar Preferências</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configurações de Privacidade -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">Privacidade</h5>
                            </div>
                            <div class="card-body">
                                <form action="processar_privacidade.php" method="POST">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="data_sharing" name="data_sharing" checked>
                                        <label class="form-check-label" for="data_sharing">
                                            Compartilhar dados com terceiros
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ad_tracking" name="ad_tracking">
                                        <label class="form-check-label" for="ad_tracking">
                                            Permitir rastreamento de anúncios
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">Salvar Configurações de Privacidade</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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

    <!-- Script para controlar o menu hambúrguer -->
    <script>
        // Mostrar e esconder a barra lateral ao clicar no menu hambúrguer
        document.getElementById("menu-toggle").addEventListener("click", function () {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("d-none");
        });
    </script>
    <script>
        // Função para aplicar o tema
        function applyTheme(theme) {
            document.body.className = theme === 'dark' ? 'dark-theme' : 'light-theme';
        }

        // Salva e aplica o tema selecionado
        document.getElementById("theme").addEventListener("change", function () {
            const selectedTheme = this.value;
            localStorage.setItem("theme", selectedTheme);
            applyTheme(selectedTheme);
        });

        // Ao carregar a página, aplica o tema salvo
        document.addEventListener("DOMContentLoaded", function () {
            const savedTheme = localStorage.getItem("theme") || "light";
            document.getElementById("theme").value = savedTheme;
            applyTheme(savedTheme);
        });
    </script>


</body>

</html>
