<form action="<?=$url?>/paginas/pesquisar.php" method="post" class="pesquisar">
	<p class="titulos_blocos">Filtrar</p>
	<input type="text" name="nome_busca" placeholder="Buscar participantes" />
	<button type="submit">Buscar</button>
</form>

<div class="pesquisar">
	<p class="titulos_blocos">Último perfil visitado</p>
	<?php
		$email_cookie = explode('@',$_SESSION['login']['email']);
		
		if(empty($_COOKIE['ultimoperfil_'.$email_cookie[0]])){?>
			<p id="nenhum_visitado">Nenhum perfil visitado</p>
	<?php
		}
		else{
			$participante_obj_perfil = new Participante('participantes');
			$participante_obj_perfil->setDados(array($_COOKIE['ultimoperfil_'.$email_cookie[0]]));
			list($participante_perfil) = $participante_obj_perfil->getListar('and email=?');
			$participante_obj_perfil->fechar_conexao();
			?>
			<a href="<?=$url?>/paginas/perfil.php?email_perfil=<?=$participante_perfil['email']?>">
				<figure>
					<img src="<?=$url?>/imagens/<?=$participante_perfil['arquivoFoto']?>" alt="Imagem não carregada" title="<?=$participante_perfil['nomeCompleto']?>" />
					<figcaption><?=$participante_perfil['nomeCompleto']." - ".$participante_perfil['email']?></figcaption>
				</figure>
			</a>
	<?php	
		}
	?>
</div>