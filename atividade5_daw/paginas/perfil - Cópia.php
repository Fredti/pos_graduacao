<?php
	include('cabecalho.php');
	
	$participante_obj = new Participante('participantes');
	$participante_obj->setDados(array(urldecode($_GET['email_perfil'])));
	list($participante) = $participante_obj->getListar('and email=?');
	
	$email_cookie = explode('@',$_SESSION['login']['email']);
	
	setcookie('ultimoperfil_'.$email_cookie[0],$participante['email'],time()+3600*24,'/');
?>

<section class="sessao_interna">
	<?php
		include('lado_esquerdo.php');
	?>
	<div class="fundo_informacoes">
		<img src="<?=$url?>/imagens/<?=$participante['arquivoFoto']?>" title="<?=$participante['nomeCompleto']?>" alt="Foto não carregada" />
		
		<div class="dados">
			<h1><?=$participante['nomeCompleto']?></h1>
			<dl>
				<?
					$cidade_obj = new Cidade('cidades');
					$cidade_obj->setDados(array($participante['cidade']));
					list($cidade) = $cidade_obj->getListar('and idCidade=?');
					$cidade_obj->fechar_conexao();
					
					$estado_obj = new Estado('estados');
					$estado_obj->setDados(array($cidade['idEstado']));
					list($estado) = $estado_obj->getListar('and idEstado=?');
					$estado_obj->fechar_conexao();
				?>
				<dt>Cidade:</dt><dd><?=$cidade['nomeCidade']?></dd>
				<dt>Estado:</dt><dd><?=$estado['nomeEstado']?></dd>
				<dt>E-mail:</dt><dd><?=$participante['email']?></dd>
				<dt>Descrição:</dt><dd><?=$participante['descricao']?></dd>
			</dl>				
		</div>
	</div>
	
	<?php include('lado_direito.php');?>
</section>



<?php
	include('rodape.php');
?>