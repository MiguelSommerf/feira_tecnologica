<?php
require_once '../config/connect.php';
require_once '../back/classes/Logout.php';

$verif = new Logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login.css" />
  <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
  <title>Tela de Login</title>
</head>
<body class="TelaLogin">
  <div class="container">
    <div class="top">
      <img src="../assets/img/etecmcm.png" alt="Logo" class="logo" />
    </div>

    <button class="btn-voltar" onclick="history.back()">Voltar</button>
    <div class="form-container">
      <form action="../back/login.php" method="post" id="loginForm">
        <label for="email">Email</label>
        <input type="email" id="email" name="emailuser" placeholder="Digite seu email" required />

        <label for="senha">Senha</label>
        <div class="senha-container">
          <input type="password" id="senha" name="passuser" placeholder="Digite sua senha" required />
          <span class="olho" id="olho" onclick="toggleSenha()">😐</span>
        </div>

        <!--  aqui é necessário trocar o caminho para puxar a página certa  -->
        <a href="../views/tela_2step.php" class="esqueci">Esqueci minha senha</a>

        <div class="botoes">
          <div class="g_id_signin" data-type="standard"></div>
          <button type="submit">Entrar</button>
        </div>
      </form>
    </div>

    <div class="cadastrar-container">
      <button class="cadastrar" onclick="window.location.href='tela_cadastro.php'">
        Cadastrar
      </button>
    </div>
  </div>

  <div class="login-texto">LOGIN</div>
  <!--API DO GOOGLE-->
  <!--Codado por Guilherme Solon e Miguel Luiz Sommerfeld (Turma B) - 3°F-->

  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <div id="g_id_onload"
      data-client_id="471307138333-njh18r1rajueo4auooa4mtutban1p6dt.apps.googleusercontent.com"
      data-auto_prompt="false"
      data-callback="handleCredentialResponse">
  </div>

  <script>
      let name = "";
      let email = "";

      google.accounts.id.disableAutoSelect();
      localStorage.clear();

      function handleCredentialResponse(response){
          console.log("ID Token:", response.credential);

          const data = parseJwt(response.credential);
          email = data.email;
          name = data.name;

          fetch("../back/login_api.php", {
            method: "POST",
            headers: { "Content-Type":"application/json" },
            body: JSON.stringify({
              emailGoogle: email,
              nomeGoogle: name,
            })
          })
          .then(response => response.json())
          .then(data => {
            if(data.error){
              alert(data.error);
            }else if(data.success){
              window.location.href = 'tela_home.php';
            }
          });
      }

      // Deslogar o login do google (propria API)
      function signOut(){
          google.accounts.id.disableAutoSelect();
          localStorage.clear();
          alert("Você saiu da conta.");
          window.location.href = 'tela_login.php';
      }

      // funcao pra decodificar e puxar os parametros do token, decodifica com o jWT e permite trazer parametros para o JS
      function parseJwt(token){
          const base64Url = token.split('.')[1];
          const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          return JSON.parse(atob(base64));
      }
  </script>
  <script>
    const olho = document.getElementById('olho');
    const inputSenha = document.getElementById('senha');
    let piscando = true;
    let intervaloPiscar;

    function piscarEmoji() {
      if (!piscando) return;
      olho.textContent = '😑';
      setTimeout(() => {
        if (piscando) olho.textContent = '😐';
      }, 80);
    }

    function iniciarPiscar() {
      olho.textContent = '😐';
      piscando = true;
      intervaloPiscar = setInterval(piscarEmoji, 2000);
    }

    function pararPiscar() {
      piscando = false;
      clearInterval(intervaloPiscar);
    }

    function toggleSenha() {
      if (inputSenha.type === 'password') {
        inputSenha.type = 'text';
        pararPiscar();
        olho.textContent = '😑';
      } else {
        inputSenha.type = 'password';
        iniciarPiscar();
        olho.textContent = '😐';
      }
    }

    iniciarPiscar();
  </script>
</body>
</html>