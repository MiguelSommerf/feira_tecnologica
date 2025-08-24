<?php
require_once 'classes/Logout.php';

$sair = new Logout();
$sair->logout();

echo "<script>window.location.href = '../index.php'</script>";
exit();

//Método logoutDirecionado não está em uso.
