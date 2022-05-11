<?php
    $title = ' | Cursos de programação web';
    $css = 'index';
    include('inc/header.php');
    include('inc/fn.diaSemana.php');
?>

        <div id="pitch">
            <div class="pitch-item">
                <div class="pitch-item-logo">&lt;/&gt;</div>
                <div class="pitch-item-title">
                    Metaversos
                </div>
                <div class="pitch-item-text">
                    Facebook, Amazon e outros gigantes tecnológicos estão a investir milhões de euros em ambientes virtuais que irão necessitar todo o tipo de programadores, incluindo nas interfaces web com os utilizadores.
                </div>   
            </div>        
            <div class="pitch-item">
                <div class="pitch-item-logo">&lt;/&gt;</div>
                <div class="pitch-item-title">
                    Redes 5G
                </div>
                <div class="pitch-item-text">
                    A nova geração de telemóveis irá proporcionar aplicações que não podemos sequer imaginar, mas que vão requerer milhares de programadores para construir as suas interfaces, seja num computador ou no telemóvel.
                </div>   
            </div>        
            <div class="pitch-item">
                <div class="pitch-item-logo">&lt;/&gt;</div>
                <div class="pitch-item-title">
                    IoT
                </div>
                <div class="pitch-item-text">
                    A internet das coisas (IoT, <i>internet of things</i>) vai dar-nos o poder de controlar praticamente tudo a partir de qualquer dispositivo ligado à rede. Quem vai elaborar todas as interfaces que serão necessárias? Um programador web!
                </div>   
            </div>        
        </div> <!-- fim de pitch -->

        <div id="hero">
            <div id="hero-tit">Toda a gente começa do zero! Programa o teu futuro!</div>
            <div id="hero-content">
                <div id="hero-text">
                    <img src="img/bruce-mars-FWVMhUa_wbY-unsplash.jpg" />
                    <p>A Web 3.0, baseada nas redes 5G e na IoT, será realidade muito em breve e vai fundir a realidade física com os mundos virtuais.</p>
                    <p>&nbsp;</p>
                    <p>Se atualmente já há uma falta imensa de programadores (vê a página <a href="empregos.php" target="_new"><b>Empregos</b></a>), essa via profissional crescerá exponencialmente nos próximos anos.</p>
                    <p>&nbsp;</p>
                    <p>Ainda não sabemos que ferramentas serão usadas para criar os metaversos e a internet das coisas, mas uma coisa é certa: vão precisar de interfaces, isto é, de programadores web.</p>
                    <p>&nbsp;</p>
                    <p>A nossa missão é colocar-te na grelha de partida para acederes a uma das profissões mais valorizadas das próximas décadas. Bem-vindo à Web 3.0.</p>
                </div>
                <div id="hero-image">
                    <img src="img/bruce-mars-FWVMhUa_wbY-unsplash.jpg" /> 
                </div>                
            </div>
        </div> <!-- fim de hero -->

        <div id="titpagina">Introdução à programação web</div>
        <div id="cursos">
<?php
    $query = 'select id, nome, nivel, dias, inicio, fim, data, resumo, duracao, custo, imagem from cursos where validado = 1 order by data'; // echo $query;
    $res = $db->query($query);
    while($linha = $res->fetch_assoc()) {
        $id = $linha['id'];
        $nome = urldecode($linha['nome']);
        $nivel = $linha['nivel'];
        $dias = $linha['dias'];
        $inicio = $linha['inicio'];
        $fim = $linha['fim'];
        $resumo = nl2br(urldecode($linha['resumo']));
        $duracao = urldecode($linha['duracao']);
        $custo = $linha['custo'];
        $data = $linha['data'];
        $imagem = urldecode($linha['imagem']);

        $nome = '<b>' .$nome . '</b>';
        $nivel = $nivel ? ' Nível ' . $nivel : '' ;
        setlocale(LC_TIME, 'portuguese');
        $data = strtolower(strftime('%e de %B de %Y', strtotime($data)));
        $dias = diaSemana($dias);

        echo '
            <div class="curso">
                <div class="curso-tit"><b>' . $nome . '</b>' . $nivel . '</div>
                <div class="curso-txt">
                    <img src="img/cursos/' . $imagem . '">
                    <p><b>' . $dias . ', ' . $inicio . '-' . $fim . 'h</b></p>
                    <p></p>
                    <p>' . $resumo . '</p>
                    <p>' . $duracao . '</p>
                    <p class="custo">€' . $custo . '</p>
                    <p>Próximo: <b>' . $data . '</b></p>
                    <p class="saber-mais"><a href="curso.php?id=' . $id . '"><button>Saber mais</button></a></p>
                </div>
            </div>';
    }
?>            
        </div>

<?php
    include('inc/footer.php');
?>