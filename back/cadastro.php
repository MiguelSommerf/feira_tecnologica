<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/connect.php';
require_once 'classes/VerificarCampos.php';

if(isset($_SESSION['nameuser']) && ($_SESSION['email']) && ($_SESSION['passuser']) && ($_SESSION['birthuser'])){

    $verif = new VerificarCampos($mysqli);

    $verif->verificarNome($_SESSION['nameuser']);
    $verif->verificarEmail($_SESSION['email']);
    $verif->verificarSenha($_SESSION['passuser']);
    $verif->verificarDataDeNascimento($_SESSION['birthuser']);
    $verif->verificarEspacoEmBranco($_SESSION['email']);
    $verif->verificarEspacoEmBranco($_SESSION['passuser']);

    if((!empty($_SESSION['email']) && !empty($_SESSION['passuser'])) && (!empty($_SESSION['nameuser']) && !empty($_SESSION['birthuser']))){
        $verif->verificarEmailExistente($_SESSION['email']);
        $senha = trim($_SESSION['passuser']);

        $nome = trim(ucwords(strtolower($_SESSION['nameuser'])));
        $email = trim(strtolower($_SESSION['email']));
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $data_nascimento = $_SESSION['birthuser'];

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
