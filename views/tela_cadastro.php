<?php
require_once '../back/connect.php';
require_once '../back/classes/Logout.php';

$verif = new Logout();
$verif->logout();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Karantina:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/cadastro.css" />

  
  <title>Tela de Cadastro</title>
</head>
<body class="TelaCadastro">
  <div class="container">
    <div class="top">
      <img src="../assets/img/etecmcm.png" alt="Logo" class="logo" />
    </div>

    <div class="form-container">
      <form action="../back/cadastro.php" method="post" id="cadastroForm">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nameuser" placeholder="Digite seu nome" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="emailuser" placeholder="Digite seu email" required />

        <label for="senha">Senha</label>
        <div class="senha-container">
          <input type="password" id="senha" name="passuser" placeholder="Digite sua senha" minlength="8" required />
          <span class="olho" id="olho1" onclick="toggleSenha('senha', 'olho1')">😐</span>
        </div>

        <label for="confirmar-senha">Confirmar Senha</label>
        <div class="senha-container">
          <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Confirme sua senha" required />
          <span class="olho" id="olho2" onclick="toggleSenha('confirmar-senha', 'olho2')">😐</span>
        </div>

        <label for="data-nascimento">Data de Nascimento</label>
        <input type="date" id="data-nascimento" name="birthuser" required />

        <div class="botoes">
          <div class="g_id_signin" data-type="standard"></div>
          <button type="submit">Cadastrar</button>
        </div>
      </form>
    </div>

    <div class="login-container">
      <button class="login-invertido" onclick="window.location.href='tela_login.php'">
        Já tenho uma conta
      </button>
    </div>
  </div>

  <div class="cadastro-texto">CADASTRO</div>

  <!--API DO GOOGLE-->
  <!--Codado por Guilherme Solon (Turma A) e Miguel Luiz Sommerfeld (Turma B) - 3°F-->

    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <div id="g_id_onload"
        data-client_id="471307138333-njh18r1rajueo4auooa4mtutban1p6dt.apps.googleusercontent.com"
        data-auto_prompt="false"
        data-callback="handleCredentialResponse">
    </div>
    <!-- Aqui ele vai te pedir para completar o cadastro conforme os dados requisitados  -->
    <div id="modal" class="form-container" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); padding:20px;">
      <div class="senha-container">
        <h2>Complete seu cadastro:</h2>
        <label>Digite sua data de nascimento: <input type="date" id="dataNasc"></label><br>
        <button onclick="salvarDados()">Salvar</button>
      </div>
    </div>

    <button class="btn-voltar" onclick="history.back()">Voltar</button>

    <div id="mySideMenu" class="side-menu">
      <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
      <a href="tela_mapa.php">Mapa</a>
      <a href="tela_avaliacao.php">Avaliação</a>
      <a href="tela_projetos.php">Projetos</a>
      <a href="tela_ranking.php">Ranking</a>
      <a href="tela_cursos.php">Cursos</a>
      <a href="tela_sobreEtec.php">Sobre a Etec</a>
      <a href="tela_acessibilidade.php">Acessibilidade</a>
    </div>
    
    <script>
      document
        .getElementById("mobile-menu")
        .addEventListener("click", function () {
          this.classList.toggle("active");
          openMenu();
        });

      function openMenu() {
        document.getElementById("mySideMenu").style.width = "250px";
      }

      function closeMenu() {
        document.getElementById("mySideMenu").style.width = "0";
        document.getElementById("mobile-menu").classList.remove("active");
      }

      let name = "";
      let email = "";
      let dataNasc = "";
      
      google.accounts.id.disableAutoSelect();
      localStorage.clear();

      function handleCredentialResponse(response){
          console.log("ID Token:", response.credential);

          const data = parseJwt(response.credential);
          email = data.email;
          name = data.name;
          document.getElementById("modal").style.display = "block";
      }

      function salvarDados(){
          dataNasc = document.getElementById("dataNasc").value;

          //Se não tiver idade inserida ele vai mostrar o modal para o usuario preecher por aqui
          if(!dataNasc){
              alert("Por favor, preencha todos os campos.");
              return;
          }

          fetch("../back/cadastro_api.php", {
            method: "POST",
            headers: { "Content-Type":"application/json" },
            body: JSON.stringify({
              emailGoogle: email,
              nomeGoogle: name,
              dataNascGoogle: dataNasc
            })
          })
          .then(response => response.json())
          .then(data => {
            if(data.error){
              alert(data.error);
              document.getElementById("modal").style.display = "none";
            }else if(data.success){
              document.getElementById("modal").style.display = "none";
              window.location.href = 'tela_home.php';
            }
          });
      };

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
      let piscando = { olho1: true, olho2: true };
      let intervalos = {};

      function iniciarPiscar(idOlho) {
        const olho = document.getElementById(idOlho);
        piscando[idOlho] = true;
        intervalos[idOlho] = setInterval(() => {
          if (!piscando[idOlho]) return;
          olho.textContent = '😑';
          setTimeout(() => {
            if (piscando[idOlho]) olho.textContent = '😐';
          }, 80);
        }, 2000);
      }

      function pararPiscar(idOlho) {
        piscando[idOlho] = false;
        clearInterval(intervalos[idOlho]);
      }

      function toggleSenha(inputId, olhoId) {
        const input = document.getElementById(inputId);
        const olho = document.getElementById(olhoId);
        if (input.type === 'password') {
          input.type = 'text';
          pararPiscar(olhoId);
          olho.textContent = '😑';
        } else {
          input.type = 'password';
          iniciarPiscar(olhoId);
          olho.textContent = '😐';
        }
      }

      iniciarPiscar('olho1');
      iniciarPiscar('olho2');
  </script>
</body>
</html>