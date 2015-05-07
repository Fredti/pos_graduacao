<ul class="ul_participantes">
	<p class="titulos_blocos">Participantes</p>
	<?php
		$participante_obj_esq = new Participante('participantes');
		$participante_obj_esq->setDados(array($_SESSION['login']['email']));
		$participante_rec_esq = $participante_obj_esq->getListar('and email <> ? order by rand() limit 12');
		$participante_obj_esq->fechar_conexao();
		foreach($participante_rec_esq as $participante_esq){?>
			<li>
				<a href="<?=$url?>/paginas/perfil.php?email_perfil=<?=$participante_esq['email']?>">
					<figure>
						<img src="<?=$url?>/imagens/<?=$participante_esq['arquivoFoto']?>" title="<?=$participante_esq['nomeCompleto']?>" alt="Imagem não carregada" />
					</figure>
				</a>
			</li>
	<?	}?>
</ul>