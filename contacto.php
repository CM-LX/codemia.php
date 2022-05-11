<?php
    require_once('inc/class.mail.php');
    require_once('inc/class.erro.php');
    require_once('inc/class.db.php');
    $db = new dbClass;

    $title = ' | Contacto';
    $css = 'contacto';
    include('inc/header.php');

    $enviar = isset($_POST['enviar']) && $_POST['enviar'] ? 1 : 0;

    if($enviar)
    {
        $nome = isset($_POST['nome']) ? strip_tags($_POST['nome']) : '';
        $email = isset($_POST['mail']) ? strip_tags($_POST['mail']) : '';
        $msg = isset($_POST['msg']) ? strip_tags($_POST['msg']) : '';
        $a = isset($_POST['a']) && is_numeric($_POST['a']) ? $_POST['a'] : 0;

        if($nome && $email && $msg)
        {
            $mail = new mailClass;
            $mail->email = 'c_madeira@yahoo.com';
            $mail->assunto = 'Mensagem';
            $mail->mensagem	=
'Nome: ' . $nome . '
<br><br>Email: ' . $email . '
<br><br>Mensagem
<br><br>' . $msg;
            // echo $mail->mensagem;
            $mail->enviar();
            unset($mail);
        }

        $resposta = $a == 1 ? 'Obrigado pela tua inscrição' : 'Obrigado pelo teu contacto';
?>
        <div id="titpagina">Mensagem recebida!</div>
        <div>
            <h3><?= $resposta ?>!</h3>
            <p>&nbsp;</p>
            <h3>Recebemos a tua mensagem e entraremos em contacto logo que possível.</h3>
            <p>&nbsp;</p>
            <h3>É raro levarmos mais de umas horas, mas pode acontecer...</h3>
        </div>
<?php
    } else {

        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
        $query = 'select id from cursos where validado = 1 and id=' . $id;
        $res = $db->query($query);
        if(!$db->num_linhas())
        {
            header('location: index.php');
            die();
        }
        $a = isset($_GET['a']) && is_numeric($_GET['a']) ? $_GET['a'] : 0;

        $query = 'select nome, nivel from cursos where id=' . $id;
        $res = $db->query($query);
        $linha = $res->fetch_assoc();
        $nome = urldecode($linha['nome']);
        $nivel = $linha['nivel'];
        $nome .= $nivel ? ' Nível ' . $nivel: '' ;

        $msg = '';
        if($a == 1)
        {
            $msg = "Quero inscrever-me no curso " . $nome . " (" . $id . ").";
        }
        if($a == 2)
        {
            $msg = "Tenho uma dúvida sobre o curso " . $nome . " (" . $id . ").";
        }
    
?>
        <div id="titpagina">Contacto</div>
        <form action="contacto.php" method="post">
            <input type="hidden" name="enviar" value="1">
            <input type="hidden" name="a" value="<?= $a ?>">
            <div class="form-item">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>
            <div class="form-item">
                <label for="mail" class="form-label">Email</label>
                <input type="mail" class="form-control" id="mail" name="mail" placeholder="Email">
            </div>
            <div class="form-item">
                <label for="msg">Mensagem</label>
                <textarea id="msg" name="msg" placeholder="Mensagem"><?= $msg ?></textarea>
            </div>
            <div class="form-item">
                <input type="submit" class="contacto-enviar" value="Enviar">
            </div>
        </form>
<?php
    }

    include('inc/footer.php');
?>