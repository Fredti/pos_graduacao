function validar_formulario(classe,obrigatorio){
	var i,j,campos,id,elementos,tem_vazio=0;
	
	campos = $('.'+classe).find('*');
	for(i=0;i<campos.length;i++){
		if((campos[i].id).length>0){
			valores = $('#'+campos[i].id).val();
			
			if(valores.length==0){
				if(campos[i].id!="arquivoFoto" || obrigatorio==0){
					$('#'+campos[i].id).css({'border':'solid thin #F00'});
					tem_vazio=1;
				}
			}
			else
				$('#'+campos[i].id).css({'border':'solid thin #CCC'});
			
			if(campos[i].id=="arquivoFoto" && valores.length>0){
				var arquivo = valores.split('.');
				var nome_arquivo="",extensao;
				for(j=0;j<arquivo.length;j++){
					if(j==arquivo.length-1)
						extensao = arquivo[j];
				}
				if(extensao!="jpg" && extensao!="png" && extensao!="gif"){
					$('#'+campos[i].id).css({'border':'solid thin #F00'});
					tem_vazio=1;
				}
			}
		}
	}
	if(tem_vazio==0)
		$('.'+classe).submit();
}

function mostrar_cidades(id,valor,arquivo){
	$('#'+id).html('<option value="">Carregando...</option>');
	
	$.ajax({
		 url: "../paginas/"+arquivo,
		 type: "POST",
		 dataType: "text",
		 data: {
			 "id_estado":valor
		 },
		 success: function(resposta){
			 var retorno = resposta;  //responsavel por receber o retorno do arquivo se executou com sucesso ou nao
			 var objeto = eval(retorno);
			 
			 $('#'+id).html('');
			 for(var i=0;i<objeto.length;i++){
				$('#'+id).append('<option value="'+objeto[i].idCidade+'">'+objeto[i].nomeCidade+'</option>');
			}
		 }
	});
	
	//var teste = $('#'+id).load('../paginas/'+arquivo,{id_estado:valor});
}
function excluir_perfil(pagina){
	if(confirm('Tem certeza que deseja excluir seu perfil?')){
		window.location.href='../controller/excluir_perfil.php';
	}
}