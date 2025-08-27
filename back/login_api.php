<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require_once '../config/database.php';

if(empty($dataJSON) && empty($data)){
    $dataJSON = file_get_contents("php://input");
    $data = json_decode($dataJSON, true);

    $nome = $data['nomeGoogle'];
    $email = $data['emailGoogle'];
}

$query = "SELECT " . TABELA_USUARIO['id'] . ", " . TABELA_USUARIO['nome'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['email'] . " = ? AND " . TABELA_USUARIO['senha'] . " IS NULL";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows == 1){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }        
    $stmt->bind_result($id_user, $nome_user);
    $stmt->fetch();

    $_SESSION['id'] = $id_user;
    $_SESSION['nome'] = $nome_user;
    
    $mensagem_json = [
        'success' => true
    ];
    echo json_encode($mensagem_json);
}else{
    $query = "SELECT " . TABELA_USUARIO['id'] . ", " . TABELA_USUARIO['nome'] . " FROM " . TABELA_USUARIO['nome_tabela'] . " WHERE " . TABELA_USUARIO['email'] . " = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        echo json_encode(['error' => 'E-mail já cadastrado manualmente.']);
        exit();
    } else {
        echo json_encode(['error' => 'E-mail não cadastrado.']);
    }
}

$stmt->close();
$mysqli->close();
exit();
