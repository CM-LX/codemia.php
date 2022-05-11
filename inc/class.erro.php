<?php

class erroClass
{
	public function __construct()
	{
		$this->msg = '';
		$this->pagina = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$this->script = '';
		$this->linha = 0;
	}

	public function enviar($encerrar=0)
	{
		$this->data	= date('D\, j M Y G:i:s T');
		$mail = new mailClass;
		$mail->email = 'c_madeira@yahoo.com';
		$mail->assunto = 'Codemia: erro na BD';
		$mail->mensagem	=
'MSG: ' . $this->msg . '
<br><br>pagina: ' . $this->pagina . '
<br>script: ' . $this->script . '
<br>linha: ' . $this->linha . '
<br>data: ' . $this->data;
		// echo $mail->mensagem;
		$mail->enviar();
		unset($mail);
		if($encerrar) die();
	}
}

?>