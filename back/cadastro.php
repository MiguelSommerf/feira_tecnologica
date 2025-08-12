<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/connect.php';
require_once 'classes/VerificarCampos.php';

$verif = new VerificarCampos($mysqli);

if(isset($_POST['nameuser']) && ($_POST['emailuser']) && ($_POST['passuser']) && ($_POST['birthuser'])){

    $verif->verificarNome($_POST['nameuser']);
    $verif->verificarEmail($_POST['emailuser']);
    $verif->verificarSenha($_POST['passuser']);
    $verif->verificarDataDeNascimento($_POST['birthuser']);
    $verif->verificarEspacoEmBranco($_POST['emailuser']);
    $verif->verificarEspacoEmBranco($_POST['passuser']);

    if((!empty($_POST['emailuser']) && !empty($_POST['passuser'])) && (!empty($_POST['nameuser']) && !empty($_POST['birthuser']))){
        $verif->verificarEmailExistente($_POST['emailuser']);
        $senha = trim($_POST['passuser']);

        $nome = trim(ucwords(strtolower($_POST['nameuser'])));
        $email = trim(strtolower($_POST['emailuser']));
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $data_nascimento = $_POST['birthuser'];

        //aqui eu basicamente criei um 'template' de quais campos serão preenchidos, cada um desses '?', serão preenchidos com dados de forma segura depois.
        $sql_query = "INSERT INTO tbl_users (nome, email, senha, data_nasc) VALUES (?,?,?,?)";
        //$$mysqli->prepare($slq) ----> prepara a query fazendo com que os '?' fiquem aguardando para receberem os dados digitados, evitando MySQL injection porque os dados serão tratados pelo MySQL ANTES da execução.
        $stmt = $mysqli->prepare($sql_query);
        //bind_param ----> vincula os dados digitados aos '?'. os 'ss' dizem que $email e $senha são dois valores do tipo string (s = string)
        $stmt->bind_param("ssss", $nome, $email, $hash, $data_nascimento);
        //execute() ---> o comando foi executado e os dados foram inseridos na tabela usuario
        $stmt->execute();
        //close() fecha a consulta e apaga os dados
        $stmt->close();
        //fecha a conexão com o banco para liberar memória
        $mysqli->close();

        echo "<script>window.location.href = '../views/tela_login.php'</script>";
        exit();
    };
}
?>