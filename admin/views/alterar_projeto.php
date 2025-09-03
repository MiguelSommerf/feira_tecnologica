<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['admin']) or $_SESSION['admin'] !== 1) {
    header('Location: ../views/home.php');
    exit();
}

$id = !empty($_GET['id_projeto']) ? $_GET['id_projeto'] : null;
if (!isset($id)) {
    header("Location: projetos.php");
    exit();
}

# Pega os dados do projeto.
$sqlSelecionarProjeto = "SELECT sa." . TABELA_SALA['sala'] . "b." . TABELA_BLOCO['bloco'] . "st." . TABELA_STAND['stand'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " AS p " . " 
                        INNER JOIN " . TABELA_BLOCO['nome_tabela'] . " AS b ON b." . TABELA_BLOCO['id'] = TABELA_LOCALIZACAO_PROJETO['bloco'] . "
                        INNER JOIN " . TABELA_SALA['nome_tabela'] . " AS sa ON sa." . TABELA_SALA['id'] = TABELA_LOCALIZACAO_PROJETO['sala'] . "
                        INNER JOIN " . TABELA_STAND['nome_tabela'] . " AS st ON st." . TABELA_STAND['id'] = TABELA_LOCALIZACAO_PROJETO['stand'] . "
                        INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lp ON lp." . TABELA_LOCALIZACAO_PROJETO['projeto'] = "p" . TABELA_PROJETO['id'] . "
                         WHERE " . TABELA_PROJETO['id'] . " = ?";
$stmtSelecionarProjeto = $mysqli->prepare($sqlSelecionarProjeto);
$stmtSelecionarProjeto->bind_param("i", $id);
$stmtSelecionarProjeto->execute();
$projeto = $stmtSelecionarProjeto->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Editar Projeto</title>
</head>
<body>
    <div class="nav-bar">
        <div class="nav-bar-content">
            <a href="projetos.php">Voltar</a>
        </div>
    </div>

    <div class="container">
        <h2>Editando Projeto '<?= $projeto['titulo_projeto'] ?>'</h2>

        <!-- Formulário para alteração. -->
        <form method="POST" action="../src/editar_projeto.php">
            <input type="hidden" name="id_projeto" value="<?=$id?>">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($projeto['titulo_projeto']) ?>" placeholder="Novo título do projeto" required>

            <label>Descrição:</label>
            <textarea name="descricao" id="descricao" minlength="15" maxlength="200" placeholder="Digite até 200 caracteres" required><?= htmlspecialchars($projeto['descricao_projeto']) ?></textarea>

            <label>Bloco:</label>
            <select name="bloco" id="bloco" required>
                <option value="" disabled selected>Selecione o bloco:</option>
                <?php
                switch ($projeto['nome_bloco']) {
                    case 'A':
                        echo "<option value='A'>A (Atual)</option>";
                        echo "<option value='B'>B</option>";
                        break;
                  case 'B':
                        echo "<option value='B'>B (Atual)</option>";
                        echo "<option value='A'>A</option>";
                        break;
                }
                ?>
            </select>

            <label>Sala:</label>
            <select name="sala" id="sala" required>
                <option value="" disabled selected>Selecione a sala:</option>
                <?php
                // Pensei em uma forma para melhorar isso, salvar todas as salas em uma tabela no banco, e criar uma tabela relacional para projeto-sala e projeto-stand
                $querySala = "SELECT DISTINCT " . TABELA_SALA['sala'] . " FROM " . TABELA_SALA['nome_tabela'] . " ORDER BY " . TABELA_SALA['sala'] . " DESC";
                $stmtSala = $mysqli->prepare($querySala);
                $stmtSala->execute();
                $salas = $stmtSala->get_result();

                foreach ($salas as $sala) {
                    if ($sala !== $projeto['nome_sala']) {
                        echo "<option value='" . $sala['nome_sala'] . "'>Sala " . $sala['nome_sala'] . "</option>";
                    }
                }
                ?>
            </select>
            
            <label>Stand:</label>
            <select name="stand" id="stand" required>
                <option value="" disabled selected>Selecione o stand:</option>
                <?php
                $queryStand = "SELECT DISTINCT " . TABELA_STAND['stand'] . " FROM " . TABELA_STAND['nome_tabela'] . " ORDER BY " . TABELA_STAND['stand'] . " DESC";
                $stmtStand = $mysqli->prepare($queryStand);
                $stmtStand->execute();
                $stands = $stmtStand->get_result();

                foreach ($stands as $stand) {
                    if ($stand !== $projeto['nome_stand']) {
                        echo "<option value='" . $stand['nome_stand'] . "'>Stand " . $stand['nome_stand'] . "</option>";
                    }
                }
                ?>
            </select>

            <label>Orientador:</label>
            <input type="text" name="orientador" value="<?= htmlspecialchars($projeto['orientador_projeto']) ?>" placeholder="Orientador do projeto" required>
            
            <button type="submit">Salvar</button>
            <button type="reset" onclick="window.location.reload()" class="btn-delete">Reverter</button>
        </form>
    </div>
    <script src="../../assets/js/selectedOptions.js"></script>
</body>
</html>