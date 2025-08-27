<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/database.php';
require_once 'classes/VerificarCampos.php';

$verif = new VerificarCampos($mysqli);
$email = trim(strtolower($_POST['emailuser']));
$senha = trim($_POST['passuser']);

$verif->verificarEmail($email);
$verif->verificarSenha($senha);
$verif->verificarEspacoEmBranco($email);
$verif->verificarEspacoEmBranco($senha);

$consulta = "SELECT " . TABELA_USUARIO['id'] . ", " . TABELA_USUARIO['admin'] . ", " . TABELA_USUARIO['nome'] . ", " . TABELA_USUARIO['senha'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['email'] . " = ?";
$stmt = $mysqli->prepare($consulta);
$stmt->bind_param("s", $email);
$stmt->execute();
//store_result armazena os dados da consulta anterior no banco.
$stmt->store_result();

//se o valor de linhas retornadas for igual a 1
if($stmt->num_rows == 1){
    //Vincula a senha criptografada e o id do usuário que está dentro do banco, com a variável $hash e $user_id.
    $stmt->bind_result($id_user, $is_admin, $nome_user, $hash);
    //fetch() é necessário para que o valor vinculado seja atribuído, sem ele, o valor nunca será atribuído, pois a execução nunca será realizada.
    $stmt->fetch();

    //a função password_verify verifica se a senha digitada pelo usuário é a mesma senha criptografada do banco de dados.
    if(password_verify($senha, $hash)){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['id'] = $id_user;
        $_SESSION['is_admin'] = $is_admin;
        $_SESSION['nome'] = $nome_user;

        echo "<script>window.location.href = '../views/tela_home.php'</script>";
        exit();
    }else{
        echo "<script>alert('Usuário ou senha incorretos.')</script>";
        echo "<script>window.history.back();</script>";
        exit();
    };
}else{
    echo "<script>alert('Usuário ou senha incorretos.')</script>";
    echo "<script>window.history.back();</script>";
    exit();
};
