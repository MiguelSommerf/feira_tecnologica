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

<<<<<<< HEAD
=======
# Altera os dados do projeto quando o form é enviado.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $sala = $_POST['sala'];
    $bloco = $_POST['bloco'];
    $stand = $_POST['stand'];
    $orientador = $_POST['orientador'];

    $sqlVerificar = "SELECT " . TABELA_PROJETO['id'] . " FROM " 
                    . TABELA_PROJETO['nome_tabela'] . " WHERE " 
                    . TABELA_PROJETO['bloco'] . " = ? AND " 
                    . TABELA_PROJETO['sala'] . " = ? AND " 
                    . TABELA_PROJETO['stand'] . " = ?";

    $stmtVerificar = $mysqli->prepare($sqlVerificar);
    $stmtVerificar->bind_param("sii", $bloco, $sala, $stand);
    $stmtVerificar->execute();
    $stmtVerificar->store_result();

    if ($stmtVerificar->num_rows > 0) {
        echo "<script>alert('Já existe um projeto cadastrado nesse Stand da mesma Sala e Bloco!')</script>";
        echo "<script>window.location.href='criar_projeto.php'</script>";
        $stmtVerificar->close();
        exit();
    }
    $stmtVerificar->close();

    $queryAlterarProjeto = "UPDATE ". TABELA_PROJETO['nome_tabela'] . " SET " 
                                    . TABELA_PROJETO['titulo'] . " = ?, " 
                                    . TABELA_PROJETO['descricao'] . " = ?, " 
                                    . TABELA_PROJETO['bloco'] . " = ?, " 
                                    . TABELA_PROJETO['sala'] . " = ?, " 
                                    . TABELA_PROJETO['stand'] . " = ?, " 
                                    . TABELA_PROJETO['orientador'] . " = ? WHERE " 
                                    . TABELA_PROJETO['id'] . " = ?";
    $stmtAlterarProjeto = $mysqli->prepare($queryAlterarProjeto);
    $stmtAlterarProjeto->bind_param("sssiisi", $titulo, $descricao, $bloco, $sala, $stand, $orientador, $id);
    $stmtAlterarProjeto->execute();

    echo "<script>alert('Projeto alterado com sucesso!')</script>";
    echo "<script>window.location.href='projetos.php'</script>";
    exit();
}

>>>>>>> 5bfaab1dbdbe00de4c18360ccbfa3e5c96db3ab9
# Pega os dados do projeto.
$sqlSelecionarProjeto = "SELECT * FROM " . TABELA_PROJETO['nome_tabela'] . " WHERE " . TABELA_PROJETO['id'] . " = ?";
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
                switch ($projeto['bloco_projeto']) {
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
                $querySala = "SELECT DISTINCT " . TABELA_PROJETO['sala'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " ORDER BY " . TABELA_PROJETO['sala'] . " DESC";
                $stmtSala = $mysqli->prepare($querySala);
                $stmtSala->execute();
                $salas = $stmtSala->get_result();

                foreach ($salas as $sala) {
                    echo "<option value='" . $sala['sala_projeto'] . "'>Sala " . $sala['sala_projeto'] . "</option>";
                }
                ?>
            </select>
            
            <label>Stand:</label>
            <select name="stand" id="stand" required>
                <option value="" disabled selected>Selecione o stand:</option>
                <?php
                $queryStand = "SELECT DISTINCT " . TABELA_PROJETO['stand'] . " FROM " . TABELA_PROJETO['nome_tabela'] . " ORDER BY " . TABELA_PROJETO['stand'] . " DESC";
                $stmtStand = $mysqli->prepare($queryStand);
                $stmtStand->execute();
                $stands = $stmtStand->get_result();

                foreach ($stands as $stand) {
                    echo "<option value='" . $stand['stand_projeto'] . "'>Stand " . $stand['stand_projeto'] . "</option>";
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