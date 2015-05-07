<?php
	include('cabecalho.php');
?>

<section class="sessao_interna">
	<?php include('lado_esquerdo.php');?>
	
	<div class="fundo_informacoes">
		<img src="<?=$url?>/imagens/<?=$_SESSION['login']['arquivoFoto']?>" title="<?=$_SESSION['login']['nomeCompleto']?>" alt="Foto não carregada" />
		
		<div class="dados">
			<a href="<?=$url?>/paginas/cadastrar.php">Editar dados</a>
			<a href="javascript:void(0);" onclick="excluir_perfil('excluir_perfil.php');">Excluir meu perfil</a>
			<h1><?=$_SESSION['login']['nomeCompleto']?></h1>
			<dl>
				<?
					$cidade_obj = new Cidade('cidades');
					$cidade_obj->setDados(array($_SESSION['login']['cidade']));
					list($cidade) = $cidade_obj->getListar('and idCidade=?');
					$cidade_obj->fechar_conexao();
					
					$estado_obj = new Estado('estados');
					$estado_obj->setDados(array($cidade['idEstado']));
					list($estado) = $estado_obj->getListar('and idEstado=?');
					$estado_obj->fechar_conexao();
				?>
				<dt>Cidade:</dt><dd><?=$cidade['nomeCidade']?></dd>
				<dt>Estado:</dt><dd><?=$estado['nomeEstado']?></dd>
				<dt>E-mail:</dt><dd><?=$_SESSION['login']['email']?></dd>
				<dt>Descrição:</dt><dd><?=$_SESSION['login']['descricao']?></dd>
			</dl>				
		</div>
	</div>
	
	<?php include('lado_direito.php');?>
</section>



<?php
	include('rodape.php');
?>