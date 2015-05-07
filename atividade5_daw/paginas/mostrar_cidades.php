<?php
	
	include('../includes/conexao.php');
	include('../classes.php');
	
	$id_estado = $_POST['id_estado'];
	
	$cidade_obj = new Cidade('cidades');
	$cidade_obj->setDados(array($id_estado));
	$cidade_rec = $cidade_obj->getListar('and idEstado=?');
	$cidade_obj->fechar_conexao();
	
	$cidade_json = json_encode($cidade_rec);
	echo $cidade_json;
	
	/*
	foreach($cidade_rec as $cidade){?>
		<option value="<?=$cidade['idCidade']?>"><?=$cidade['nomeCidade']?></option>
<?php
	}*/
?>