<?php
	
	session_start();
	
	include('../includes/conexao.php');
	include('../classes.php');
	
	$participante_obj = new Participante('participantes');
	$participante_obj->deletar('email',$_SESSION['login']['email']);
	
	header('Location:logoff.php');
?>