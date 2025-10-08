<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre a feira</title>
  <link rel="stylesheet" href="../assets/css/feira.css">
</head>
<body>
  <main>
    <header class="headerLogo">
      <img src="../assets/img/etecmcm.png" alt="Logo MCM" />
    </header>
    <div class="container">
      <div class="texto" style="text-align: center;">
        <p>
          Informações sobre a Feira Tecnológica
        </p>
      </div>
      <div class="texto">
        <p>
          A Feira Tecnológica e Sustentável da ETEC Maria Cristina Medeiros é um evento anual que reúne criatividade, inovação e consciência socioambiental. Desenvolvida pelos alunos com apoio dos professores, a feira apresenta projetos que integram tecnologia e sustentabilidade. Mais do que uma simples exposição de trabalhos, a feira é um espaço de troca de conhecimentos, onde a comunidade escolar e visitantes externos podem conhecer de perto as iniciativas dos cursos técnicos e integrados.<br><br>
          Além da apresentação dos projetos, o evento oferece palestras e atividades interativas, criando um ambiente de aprendizado e inspiração. É também uma excelente oportunidade para o público conhecer melhor os alunos, seus talentos e as possibilidades oferecidas pelos cursos técnicos da ETEC MCM, reforçando o compromisso da escola com a formação de profissionais conscientes, criativos e preparados para transformar o futuro.
        </p>
      </div>
      <div class="grid-imagens">
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
        <img src="" alt="" class="feira-imagem"></img>
      </div>
    </div>
  </main>
</body>
</html>