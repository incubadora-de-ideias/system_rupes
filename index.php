<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page com Barra Lateral</title>
    <style>
        /* Estilos Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f4f9;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Barra Lateral */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: start;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #fff;
            padding: 10px 0;
            display: block;
            font-size: 18px;
            width: 100%;
            text-align: left;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
        }

        /* Conteúdo Principal */
        .main-content {
            margin-left: 270px; /* Largura da barra lateral + espaço extra */
            padding: 20px;
            width: 100%;
        }

        header {
            color: #4CAF50;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        header p {
            font-size: 18px;
            margin-top: 5px;
        }

        /* Seção Principal */
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
            text-align: center;
        }

        .main h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .main p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .main .cta-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .main .cta-button:hover {
            background-color: #45a049;
        }

        /* Seção de Benefícios */
        .benefits {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 50px 20px;
            background-color: #ffffff;
        }

        .benefit {
            flex: 1 1 300px;
            max-width: 300px;
            padding: 20px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .benefit h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .benefit p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        /* Rodapé */
        footer {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
        
        /* Responsivo para telas menores */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Barra Lateral -->
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="routes/rupes.php">Importar Rupes</a>
        <a href="routes/relatorio.php">Importar Relatório</a>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <!-- Cabeçalho -->
        <header>
            <h1>Importação De Rupes</h1>
            <p>Solução perfeita para suas necessidades!</p>
        </header>

        <!-- Seção Principal com Chamada para Ação -->
        <section class="main">
            <div>
                <h2>Transforme sua experiência com o Sistema de rupes</h2>
                <p>Descubra como nossa solução pode ajudar você a alcançar seus objetivos de forma eficiente, prática e personalizada. Com nosso produto, você terá a tecnologia e o suporte que precisa para crescer e se destacar.</p>
                <button class="cta-button">Saiba Mais</button>
            </div>
        </section>

        <!-- Seção de Benefícios/Funcionalidades -->
        <section class="benefits">
            <div class="benefit">
                <h3>Fácil de Usar</h3>
                <p>Interface intuitiva e amigável, para que você aproveite todos os recursos sem dificuldades.</p>
            </div>
            <div class="benefit">
                <h3>Personalizável</h3>
                <p>Adapte o produto às suas necessidades específicas e torne-o parte do seu dia a dia.</p>
            </div>
            <div class="benefit">
                <h3>Suporte 24/7</h3>
                <p>Nossa equipe está disponível para ajudar você a qualquer momento, sempre que precisar.</p>
            </div>
        </section>
    </div>
</body>
</html>
