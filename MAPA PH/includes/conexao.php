<?php 
	
	class Banco
	{
		
		public function conexao_banco()
		{
			define('servidor', 'localhost');
			define('usuario', 'root');
			define('senha', '');
			define('banco', 'banco_protocolo');

			try{				

			    $conectar = new PDO('mysql:host=' . servidor . ';banco_protocolo.sql=' . banco, usuario, senha);
			    return $conectar;
			}
			catch ( PDOException $e ){
			    echo 'Erro ao conectar com o Banco: ' . $e->getMessage();
			}
		}
	}

 ?>




