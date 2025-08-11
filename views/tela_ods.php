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
    <title>Objetivo de Desenvolvimento Sustentável</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grenze:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.rybena.com.br/dom/master/latest/rybena.js"></script>
    <link rel="stylesheet" href="../assets/css/ods.css">
</head>
<body class="TelaOds">
    <header>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="logo-container">
            <img src="../assets/img/etecmcm.png" alt="Logo MCM"/>
        </div>
        <div class="ORGInfoHeader">
            <h1>ODS's</h1>
        </div>
        <button class="btn-voltar" onclick="history.back()">Voltar</button>
    </header>    

    <main>
        <div class="container-ods">
            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods1.jpg" alt="ODS 1 - Erradicação da pobreza">
                </div>
                <div class="text">ODS 1 - Erradicação da pobreza</div>
                <div class="caption">O Objetivo 1 da Agenda 2030 busca acabar com a pobreza em todas as suas formas e em todos os lugares até 2030, por meio da erradicação da pobreza extrema, redução significativa da pobreza em todas as dimensões, ampliação da proteção social, garantia de acesso igualitário a recursos e serviços básicos, fortalecimento da resiliência dos mais vulneráveis, mobilização de recursos financeiros e implementação de políticas públicas inclusivas e sensíveis a gênero.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods2.png" alt="ODS 2 - Fome zero e agricultura sustentável">
                </div>
                <div class="text">ODS 2 - Fome zero e agricultura sustentável</div>
                <div class="caption">O Objetivo 2 visa acabar com a fome até 2030, garantir acesso universal a alimentos nutritivos, erradicar a desnutrição, aumentar a produtividade e renda de pequenos produtores, promover a agricultura sustentável e resiliente, preservar a diversidade genética, ampliar investimentos no setor agrícola, corrigir distorções no comércio mundial de alimentos e assegurar mercados alimentares estáveis e acessíveis.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods3.png" alt="ODS 3 - Saúde e Bem-Estar">
                </div>
                <div class="text">ODS 3 - Saúde e Bem-Estar</div>
                <div class="caption">O Objetivo 3 busca garantir vida saudável e bem-estar para todos, reduzindo a mortalidade materna e infantil, combatendo doenças transmissíveis e não transmissíveis, promovendo saúde mental, ampliando o acesso a serviços de saúde sexual e reprodutiva, fortalecendo a cobertura universal de saúde, controlando substâncias nocivas, incentivando a pesquisa médica, investindo em profissionais da saúde e reforçando a capacidade de resposta a emergências sanitárias.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods4.png" alt="ODS 4 - Educação de Qualidade">
                </div>
                <div class="text">ODS 4 - Educação de Qualidade</div>
                <div class="caption">O Objetivo 4 visa garantir educação inclusiva, equitativa e de qualidade para todos, desde a primeira infância até o ensino superior, promovendo o aprendizado ao longo da vida. Busca eliminar desigualdades, ampliar o acesso à educação técnica e profissional, fortalecer habilidades para o trabalho, assegurar alfabetização e conhecimento básico, fomentar valores sustentáveis e investir em infraestrutura escolar e na formação de professores, especialmente nos países em desenvolvimento.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods5.png" alt="ODS 5 - Igualdade de Gênero">
                </div>
                <div class="text">ODS 5 - Igualdade de Gênero</div>
                <div class="caption">O Objetivo 5 visa alcançar a igualdade de gênero e empoderar todas as mulheres e meninas. Busca eliminar todas as formas de discriminação e violência de gênero, garantir igualdade de oportunidades e participação plena em todos os níveis de tomada de decisão, assegurar acesso a serviços de saúde e educação de qualidade, promover o empoderamento econômico e a autonomia das mulheres, e garantir o acesso a recursos e serviços essenciais.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods6.png" alt="ODS 6 - Água Potável e Saneamento">
                </div>
                <div class="text">ODS 6 - Água Potável e Saneamento</div>
                <div class="caption">O Objetivo 6 visa garantir a disponibilidade e a gestão sustentável da água e do saneamento para todos. Busca assegurar o acesso universal e equitativo à água potável e segura, melhorar a qualidade da água, aumentar a eficiência do uso da água, proteger e restaurar ecossistemas relacionados à água, e promover a participação comunitária na gestão dos recursos hídricos.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods7.png" alt="ODS 7 - Energia Acessível e Limpa">
                </div>
                <div class="text">ODS 7 - Energia Acessível e Limpa</div>
                <div class="caption">O Objetivo 7 visa garantir o acesso à energia acessível, confiável, sustentável e moderna para todos. Busca aumentar a participação de energias renováveis na matriz energética global, melhorar a eficiência energética, promover o acesso à eletricidade em áreas rurais e remotas, e fomentar a pesquisa e inovação em tecnologias energéticas sustentáveis.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods8.png" alt="ODS 8 - Trabalho Decente e Crescimento Econômico">
                </div>
                <div class="text">ODS 8 - Trabalho Decente e Crescimento Econômico</div>
                <div class="caption">O Objetivo 8 visa promover o crescimento econômico sustentado, inclusivo e sustentável, o emprego pleno e produtivo e o trabalho decente para todos. Busca aumentar a produtividade econômica, promover políticas que incentivem a criação de empregos, garantir condições de trabalho seguras e protegidas, e apoiar o desenvolvimento de pequenas e médias empresas.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods9.png" alt="ODS 9 - Indústria, Inovação e Infraestrutura">
                </div>
                <div class="text">ODS 9 - Indústria, Inovação e Infraestrutura</div>
                <div class="caption">O Objetivo 9 visa construir infraestruturas resilientes, promover a industrialização inclusiva e sustentável e fomentar a inovação. Busca aumentar a capacidade da indústria para gerar emprego e renda, promover a pesquisa e o desenvolvimento de tecnologias sustentáveis, e garantir o acesso a informações e tecnologias para todos.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods10.jpg" alt="ODS 10 - Redução das Desigualdades">
                </div>
                <div class="text">ODS 10 - Redução das Desigualdades</div>
                <div class="caption">O Objetivo 10 visa reduzir as desigualdades dentro dos países e entre eles. Busca promover a inclusão social, econômica e política de todos, independentemente de sua origem, e garantir oportunidades iguais para todos. Isso inclui a promoção de políticas que favoreçam a igualdade de renda, o acesso a serviços básicos e a eliminação de discriminações.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods11.png" alt="ODS 11 - Cidades e Comunidades Sustentáveis">
                </div>
                <div class="text">ODS 11 - Cidades e Comunidades Sustentáveis</div>
                <div class="caption">O Objetivo 11 visa tornar as cidades e os assentamentos humanos inclusivos, seguros, resilientes e sustentáveis. Busca garantir o acesso a moradia adequada e serviços básicos, a sustentabilidade dos sistemas de transporte, a proteção do patrimônio cultural e natural, e a promoção de políticas de urbanização que favoreçam a inclusão social e a participação da comunidade.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods12.png" alt="ODS 12 - Consumo e Produção Responsáveis">
                </div>
                <div class="text">ODS 12 - Consumo e Produção Responsáveis</div>
                <div class="caption">O Objetivo 12 visa garantir padrões de consumo e produção sustentáveis. Busca promover a eficiência dos recursos e a energia, e incentivar a adoção de práticas sustentáveis por empresas e consumidores. Isso inclui a redução de resíduos, a promoção da reciclagem e a conscientização sobre o consumo responsável.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods13.png" alt="ODS 13 - Ação Contra a Mudança Global do Clima">
                </div>
                <div class="text">ODS 13 - Ação Contra a Mudança Global do Clima</div>
                <div class="caption">O Objetivo 13 visa combater as mudanças climáticas e seus impactos. Busca promover a conscientização sobre a importância da ação climática, fortalecer a resiliência e a capacidade de adaptação a desastres relacionados ao clima, e integrar medidas de mudança climática nas políticas e estratégias nacionais.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods14.png" alt="ODS 14 - Vida na Água">
                </div>
                <div class="text">ODS 14 - Vida na Água</div>
                <div class="caption">O Objetivo 14 visa conservar e promover o uso sustentável dos oceanos, mares e recursos marinhos para o desenvolvimento sustentável. Busca proteger a biodiversidade marinha, reduzir a poluição dos oceanos e promover a pesca sustentável, garantindo a saúde dos ecossistemas aquáticos e a segurança alimentar das populações que dependem deles.</div>
            </div>
            </div>

            <div class="ods-dupla">
            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods15.png" alt="ODS 15 - Vida Terrestre">
                </div>
                <div class="text">ODS 15 - Vida Terrestre</div>
                <div class="caption">O Objetivo 15 visa proteger, restaurar e promover o uso sustentável dos ecossistemas terrestres, gerenciar de forma sustentável as florestas, combater a desertificação, e reverter a degradação da terra e a perda de biodiversidade. Busca garantir a conservação da biodiversidade e o uso sustentável dos recursos naturais para as gerações presentes e futuras.</div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods16.png" alt="ODS 16 - Paz, Justiça e Instituições Eficazes">
                </div>
                <div class="text">ODS 16 - Paz, Justiça e Instituições Eficazes</div>
                <div class="caption">O Objetivo 16 visa promover sociedades pacíficas e inclusivas, proporcionar acesso à justiça para todos e construir instituições eficazes, responsáveis e inclusivas em todos os níveis. Busca reduzir a violência, combater a corrupção e promover a participação cidadã nas decisões que afetam suas vidas.</div>
            </div>
            </div>

            <div class="component" onclick="expandComponent(this)">
                <div class="image-ods">
                    <img src="../assets/img/ods17.png" alt="ODS 17 - Parcerias e Meios de Implementação">
                </div>
                <div class="text">ODS 17 - Parcerias e Meios de Implementação</div>
                <div class="caption">O Objetivo 17 visa fortalecer a implementação e revitalizar a parceria global para o desenvolvimento sustentável. Busca mobilizar recursos financeiros, promover transferências de tecnologia e capacitação, e fomentar a cooperação entre os países para alcançar os ODS.</div>
            </div>
        </div>
    </main>

    <div id="mySideMenu" class="side-menu">
        <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
        <a href="tela_mapa.php">Mapa</a>
        <a href="tela_avaliacao.php">Avaliação</a>
        <a href="tela_projetos.php">Projetos</a>
        <a href="tela_ranking.php">Ranking</a>
        <a href="tela_cursos.php">Cursos</a>
        <a href="tela_sobreEtec.php">Sobre a Etec</a>
        <a href="tela_acessibilidade.php">Acessibilidade</a>
        <?php if(isset($_SESSION['id'])): ?>
        <a href="../back/logout.php" class="deslogar" id="deslogar" name="deslogar">Sair da Conta</a>
        <?php endif; ?>
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

        function expandComponent(element) {
            element.classList.toggle("expanded");
        }
    </script>
</body>
</html>
