<?php
	
	$checked_login = "";
	$usuario_cookie = "";
	if(!empty($_COOKIE['lembrar_usuario'])){
		$checked_login = 'checked="checked"';
		$usuario_cookie = $_COOKIE['lembrar_usuario'];
	}	
	
	include('includes/conexao.php');
	include('classes.php');
	include('url.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Atividade Aberta 05</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/internas.css" />
	</head>
	
	<body>
		<?
			if(empty($_SESSION['login'])){?>
				<section id="sessao_login">
					<ul id="bloco_fotos_login">
						<?php
							$participante_obj = new Participante('participantes');
							$participante_rec = $participante_obj->getListar('order by rand() limit 30');
							$participante_obj->fechar_conexao();
							foreach($participante_rec as $participante){
								$pagina = 'javascript:void(0);';
								if(!empty($_SESSION['login']))
									$pagina = "paginas/perfil.php";
								?>	
								<li>
									<a href="<?=$pagina?>">
										<figure>
											<img src="<?=$url?>/imagens/<?=$participante['arquivoFoto']?>" title="<?=$participante['nomeCompleto']?>" alt="Imagem não carregada" />
										</figure>
									</a>
								</li>
						<?	}?>
						
						<li id="apresentacao">
							Somos alunos da PUC Minas pós graduandos em Desenvolvimento de Aplicações Web. Venha fazer parte, também, dessa turma.
						</li>
					</ul>
					
					<form method="post" action="controller/login.php">
						<figure>
							<img src="<?=$url?>/imagens/logo_puc.png" />
						</figure>
						
						<input type="text" name="login" id="login" placeholder="Digite aqui seu usuário" value="<?=$usuario_cookie?>" />
						<input type="password" name="senha" id="senha" placeholder="Digite aqui sua senha" />
						
						<div>
							<input type="checkbox" name="lembrar_usuario" id="lembrar_usuario" <?=$checked_login?> />
							<label for="lembrar_usuario">Lembrar usuário</label>
						</div>
						
						<button type="submit">Acessar</button>
						<a class="botao_voltar" href="<?=$url?>/paginas/cadastrar.php">Não possui conta? Cadastre-se</a>
					</form>
				</section>
		<?php
			}
			else{
				header('Location:paginas/home.php');
			}
		?>
	</body>	
	
</html>