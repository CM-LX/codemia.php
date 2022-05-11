<?
	if(!file_exists('codemia.bg.jpg'))
	{
		$erro = new erroClass;
		$erro->script = 'img/curso.jpg.php';
		$erro->linha = 4;
		$erro->msg = 'Não existe a imagem "img/codemia.bg.jpj"';
		$erro->enviar(1);
	}

	$id = $_GET['id'] && is_numeric($_GET['id']) ? $_GET['id'] : 0; 

	include('../inc/class.mail.php');
	include('../inc/class.erro.php');
	include('../inc/class.db.php');
	$db = new dbClass();

	$query = 'select nome, nivel, data, custo from cursos where validado=1 and id=' . $id; // echo "<li>$query";
    $res = $db->query($query); 
	$existeCurso = $db->num_linhas(); // este dado condiciona a posição do "C:/odemia";

	$src_img = imagecreatefromjpeg('codemia.bg.jpg');
	$img = imagecreatetruecolor(600, 450);
	$srcW = ImageSX($src_img);
	$srcH = ImageSY($src_img);

	imagecopyresized($img, $src_img, 0, 0, 0, 0, 600, 450, $srcW - 1, $srcH - 1);

	$preto	= imagecolorallocate($img, 0, 0, 0);
	$branco	= imagecolorallocate($img, 255, 255, 255);
	$vermelho = imagecolorallocate($img, 255, 0, 0);
	$amarelo = imagecolorallocate($img, 255, 255, 0);

	$fontSize = 70;
	$codemia = 'C: odemia';
	$y = $existeCurso ? 160 : 140;
	$textBoxCodemia = imagettfbbox($fontSize, 0, 'verdana.ttf', $codemia);
	$textSizeCodemia = $textBoxCodemia[4] - $textBoxCodemia[0]; 
	$i = 300 - $textSizeCodemia / 2; 

	imagettftext($img, $fontSize, 0, $i + 2, $y + 2, $preto, 'verdana.ttf', $codemia);
	imagettftext($img, $fontSize, 0, $i, $y, $branco, 'verdana.ttf', $codemia);
	imagettftext($img, $fontSize, 0, $i + 107, $y - 1, $preto, 'verdana.ttf', '/');
	imagettftext($img, $fontSize, 0, $i + 105, $y - 3, $vermelho, 'verdana.ttf', '/');

	function printLine($fontSize, $txt, $font, $y, $color) { 
		global $img;
		$box = imagettfbbox($fontSize, 0, $font, $txt);
		$size = $box[4] - $box[0];
		$i = 300 - $size / 2; 
		imagettftext($img, $fontSize, 0, $i + 2, $y + 2, $preto, $font, $txt);
		imagettftext($img, $fontSize, 0, $i, $y, $color, $font, $txt);
	}

	if($existeCurso) {

		$linha = $res->fetch_assoc();
		$nome = urldecode($linha['nome']); 
		$nivel = $linha['nivel'];
		$data = $linha['data'];
		$custo = $linha['custo'];

		$nivel = $nivel ? ' Nível ' . $nivel : '';
		setlocale(LC_TIME, 'portuguese');
		$data = strtolower(strftime('%e de %B de %Y', strtotime($data)));
	
		function boxSize($fontSize, $nome, $nivel) {
			$textBoxNome = imagettfbbox($fontSize, 0, 'verdanab.ttf', $nome . ' ');
			$textSizeNome = $textBoxNome[4] - $textBoxNome[0]; 
			$textBoxNivel = imagettfbbox($fontSize, 0, 'verdana.ttf', $nivel);
			$textSizeNivel = $textBoxNivel[4] - $textBoxNivel[0]; 
			$lineSize = $textSizeNome + $textSizeNivel;
			return [$lineSize, $textSizeNivel];
		}

		$fontSize = 60;
		$lineSize = boxSize($fontSize, $nome, $nivel);

		while($lineSize > 500) {
			$fontSize--;
			$lineSize = boxSize($fontSize, $nome, $nivel)[0];
			$textSizeNivel = boxSize($fontSize, $nome, $nivel)[1];
		}

		$offset = 250 - $lineSize / 2;
		$i = 300 - $lineSize / 2; 
		$y = 250; 
		imagettftext($img, $fontSize, 0, $i + $offset + 2, $y + 2, $preto, 'verdanab.ttf', $nome);
		imagettftext($img, $fontSize, 0, $i + $offset, $y, $amarelo, 'verdanab.ttf', $nome);
		imagettftext($img, $fontSize, 0, 552 - $textSizeNivel - $offset, $y + 2, $preto, 'verdana.ttf', $nivel);
		imagettftext($img, $fontSize, 0, 550 - $textSizeNivel - $offset, $y, $amarelo, 'verdana.ttf', $nivel);


		$txtData = 'Próximo: ' . $data;
		$txtData = str_replace('  ' , ' ' , $txtData);
		$font = 'verdanab.ttf'; 
		$fontSize = 18; 
		$color = $branco;
		$y = 310;
		$txt = $txtData;
		printLine($fontSize, $txt, $font, $y, $color);

		$txtCusto = 'Custo: €' . $custo;
		$fontSize = 25; 
		$y = 380; 
		$txt = $txtCusto;
		printLine($fontSize, $txt, $font, $y, $color);

	} else {

		$font = 'verdanab.ttf'; 
		$fontSize = 27; 
		$color = $amarelo;
		$y += 70;
		$txt = 'Aprende a programar';
		printLine($fontSize, $txt, $font, $y, $color);

		$y += 40; 
		$txt = 'para a web';
		$box = imagettfbbox($fontSize, 0, 'verdanab.ttf', $txt);
		printLine($fontSize, $txt, $font, $y, $color);

		$fontSize = 20; 
		$color = $branco;
		$txt = 'Entra numa das profissões';
		$y += 55; 
		printLine($fontSize, $txt, $font, $y, $color);

		$txt = 'mais bem pagas do mundo!';
		$y += 30; 
		printLine($fontSize, $txt, $font, $y, $color);

		$font = 'verdana.ttf'; 
		$txt = 'http://codemia.pt';
		$y += 55; 
		printLine($fontSize, $txt, $font, $y, $color);

	}

	header('content-type: image/jpeg');
	imagejpeg($img);
	imagedestroy($img);
?>