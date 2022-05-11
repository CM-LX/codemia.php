<?php
class dbClass
{
	public function __construct()
	{
		$this->script = 'class.codemia.db.php';
		$this->connection = new mysqli('localhost', 'sxhd01ne_codemia', 'password');

		if(mysqli_connect_errno())
		{
			$erro = new erroClass;
			$erro->script = $this->script;
			$erro->linha = 17;
			$erro->msg = 'Erro ao ligar ao servidor';
			$erro->enviar(1);
		}
		else
		{
			$dbSelect = $this->connection->select_db('sxhd01ne_codemia');

			if(!$dbSelect)
			{
				$erro = new erroClass;
				$erro->script = $this->script;
				$erro->linha = 33;
				$erro->msg = 'Erro ao seleccionar a base de dados';
				$erro->enviar(1);
			}
			else
				return $this->connection;
		}
	}

	public function query($sql)
	{
		if($sql)
			$this->result = $this->connection->query($sql);
		else
		{
			$erro = new erroClass;
			$erro->script = $this->script;
			$erro->linha = 54;
			$erro->msg = 'Query vazia';
			$erro->enviar(1);
		}
		if(!$this->result)
		{
			$erro = new erroClass;
			$erro->script = $this->script;
			$erro->linha = 66;
			$erro->msg = 'Erro ao executar query
****************
' . $sql . '
****************';
			$erro->enviar(0);
		}
   		else
   			return $this->result;
	}

	public function obter_dados()
	{
		return $this->result->fetch_object();
	}

	public function linhas_afectadas()
	{
 		return $this->connection->affected_rows;
	}

	public function num_linhas()
	{
		return $this->result->num_rows;
	}

	public function ultimo_id()
	{
		return $this->connection->insert_id;
	}

	public function __deconstruct()
	{
		$this->result->free();
		$disconnect = $this->connection->close();
		if(!$disconnect)
		{
			$erro = new erroClass;
			$erro->script = $this->script;
			$erro->linha = 110;
			$erro->msg = 'Erro ao fechar ligação à base de dados';
			$erro->enviar();
		}
		else
			return $disconnect;
	}
}
?>