<?php
require_once '../config/database.php';
require_once '../back/classes/Logout.php';

$verif = new Logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/login.css">
  <title>Login</title>
</head>
<body>
  <main>
      <div class="logo">
          <img src="../assets/img/etecmcm.png" alt="">
      </div>
      <form action="../back/login.php" method="post">
          <div class="content-background">
              <div class="content">
                  <span>E-mail</span>
                  <input type="email" name="emailuser" id="" placeholder="Digite o seu e-mail" required>
              </div>
              <div class="content">
                  <span>Senha</span>
                  <input type="password" name="passuser" id="" placeholder="Digite a sua senha" required>
                  <div class="esqueci-senha">
                      <a href="tela_2step.php">Esqueci a senha</a>
                  </div>
              </div>
              <div class="content">
                  <div class="g_id_signin" data-type="standard"></div>
                  <button class="blue-button" type="submit">Entrar</button>
              </div>
              <div class="content">
                  <a href="tela_cadastro.php" class="dark-purple-button">Cadastrar</a>
              </div>
              <h1 class="title-screen">Login</h1>
          </div>
      </form>



</main>
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