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
    <title>Créditos</title>
    <link rel="stylesheet" href="../assets/css/creditos.css">
</head>
<body>
    <main>
        <header class="headerLogo">
            <img src="../assets/img/etecmcm.png" alt="Logo MCM">
        </header>
        <div class="container">
            <!-- Back-end -->
            <div class="sep-cat-cred"><p>Back-end</p></div>
            <div class="cartoes">
                <?php
                    $dados = [
                        ["Ângelo Gabriel", "../assets/img/Perfil.jpeg", "Team leader, Back - End", null, "https://github.com/projAngeloAraujo"],
                        ["Enzo Móbile", "../assets/img/Back/enzo.jpeg", "Back - End", "https://www.linkedin.com/in/enzo-m%C3%B3bile-de-oliveira-4b5472304/", "https://github.com/enzomobile"],
                        ["Guilherme Solon", "../assets/img/Back/Guilherme Solon.jpeg", "Back - End", "https://www.linkedin.com/in/guilherme-solon-691289369?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app ", "https://github.com/Solonguitec"],
                        ["Gustavo da Rocha", "../assets/img/Perfil.jpeg", "Back - End", null, "https://github.com/gustapinheiro"],
                        ["Gustavo Rangel", "../assets/img/Back/Gustavo Rangel.jpeg", "Back - End","https://www.linkedin.com/in/gustavo-rangel-b9ba18357?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/DEVRangelll"],
                        ["Iuri Carati", "../assets/img/Perfil.jpeg", "Back - End", null, "https://github.com/ToxicDumpster"],
                        ["Jean Marcos", "../assets/img/Back/Jean.jpeg", "Back - End", null, "https://github.com/jean666"],
                        ["Júlia Medeiros", "../assets/img/Perfil.jpeg", "Back - End", null, "https://github.com/jumedeirost"],
                        ["Matheus Pereira", "../assets/img/Back/Matheus.jpeg", "Back - End", null, "https://github.com/MatheusSontos"],
                        ["Miguel Sommerfeld", "../assets/img/Back/Miguel Sommerfeld.jpeg", "Team leader, Back - End", "https://www.linkedin.com/in/miguel-sommerfeld-06491b340/", "https://github.com/MiguelSommerf"],
                        ["Miguel Teodoro", "../assets/img/Back/Miguel Teodoro_.jpg", "Back - End", null, "https://github.com/Miguelteodorodesouza"],
                        ["Sabrina Bela", "../assets/img/Back/Sabrina Nicole.jpeg    ", "Back - End", "https://www.linkedin.com/in/sabrina-nicole-bela-4157b1289?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app", "https://github.com/sabrinabela1"],
                        ["Stephany dos Santos", "../assets/img/Back/Stephany Santos.jpeg", "Back - End", null, "https://github.com/stephanydossantos16"],
                        ["Thomas Coradi", "../assets/img/Back/Thomas.jpeg", "Back - End", null, "https://github.com/thomcoradi"]
                    ];

                    foreach ($dados as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}'>";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Banco de Dados -->
            <div class="sep-cat-cred"><p>Banco de Dados</p></div>
            <div class="cartoes">
                <?php
                    $dadosBanco = [
                        ["Amanda Rodriguez", "../assets/img/Banco de dados/Amanda Rodrigues_.jpg", "Banco de Dados", "", "https://github.com/amandszr"],
                        ["Bryan de Oliveira", "../assets/img/Banco de dados/Bryan.jpeg", "Banco de Dados", "", "https://github.com/BryanOli17"],
                        ["Denner Pereira", "../assets/img/Banco de dados/Denner.jpeg", "Banco de Dados", "", "https://github.com/Denner106"],
                        ["Guilherme Benatte", "../assets/img/Banco de dados/Guilherme Benatte.jpeg", "Team leader, Banco de Dados", "", "https://github.com/guibenatte"],
                        ["Katharina Iaussoghi", "../assets/img/Banco de dados/Katharina.jpeg", "Banco de Dados", "", "https://github.com/Katharinasilveira"],
                        ["Mariana Campello", "../assets/img/Banco de dados/Mariana.jpeg", "Banco de Dados", "https://www.linkedin.com/in/mariana-cunha-campello-b865b5363/", "https://github.com/marianacampelo"],
                        ["Nicole Pereira", "../assets/img/Perfil.jpeg", "Banco de Dados", "", "https://github.com/Nicolepereiragregorutti"],
                        ["Rafaela Mayumi", "../assets/img/Banco de dados/Rafaela.jpeg", "Team leader, Banco de Dados", "https://www.linkedin.com/in/rafaela-mayumi-3b4587286?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/RafaelaMayumiFukuda"]
                    ];

                    foreach ($dadosBanco as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}'>";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Front-end -->
            <div class="sep-cat-cred"><p>Front-end</p></div>
            <div class="cartoes">
                <?php
                    $dadosFront = [
                        ["Amanda Kaori", "../assets/img/Front/Amanda Kaori.jpg", "Front - End", null, "https://github.com/projamandakaori"],
                        ["Camila Vitoria", "../assets/img/Front/Camila.jpeg", "Front - End", null, "https://github.com/ProjCamilaVitoria"],
                        ["Cauã Arthur", "../assets/img/Front/Cauã.jpeg", "Front - End", null, "https://github.com/Projcauaramos"],
                        ["Cecília Santiago", "../assets/img/Front/Cecilia.jpeg", "Front - End", null, "https://github.com/ceciliasf"],
                        ["Eduardo de Ataíde", "../assets/img/Front/Eduardo.jpeg", "Front - End", null, "https://github.com/duduusxz"],
                        ["Giulia Benedetti", "../assets/img/Front/Giulia.jpeg", "Team Leader, Front - End", null, "https://github.com/projgioliveira"],
                        ["João Xavier", "../assets/img/Front/João.jpeg", "Front - End", "https://www.linkedin.com/in/jo%C3%A3o-vitor-xavier-de-carvalho-469147183/?trk=opento_nprofile_details", "https://github.com/joaovitorxc"],
                        ["Kevin Rafael", "../assets/img/Front/Kevin.jpeg", "Front - End", null, "https://github.com/Kevin2007x"],
                        ["Lívia Amaral", "../assets/img/Front/Livia.jpeg", "Team Leader, Front - End", "https://www.linkedin.com/in/l%C3%ADvia-amaral-sales-antonio-675219326/", "https://github.com/Liviaamaralsales"],
                        ["Olavo Alves", "../assets/img/Front/Olavo.jpeg", "Front - End","https://www.linkedin.com/in/olavo-alves-schiavi-338488353?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app ", "https://github.com/Olavoschiavi"],
                        ["Sabrina Vitória", "../assets/img/Front/Sabrina Vitoria.jpeg", "Front - End", null, "https://github.com/Sabrinavmoura"],
                        ["Stefanny Sayuri", "../assets/img/Front/Stefanie Sayuri.jpeg", "Front - End", null, "https://github.com/StefannySayuri"],
                        ["Welington Fernando", "../assets/img/Front/Wellington.jpeg", "Front - End", null, "https://github.com/Welingtonf"]
                    ];

                    foreach ($dadosFront as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}'>";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>

            <!-- Gestão -->
            <div class="sep-cat-cred"><p>Gestão</p></div>
            <div class="cartoes">
                <?php
                    $dadosGestao = [
                        ["Giovana Pracanico", "../assets/img/Gestão/Giovana.jpeg", "Gestora", null, "https://github.com/projgipracanico"],
                        ["Heitor Albuquerque", "../assets/img/Gestão/Heitor.jpeg", "Gestor", null, "https://github.com/projheitorfreitas"],
                        ["Joshua Rodrigues", "../assets/img/Gestão/Joshua.jpeg", "Gestor", null, "https://github.com/JoshRodriguescae"],
                        ["Luara Gouveia", "../assets/img/Gestão/Luara.jpeg", "Gestora", null, "https://github.com/luarag45"]
                    ];
                    foreach ($dadosGestao as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}'>";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>
            
            <!-- Orientadores -->
            <div class="sep-cat-cred"><p>Orientadores</p></div>
            <div class="cartoes">
                <?php
                    $dadosOrientadores = [
                        ["Ricardo Moreira", "../assets/img/Orientadores/Ricardo.jpeg", "Orientador do projeto", null, "https://github.com/prof-ricardo"],
                        ["Edilma Bindá", "../assets/img/Orientadores/Edilma.jpeg", "Orientadora do projeto", null, "https://github.com/edilmabinda"]
                    ];
                    foreach ($dadosOrientadores as $pessoa) {
                        echo "<div class='cartao'>";
                        echo "<img class='avatar' src='{$pessoa[1]}' alt='{$pessoa[0]}'>";
                        echo "<div class='cargo'>";
                        echo "<h2>{$pessoa[0]}</h2>";
                        echo "<h3>{$pessoa[2]}</h3>";
                        echo "<div class='div-btn-cred'>";
                        if ($pessoa[4]) echo "<a class='btn-git' href='{$pessoa[4]}' target='_blank' rel='noopener noreferrer'>GitHub</a>";
                        if ($pessoa[3]) echo "<a class='btn-linkedin' href='{$pessoa[3]}' target='_blank' rel='noopener noreferrer'>LinkedIn</a>";
                        echo "</div></div></div>";
                    }
                ?>
            </div>
        </div>
    </main>
</body>
</html>