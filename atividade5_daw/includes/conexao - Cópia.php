<?php
	
	function conexao_mysql(){
		try{
			$host = 'localhost';
			$usuario = 'root';
			$senha='';
			$banco = 'daw_yearbook';
			
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