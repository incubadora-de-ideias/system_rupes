<?php
    // Incluir o arquivo de configuração
    include('../config/config.php');

    // Pega o valor do limite, da pesquisa e da página
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;  // Calcula o offset com base na página

    // Consulta SQL para contar o total de registros
    $sqlCount = "SELECT COUNT(*) AS total FROM rupes WHERE rupe LIKE :search";
    $stmtCount = $pdo->prepare($sqlCount);
    $stmtCount->bindValue(':search', "%$search%");
    $stmtCount->execute();
    $totalRecords = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalRecords / $limit);  // Número total de páginas

    // Consulta SQL com filtro de pesquisa e limitação de registros
    $sql = "SELECT id, rupe, gpt, usado, data_validade FROM rupes WHERE rupe LIKE :search LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%$search%");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Gerar a tabela
    $table = "<div class='table-responsive'>";
    $table .= "<table class='table table-striped table-bordered'>";
    $table .= "<thead class='thead-dark'>
                <tr>
                    <th>ID</th>
                    <th>Rupe</th>
                    <th>GPT</th>
                    <th>Usado</th>
                    <th>Data Validade</th>
                </tr>
            </thead><tbody>";

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $table .= "<tr>
                            <td>" . htmlspecialchars($row["id"]) . "</td>
                            <td>" . htmlspecialchars($row["rupe"]) . "</td>
                            <td>" . htmlspecialchars($row["gpt"]) . "</td>
                            <td>" . htmlspecialchars($row["usado"]) . "</td>
                            <td>" . htmlspecialchars($row["data_validade"]) . "</td>
                        </tr>";
        }
    } else {
        $table .= "<tr><td colspan='5' class='text-center'>Nenhum dado encontrado.</td></tr>";
    }

    $table .= "</tbody></table></div>";

    // Gerar a navegação por páginas
    $pagination = "<nav aria-label='Page navigation'>
                        <ul class='pagination justify-content-center'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= "<li class='page-item " . ($i == $page ? "active" : "") . "'>
                            <a class='page-link' href='javascript:void(0)' onclick='searchData($i)'>$i</a>
                        </li>";
    }
    $pagination .= "</ul></nav>";

    // Retornar os resultados e a navegação em formato JSON
    echo json_encode(['table' => $table, 'pagination' => $pagination]);
?>
