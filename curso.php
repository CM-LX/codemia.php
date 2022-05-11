<?php
    require_once('inc/class.mail.php');
    require_once('inc/class.erro.php');
    require_once('inc/class.db.php');
    $db = new dbClass;

    include('inc/fn.diaSemana.php');

    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
    $query = 'select id from cursos where validado = 1 and id=' . $id;
    $res = $db->query($query);
    if(!$db->num_linhas())
    {
        header('location: index.php');
        die();
    }

    $query = 'select nome, nivel, dias, inicio, fim, data, duracao, custo, objetivo, projeto, imagem from cursos where id=' . $id;
    $res = $db->query($query);
    $linha = $res->fetch_assoc();
    $nome = urldecode($linha['nome']);
    $nivel = $linha['nivel'];
    $dias = $linha['dias'];
    $inicio = $linha['inicio'];
    $fim = $linha['fim'];
    $data = $linha['data'];
    $duracao = urldecode($linha['duracao']);
    $custo = $linha['custo'];
    $objetivo = nl2br(urldecode($linha['objetivo']));
    $projeto = nl2br(urldecode($linha['projeto']));
    $imagem = urldecode($linha['imagem']);

    $nome = '<b>' . $nome . '</b>';
    $dias = diaSemana($dias);
    $nome .= $nivel ? ' Nível ' . $nivel: '' ;
    setlocale(LC_TIME, 'portuguese');
    $data = strtolower(strftime('%e de %B de %Y', strtotime($data)));

    $title = ' | Curso: ' . strip_tags($nome);
    $css = 'curso';
    include('inc/header.php');
?>
        <div id="curso">
            <div id="titpagina"><?= $nome ?></div>
            <img src="img/cursos/<?= $imagem ?>" alt="<?= $nome ?>">
            <h3>Horário</h3>
            <p><?= $dias ?>, das <?= $inicio ?> às <?= $fim ?> horas</p>
            <h3>Início do próximo curso</h3>
            <p><?= $data ?></p>
            <h3>Duração</h3>
            <p><?= $duracao ?></p>
            <h3>Custo</h3>
            <p><?= $custo ?> euros</p>
            <p>&nbsp;</p>
            <h3>O que vais aprender?</h3>
            <p><?= $objetivo ?></p>
            <h3>Projeto</h3>
            <p><?= $projeto ?></p>
            <p>&nbsp;</p>
            <div id="curso-botoes">
                <a href="contacto.php?id=<?= $id ?>&a=1"><button>Inscreve-te já!</button></a>
                <a href="contacto.php?id=<?= $id ?>&a=2"><button>Contacta-nos para saberes mais</button></a>
            </div>
        </div> <!-- fim de curso -->

<?php
    include('inc/footer.php');
?>