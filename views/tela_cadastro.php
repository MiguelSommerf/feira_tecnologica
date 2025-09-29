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
  <link rel="stylesheet" href="../assets/css/cadastro.css">
  <title>Cadastro</title>
</head>
<body>
    <main>
      <div class="logo">
          <img src="../assets/img/etecmcm.png" alt="">
      </div>
      <div class="content-background">
          <form action="../back/cadastro.php" method="post">
              <div class="content">
                  <span>Nome</span>
                  <input type="text" name="nameuser" id="" placeholder="Digite o seu nome" required>
              </div>
              <div class="content">
                  <span>E-mail</span>
                  <input type="email" name="emailuser" id="" placeholder="Digite o seu e-mail" required>
              </div>
              <div class="content">
                  <span>Senha</span>
                  <input type="password" name="passuser" id="senha" placeholder="Digite a sua senha" required>
              </div>
              <div class="content">
                  <span>Confirmar senha</span>
                  <input type="password" name="" id="confirmar-senha" placeholder="Confirme a sua senha" required>
              </div>
              <div class="content">
                  <span>Data de Nascimento</span>
                  <input type="date" name="birthuser" id="" required>
              </div>
              <div class="content">
                  <div class="g_id_signin"></div>
                  <button class="blue-button" type="submit">Cadastrar</button>
              </div>
              <div class="content">
                  <a class="light-purple-button" href="tela_login.php">Entrar</a>
              </div>
            </div>
          </form>
          <h1 class="title-screen">Cadastro</h1>
    </main>

  <!--API DO GOOGLE-->
  <!--Codado por Guilherme Solon (Turma A) e Miguel Luiz Sommerfeld (Turma B) - 3°F-->

  <!-- Tive que alterar a declaração das variáveis para cá, pois a API tentava acessar antes, e dava alguns erros de escopo. -->
  <script>
    let email = "";
    let name = "";
    let dataNasc = "";
  </script>
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
  <script>
    document.getElementById("mobile-menu").addEventListener("click", function () {
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
    google.accounts.id.disableAutoSelect();
    localStorage.clear();
  </script>
  <script>
    // Confirmar senha
    function checkSenha () {
      const formulario = document.getElementById('cadastroForm');
      formulario.addEventListener('submit', function(e){
        const senha = document.getElementById('senha').value;
        const confirmar_senha = document.getElementById('confirmar-senha').value;
        if (senha !== confirmar_senha) {
          e.preventDefault();
          alert('As senhas precisam coincidir. Por favor, confirme a sua senha.');
          return;
        }
      })
    }
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