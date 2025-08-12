<?php
    // CONEXÃO COM BANCO
    require_once '../config/connect.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // PEGAR PARÂMETROS
    $bloco = $_GET['bloco'] ?? null;
    $sala = $_GET['sala'] ?? null;
    $pagina = $_GET['pagina'] ?? 1;

    // HTML: TOPO
    function headerHTML() {
        echo <<<HTML
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>Feira de Projetos</title>
                <link href="../assets/css/mapa.css" rel="stylesheet"> 
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
                <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
            </head>
            <body class="telaTal">
            <div>
                <nav>
                    <header>
                        <div class="menu-toggle" id="mobile-menu">
                            <span class="bar"></span>
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </div>

                        <div class="logo-container">
                            <img src="../assets/img/etecmcm.png" alt="Logo MCM"/>
                        </div>

                        <div class="ORGInfoHeader">
                            <h1>Locais</h1><!--Nome da tela (ex. Avaliação)-->
                        </div>
                    </header>

                    <button class="btn-voltar" onclick="history.back()">Voltar</button>

                    <div id="mySideMenu" class="side-menu">
                        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
                        <a href="tela_mapa.php">Mapa</a>
                        <a href="tela_projetos.php">Projetos</a>
                        <a href="tela_ranking.php">Ranking</a>
                        <a href="tela_cursos.php">Cursos</a>
                        <a href="tela_sobreEtec.php">Sobre a Etec</a>
                        <?php if(isset($_SESSION['id'])): ?>
                        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
                        <?php endif; ?>
                    </div>
                </nav>
        HTML;
    }

    // HTML: RODAPÉ
    function footerHTML() {
        echo <<<HTML
            </div>

                <script>
                    document.getElementById('mobile-menu').addEventListener('click', function() {
                    this.classList.toggle('active');
                    openMenu();
                    });
                
                    function openMenu() {
                    document.getElementById('mySideMenu').style.width = '250px';
                    }
                
                    function closeMenu() {
                    document.getElementById('mySideMenu').style.width = '0';
                    document.getElementById('mobile-menu').classList.remove('active');
                    }
                </script>
            </body>
            </html>
        HTML;
    }

    // PÁGINA 1 — ESCOLHA DE BLOCO
    if (!$bloco && !$sala) {
        headerHTML();
        echo '<div class="BTNLocais">';
        echo '<h1>Blocos</h1>';
        echo '<a href="?bloco=A"><button>Bloco A</button></a>';
        echo '<a href="?bloco=B"><button>Bloco B</button></a>';
        echo '</div>';
        footerHTML();
        exit;
    }

    // PÁGINA 2 — SALAS DO BLOCO
    if ($bloco && !$sala) {
        headerHTML();

        $stmt = $mysqli->prepare("SELECT DISTINCT sala FROM tbl_projetos WHERE bloco = ? ORDER BY sala ASC");
        $stmt->bind_param("s", $bloco);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<div class='BTNLocais'>";
        echo "<h1>Salas do Bloco $bloco</h1>";
        while ($row = $result->fetch_assoc()) {
            $salaNome = htmlspecialchars($row['sala']);
            echo "<div>
                    <a href='?bloco=$bloco&sala=" . urlencode($salaNome) . "'><button>$salaNome</button></a>
                </div>";
        }
        echo "</div>";

        $stmt->close();
        footerHTML();
        exit;
    }

    // TELA INTERMEDIÁRIA — QUADRA
    if ($bloco && isset($_GET['sala']) && $sala === 'Quadra' && !isset($_GET['pagina'])) {
        headerHTML();

        $stmt = $mysqli->prepare("SELECT COUNT(*) as total FROM tbl_projetos WHERE bloco = ? AND sala = ?");
        $stmt->bind_param("ss", $bloco, $sala);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->fetch_assoc()['total'];
        $stmt->close();

        $grupos = ceil($total / 8);
        echo "<div class='BTNLocais'>";
        echo "<h1>Projetos na Quadra</h1>";
        for ($i = 1; $i <= $grupos; $i++) {
                $inicio = (($i - 1) * 8) + 1;
                $fim = min($i * 8, $total);
                echo "<div>
                        <a href='?bloco=$bloco&sala=Quadra&pagina=$i'><button>Projetos " . $inicio . "-" . $fim . "</button></a>
                    </div>";
        }

        echo "</div>";
        footerHTML();
        exit;
    }

    // PÁGINA 3 — PROJETOS DA SALA (QUALQUER SALA)
    if ($bloco && $sala) {
        headerHTML();

        $limit = 8;
        $offset = ($pagina - 1) * $limit;

        // Modificação: JOIN entre tbl_projetos e ods_projeto
        $stmt = $mysqli->prepare("
            SELECT p.titulo_projeto, p.descricao_projeto, o.ods, p.stand, p.prof_orientador 
            FROM tbl_projetos p
            LEFT JOIN ods_projeto op ON p.id_projetos = op.id_projetos
            LEFT JOIN tbl_ods o ON op.id_ods = o.id_ods
            WHERE p.bloco = ? AND p.sala = ? 
            ORDER BY p.titulo_projeto ASC 
            LIMIT ? OFFSET ?
        ");
        $stmt->bind_param("ssii", $bloco, $sala, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "<div>Nenhum projeto encontrado para essa sala.</div>";
        } else {
            echo "<div class='BTNLocais'>";
            echo "<h1>Projetos da Sala $sala (Bloco $bloco)</h1>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='BTNLocais div-project'>
                            <h5>{$row['titulo_projeto']}</h5>
                            <p>{$row['descricao_projeto']}</p>
                            <p><strong>ODS:</strong> {$row['ods']}</p>
                            <p><strong>Stand:</strong> {$row['stand']}</p>
                            <p><strong>Orientador:</strong> {$row['prof_orientador']}</p>
                    </div>";
            }
            echo "</div>";
        }

        $stmt->close();
        footerHTML();
        exit;
    }
?>
