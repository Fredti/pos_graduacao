<?php
	
	function conexao_mysql(){
		try{
			$host = 'br-cdbr-azure-south-a.cloudapp.net';
			$usuario = 'b9e1b97842c6b5';
			$senha='5b46fe4e';
			$banco = 'fredtidb';
			
			$string_conexao = "mysql:host=$host;port=$porta;dbname=$banco";
			
			$con = new PDO($string_conexao,$usuario,$senha);
			
			return $con;
		}
		catch(PDOException $e){
			echo 'Erro: '.$e->getMessage().'<br />';
			die();
		}
	}
?>