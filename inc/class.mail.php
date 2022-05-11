<?php
class mailClass
{
	public function __construct()
	{
		$this->assunto = '';
		$this->copia = 0;
		$this->email = '';
		$this->mensagem	= '';
		$this->nome	= '';
		$this->imagem = 1;
	}

	public function enviar()
	{
		global $db, $pg;

		$this->msgTXT =
'Caro ' . $this->nome . ',

Bom dia!

' . $this->mensagem . '

Cumprimentos,

Codemia | Programação web
https://codemia.pt';

		$this->msg =
'<html>
<body>
<div id="header" style="background:#00008b;color:#fff;font-family:verdana,arial,helvetica;font-size:20px;padding:20px;"><a href="https://codemia.pt" style="color:#fff;text-decoration:none;"><b>C<span style="color:red">:/</span>odemia</b></a></div>
<div id="txt" style="border:1px solid #00008b;font-family:verdana,arial,helvetica;font-size:16px;line-height:130%;padding:20px;">';
/*
		if($this->imagem)
		{
			$this->msg .='
<img src="logo" style="border:1px solid #000;float:right;width:30%;margin-left:20px;">';

		}
*/
		$this->msg .= '
' . nl2br($this->mensagem) . '
<br/><br/><a href="https://codemia.pt" style="color:#00008b;font-weight:bold;text-decoration:none;">https://codemia.pt</a>
<br/><a href="mailto:codemia@codemia.pt" style="color:#00008b;font-weight:bold;text-decoration:none;">codemia@codemia.pt</a>
<div style="clear:both"></div>
</div>
<div id="footer" style="background:#00008b;color:#fff;font-family:verdana,arial,helvetica;font-size:16px;padding:20px;"><a href="https://codemia.pt" style="color:#fff;text-decoration:none;"><b>C<span style="color:red">:/</span>odemia | Programação web</b></a></div>
</body>
</html>';
		$this->data	= gmdate('D\, j M Y G:i:s T');
		$this->deNome = 'Codemia';
		$this->deEmail = 'codemia@codemia.pt';
		$this->headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\n"; // tem de ser aspas!
		$this->headers .= "Date: " . $this->data . "\r\nFrom: " . $this->deNome . " <" . $this->deEmail . ">\r\nReply-To: <" . $this->deEmail . ">\r\n"; // tem de ser aspas!
		if($this->copia) mail('c_madeira@yahoo.com', 'CM: ' . $this->assunto, $this->msg, $this->headers);
		$sucesso = mail($this->email, $this->assunto, $this->msg, $this->headers, '-f codemia@codemia.pt');
		// $em = error_get_last()['message'];
		// echo "<li>SUCESSO: $sucesso | EM: $em";
	}
}
?>