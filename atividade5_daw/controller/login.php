<?php
	session_start();
	include('../includes/conexao.php');
	include('../classes.php');
	include('../url.php');
	
	foreach($_POST as $chave=>$valor){
		$$chave = htmlspecialchars($valor);
	}
	
	$participante_obj = new Participante('participantes');
	$dados = array($login,md5($senha));
	$participante_obj->setDados($dados);
	list($participante) = $participante_obj->getListar('and login=? and senha=?');
	
	if($participante_obj->getQtde()>0 && $participante['login']==$login){
		$_SESSION['login'] = $participante;
		
		if(!empty($_POST['lembrar_usuario']))
			setcookie('lembrar_usuario',$participante['login'],time()+3600*24*120,'/');
		else
			setcookie('lembrar_usuario',$participante['login'],time()-3600*24*120,'/');
			
		header('Location:'.$url.'/paginas/home.php');
	}
	else
		header('Location:'.$url.'/index.php');
?>