<?php
	include('../includes/conexao.php');
	include('../classes.php');
	include('../url.php');
	
	$obrigatorio=0;
	
	if(empty($_SESSION['login']))
		$_SESSION['login'] = null;
	else
		$obrigatorio=1;
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Atividade Aberta 05 - Cadastre-se</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/cadastro.css" />
		
		<script src="../js/jquery-1.7.2.js" ></script>
		<script src="../js/funcoes.js" ></script>
	</head>
	
	<body>
		
		<section>
			<?php
				if(!empty($_SESSION['sucesso'])){?>
					<div class="alerta">Cadastro efetuado com sucesso!</div>
			<?php	
					unset($_SESSION['sucesso']);
				}?>
			<fieldset>
				<legend>faça seu cadastro</legend>
				
				<form method="post" action="../controller/cadastrar.php" enctype="multipart/form-data" class="form_cadastro">
					<input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="Digite seu nome" value="<?=$_SESSION['login']['nomeCompleto']?>" />
					<input type="text" name="email" id="email" placeholder="Digite seu email" value="<?=$_SESSION['login']['email']?>" />
						
					<?php
						
						if(!empty($_SESSION['login'])){
							$cidade_obj_busca = new Cidade('cidades');
							list($cidade_rec_busca) = $cidade_obj_busca->getBuscarPorId($_SESSION['login']['cidade']);
							
							$estado_obj_busca = new Estado('estados');
							list($estado_rec_busca) = $estado_obj_busca->getBuscarPorId($cidade_rec_busca['idEstado']);
						}
					?>
					
					<select name="idEstado" id="idEstado" onchange="mostrar_cidades('cidade',this.value,'mostrar_cidades.php');">
						<option value="">Estado...</option>
						<?php
							$estado_obj = new Estado('estados');
							$estado_rec = $estado_obj->getListar('order by nomeEstado asc');
							foreach($estado_rec as $estado){
								$selected='';
								if(!empty($_SESSION['login'])){
									if($estado['idEstado']==$estado_rec_busca['idEstado'])
										$selected = 'selected="selected"';
								}
								?>
								<option value="<?=$estado['idEstado']?>" <?=$selected?>><?=$estado['nomeEstado']?></option>
						<?php
							}
						?>
					</select>
					
					<select name="cidade" id="cidade">
						<option value="">Cidade...</option>
						<?php
							if(!empty($_SESSION['login'])){
								$cidade_obj_aux = new Cidade('cidades');
								$cidade_obj_aux->setDados(array($estado_rec_busca['idEstado']));
								$cidade_aux_busca = $cidade_obj_aux->getListar('and idEstado=?');
								foreach($cidade_aux_busca as $cidade_aux){
									$selected='';
									if($_SESSION['login']['cidade']==$cidade_aux['idCidade'])
										$selected = 'selected="selected"';
									?>
									<option value="<?=$cidade_aux['idCidade']?>" <?=$selected?>><?=$cidade_aux['nomeCidade']?></option>
						<?php
								}
							}
						?>
					</select>
					
					<input type="text" name="login" id="login" placeholder="Digite um usuário" value="<?=$_SESSION['login']['login']?>" />
					<input type="password" name="senha" id="senha" placeholder="Digite uma senha" />
					<input type="file" name="arquivoFoto" id="arquivoFoto" /> <label>Apenas jpg, png e gif.</label>
					<?	
						if(!empty($_SESSION['login'])){?>
							<figure>
								<img src="<?=$url?>/imagens/<?=$_SESSION['login']['arquivoFoto']?>" alt="Imagem não carregada" title="<?=$_SESSION['login']['nomeCompleto']?>" />
							</figure>
					<?	}?>
					<textarea name="descricao" id="descricao" placeholder="Fale sobre você..."><?=$_SESSION['login']['descricao']?></textarea>
					
					<button type="button" onclick="validar_formulario('form_cadastro','<?=$obrigatorio?>');">Salvar</button>
					<a href="../index.php">Voltar</a>
				</form>
			</fieldset>
		</section>	
	</body>
</html>