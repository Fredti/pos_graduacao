<?php
	include('cabecalho.php');
	$busca = htmlspecialchars($_POST['nome_busca']);
	$descricao_busca = '%'.$busca.'%';
	
	$participante_busca_obj = new Participante('participantes');
	$participante_busca_obj->setDados(array($descricao_busca));
	$participante_rec_busca = $participante_busca_obj->getListar('and nomeCompleto like ? order by nomeCompleto asc');
?>

<section class="sessao_interna">
	<?php include('lado_esquerdo.php'); ?>
	
	<ul id="fundo_informacoes_busca">
		<?php
			if($participante_busca_obj->getQtde()>0){
				foreach($participante_rec_busca as $participante_busca){?>
					<li>
						<a href="<?=$url?>/paginas/perfil.php?email_perfil=<?=$participante_busca['email']?>">
							<figure>
								<img src="<?=$url?>/imagens/<?=$participante_busca['arquivoFoto']?>" title="<?=$participante_busca['nomeCompleto']?>" alt="Imagem não carregada" />
								<figcaption><?=$participante_busca['nomeCompleto']?></figcaption>
							</figure>
						</a>
					</li>
		<?php
				}
			}
			else{?>
				<p>Nenhum resultado encontrado.</p>
		<?php
			}
		?>
	</ul>
	
	<?php include('lado_direito.php'); ?>
</section>



<?php
	include('rodape.php');
?>