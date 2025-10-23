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
$sqlSelecionarProjeto = "SELECT sa." . TABELA_SALA['sala'] . ", b." . TABELA_BLOCO['bloco'] . ", p." . TABELA_PROJETO['titulo'] . ", p." . TABELA_PROJETO['orientador'] . ", p." . TABELA_PROJETO['descricao'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " AS p " . " 
                        INNER JOIN " . TABELA_LOCALIZACAO_PROJETO['nome_tabela'] . " AS lp ON lp." . TABELA_LOCALIZACAO_PROJETO['projeto'] . " = p." . TABELA_PROJETO['id'] . "
                        INNER JOIN " . TABELA_BLOCO['nome_tabela'] . " AS b ON b." . TABELA_BLOCO['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['bloco'] . "
                        INNER JOIN " . TABELA_SALA['nome_tabela'] . " AS sa ON sa." . TABELA_SALA['id'] . " = lp." . TABELA_LOCALIZACAO_PROJETO['sala'] . "
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
        <h2>Editando Projeto: '<?= $projeto['titulo_projeto'] ?>'</h2>

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
                        echo "<option value='1'>A (Atual)</option>";
                        echo "<option value='2'>B</option>";
                        break;
                  case 'B':
                        echo "<option value='2'>B (Atual)</option>";
                        echo "<option value='1'>A</option>";
                        break;
                }
                ?>
            </select>

            <label>Sala:</label>
            <select name="sala" id="sala" required>
                <option value="" disabled selected>Selecione a sala:</option>
                <?php
                // Pensei em uma forma para melhorar isso, salvar todas as salas em uma tabela no banco, e criar uma tabela relacional para projeto-sala
                $querySala = "SELECT DISTINCT " . TABELA_SALA['sala'] . ", " . TABELA_SALA['id'] . " FROM " . TABELA_SALA['nome_tabela'];
                $stmtSala = $mysqli->prepare($querySala);
                $stmtSala->execute();
                $salas = $stmtSala->get_result();

                foreach ($salas as $sala) {
                    if ($sala['nome_sala'] !== $projeto['nome_sala']) {
                        echo "<option value='" . $sala['id_sala'] . "'>" . $sala['nome_sala'] . "</option>";
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