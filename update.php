<?php
	include("db/conexao.php");
	require_once('db/serverLDAP.php');

	
		function listar($conn){
			$query = "SELECT * from sede";
			$resultado = mysqli_query($conn, $query);
			return $resultado;
		}

		//retorna a sede especifica de um funcionario
		function buscaSedeFuncionario($conn, $id){
			$query = "SELECT nome_sede from sede where sede_id = '{$id}'";
			$sede = mysqli_query($conn, $query);
			return mysqli_fetch_assoc($sede);
		}
		//retorna o cargo especifico de um funcionario
		
		function buscaCargoFuncionario($conn, $id){
			$query = "SELECT CARGO FROM admissao_dominio WHERE USUARIO_ID = '{$id}'";
			$cargo = mysqli_query($conn, $query);
			return mysqli_fetch_assoc($cargo);
		}
		//retorna o tipo especifico de um funcionario
		function buscaTipoFuncionario($conn, $id){
			$query = "SELECT NOME_TIPO FROM tipo WHERE TIPO_ID = '{$id}'";
			$tipo = mysqli_query($conn, $query);
			return mysqli_fetch_assoc($tipo);
		}
		//retorna a captação especifica de um funcionario
		function buscaCaptacaoFuncionario($conn, $id){
			$query = "SELECT NOME_PARAMETRO FROM parametros_captacao WHERE CAPTACAO_ID = '{$id}'";
			$captacao = mysqli_query($conn, $query);
			return mysqli_fetch_assoc($captacao);
		}

		function buscaUsuario($conn, $email){
			$query = "SELECT * FROM suporte_interno WHERE USUARIO = '$email'";
			$resposta = mysqli_query($conn, $query);
			$resposta = mysqli_num_rows($resposta);
			return $resposta;
		}


		function buscaUsuarioCompasso($link, $email){

			
			$usuario = $_SESSION['usuario'];
			$senha = $_SESSION['senha'];

			// Versao do protocolo       
			ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3);
			// Usara as referencias do servidor AD, neste caso nao
			ldap_set_option($link, LDAP_OPT_REFERRALS, 0);

			$dominio = "pampa.compasso";


			$r = @ldap_bind($link, $usuario . '@' . $dominio, $senha);
			
			

			$filtro = "(samaccountname=" . $email . ")";
			$justthese = array("*");
			$res = ldap_search($link, "dc=pampa,dc=compasso", $filtro, $justthese);
			$saida = ldap_get_entries($link, $res);
			
			
			return $saida['count'];

			
		}


		function defineUser($link, $meuNome, $id){
			//array para comparar depois se o nome da pessoa tem agnome, se tiver, tem que ser ignorado
			$agnomes = ["junior", "jr.", "segundo", "filho", "neto", "sobrinho", "jr", "bisneto", "filha", "juniar", "jra.", "segunda", "neta", "sobrinha", "bisneta"];
			//remove acento
			$meuNome = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$meuNome);
			$meuNome = strtolower($meuNome);
			//separa
			$meuNome = explode(' ', $meuNome);
			$nome = $meuNome[0];
			$conta = count($meuNome);
			$sobrenome = $meuNome[$conta-1];
			//conta
			$max = count($agnomes);
			for($i = 0; $i < $max; $i++) {
			  if(strcmp($sobrenome, $agnomes[$i]) == 0) {
				$sobrenome = $meuNome[$conta-2];
				$email = $nome.".". $sobrenome;
				$conta = $conta - 1;
			  } else {
				$email = $nome.".". $sobrenome;
			}
		  }

		 
		  $verifica = buscaUsuarioCompasso($link, $email);
		  if($verifica > 0 AND $conta == 2){
			$email = $nome.".".$sobrenome.$id;
			}
		  //se tem no banco
		
		  $verifica2 = buscaUsuarioCompasso($link, $email);
		  if($verifica2 > 0){
			$sobrenome = $meuNome[$conta-2];
			$email = $nome.".". $sobrenome;
			}

			$verifica3 = buscaUsuarioCompasso($link, $email);
			if($verifica3 > 0){
				$sobrenome = $meuNome[$conta-3];
				$email = $nome.".". $sobrenome;
			}

		return $email;
		}

	// ################# BUSCA PELA TABELA INICIAL ADMISSAO_DOMINIO ###########################

	function projeto($conn, $USUARIO_ID, $PROJETO){
	$query = "UPDATE admissao_dominio set PROJETO = '{$PROJETO}' where USUARIO_ID = '$USUARIO_ID'";
	return mysqli_query($conn, $query);
	}
	function status($conn, $USUARIO_ID, $STATUS){
		$query = "UPDATE admissao_dominio set STATUS = '{$STATUS}' where USUARIO_ID = '$USUARIO_ID'";
		return mysqli_query($conn, $query);
	}

	function buscaFuncionarios($conn, $id) {
		$query = "SELECT * from admissao_dominio where USUARIO_ID = '{$id}'";
		$buscafuncionarios = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($buscafuncionarios);
	}

	function funcionario($conn, $USUARIO_ID, $ID_SEDE, $ID_TIPO, $ID_CAPTACAO, $CARGA_HORARIA, $HORARIO, $NOME, $SEXO, $FONE_CONTATO, $DATA_ADMISSAO, $CARGO, $SOLICITANTE, $LOG_REGISTRO_DIA_RH_ENVIA_DP, $REMUNERACAO_BASE, $GRATIFICACAO, $CLIENTE, $PROJETO, $EMAIL, $ADMINISTRATIVO, $POSICAO_COMENTARIO, $COMENTARIOS) {
		$query = "UPDATE admissao_dominio set ID_SEDE = '{$ID_SEDE}', ID_TIPO = '{$ID_TIPO}', ID_CAPTACAO = '{$ID_CAPTACAO}', CARGA_HORARIA = '{$CARGA_HORARIA}', HORARIO = '{$HORARIO}', NOME = '{$NOME}', SEXO = '{$SEXO}', FONE_CONTATO = '{$FONE_CONTATO}', DATA_ADMISSAO = '{$DATA_ADMISSAO}', CARGO = '{$CARGO}', SOLICITANTE = '{$SOLICITANTE}', LOG_REGISTRO_DIA_RH_ENVIA_DP = '{$LOG_REGISTRO_DIA_RH_ENVIA_DP}', REMUNERACAO_BASE = '{$REMUNERACAO_BASE}', GRATIFICACAO = '{$GRATIFICACAO}', CLIENTE = '{$CLIENTE}', PROJETO = '{$PROJETO}', EMAIL='{$EMAIL}', ADMINISTRATIVO = '{$ADMINISTRATIVO}', POSICAO_COMENTARIO = '{$POSICAO_COMENTARIO}',  COMENTARIOS = '{$COMENTARIOS}'  where USUARIO_ID = '{$USUARIO_ID}'";
		return mysqli_query($conn, $query);
	}

		// ################# BUSCA PELA PAGINA BANCARIO ###########################
	function buscaBancario($conn, $id) {
		$query = "SELECT * from bancarios where ID_USUARIO = '{$id}'";
		$bancarios = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($bancarios);
	}

	function bancario($conn, $ID_USUARIO, $ENVIO, $RECEBIDO, $PLANILHA_CONTAS, $FORM_COMPR_BANCARIO, $AGENCIA, $NUMERO_CONTA, $TIPO_CONTA) {
		$query = "UPDATE bancarios set ENVIO = '{$ENVIO}', RECEBIDO ='{$RECEBIDO}', PLANILHA_CONTAS ='{$PLANILHA_CONTAS}', FORM_COMPR_BANCARIO = '{$FORM_COMPR_BANCARIO}', AGENCIA = '{$AGENCIA}', NUMERO_CONTA = '{$NUMERO_CONTA}', TIPO_CONTA = '{$TIPO_CONTA}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA FUNCIONARIO ###########################
	function Proposta($conn, $ID_USUARIO, $ENQUADRAMENTO_REMUNERACAO_ENVIO, $ENQUADRAMENTO_REMUNERACAO_RETORNO, $ENQUADRAMENTO, $ENVIO_PROPOSTA, $COMUNICAR_PROPOSTA_ENVIADA,$ACEITA_RECUSA_CANDIDATO, $COMENTARIO, $COMUNICAR_STATUS){
		$query = "UPDATE propostas_contratacoes set ENQUADRAMENTO_REMUNERACAO_ENVIO = '{$ENQUADRAMENTO_REMUNERACAO_ENVIO}', ENQUADRAMENTO_REMUNERACAO_RETORNO = '{$ENQUADRAMENTO_REMUNERACAO_RETORNO}', ENQUADRAMENTO = '{$ENQUADRAMENTO}', ENVIO_PROPOSTA = '{$ENVIO_PROPOSTA}', COMUNICAR_PROPOSTA_ENVIADA = '{$COMUNICAR_PROPOSTA_ENVIADA}', ACEITE_RECUSA_CANDIDATO = '{$ACEITA_RECUSA_CANDIDATO}', COMENTARIO = '{$COMENTARIO}', COMUNICAR_STATUS = '{$COMUNICAR_STATUS}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}

	function buscaProposta($conn, $id) {
		$query = "SELECT * from propostas_contratacoes where ID_USUARIO = '{$id}'";
		$funcionarios = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($funcionarios);
	}


		// ################# BUSCA PELA PAGINA DOCUMENTOS ###########################
	function buscadocs($conn, $id) {
		$query = "SELECT * from documentacao where ID_USUARIO = '{$id}'";
		$docs = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($docs);
	}

	function Documentacao($conn, $ID_USUARIO, $FORMULARIOS_ENVIADOS, $FORMULARIOS_RECEBIDOS, $DOCUMENTOS_FISICOS, $CTPS_RECEBIDA, $COMENTARIO){
		$query = "UPDATE documentacao set FORMULARIOS_ENVIADOS = '{$FORMULARIOS_ENVIADOS}', FORMULARIOS_RECEBIDOS = '{$FORMULARIOS_RECEBIDOS}', DOCUMENTOS_FISICOS = '{$DOCUMENTOS_FISICOS}', CTPS_RECEBIDA = '{$CTPS_RECEBIDA}', COMENTARIO = '{$COMENTARIO}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA ADMISSAO ###########################
	function buscaadmissao($conn, $id) {
		$query = "SELECT * from admissao where ID_USUARIO = '{$id}'";
		$admissoes = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($admissoes);
	}

	function admissao($conn, $ID_USUARIO, $QUALIFIC_CADASTRAL_CEP, $CAD_ADM_PLATAFORMA_ADM_DIMIN, $DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO, $TERMO_PSI, $INCLUI_ADM_PROV, $COMENTARIO){
		$query = "UPDATE admissao set QUALIFIC_CADASTRAL_CEP = '{$QUALIFIC_CADASTRAL_CEP}', CAD_ADM_PLATAFORMA_ADM_DIMIN = '{$CAD_ADM_PLATAFORMA_ADM_DIMIN}', DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO = '{$DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO}', TERMO_PSI = '{$TERMO_PSI}', INCLUI_ADM_PROV = '{$INCLUI_ADM_PROV}', COMENTARIO = '{$COMENTARIO}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA EXAME ###########################
	function buscaexame ($conn, $id) {
		$query = "SELECT * from exame_admissional where ID_USUARIO = '{$id}'";
		$exame = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($exame);
	}

	function exame($conn, $ID_USUARIO, $AGENDAMENTO_EXAM_ADM, $ENVIO_FUNC_EXAME, $EMAIL_RECEBIDO_EXAM, $COMENTARIO){
		$query = "UPDATE exame_admissional set AGENDAMENTO_EXAM_ADM = '{$AGENDAMENTO_EXAM_ADM}', ENVIO_FUNC_EXAME='{$ENVIO_FUNC_EXAME}', EMAIL_RECEBIDO_EXAM = '{$EMAIL_RECEBIDO_EXAM}', COMENTARIO = '{$COMENTARIO}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA SUPORTE INTERNO ###########################
	function buscasuporte ($conn, $id) {
		$query = "SELECT * FROM suporte_interno WHERE ID_USUARIO = '{$id}'";
		$suporte = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($suporte);
	}

	function buscasuporteExiste ($conn, $usuario) {
		$query = $conn->query("SELECT COUNT(USUARIO) as conta FROM `suporte_interno` WHERE USUARIO = '{$usuario}'");
		$suporte = $query->fetch_assoc();
		return (int) $suporte["conta"];
	}

	function suporte ($conn, $ID_USUARIO, $EMAIL_SUP, $USUARIO, $SENHA, $EQUIPAMENTO, $TRANSLADO, $EQUIPE){
		// Converte de Array para String:
		if ($EQUIPE != "") {
				$STR_EQUIPE = implode(",", $EQUIPE);
		}else{
			$STR_EQUIPE = "";
		}


		$query = "UPDATE suporte_interno set EMAIL_SUP = '{$EMAIL_SUP}', USUARIO='{$USUARIO}', SENHA = '{$SENHA}', EQUIPAMENTO='{$EQUIPAMENTO}',TRANSLADO = '{$TRANSLADO}', EQUIPE = '{$STR_EQUIPE}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA INTERNO ###########################
	function buscainterno ($conn, $id) {
		$query = "SELECT * FROM interno WHERE ID_USUARIO = '{$id}'";
		$interno = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($interno);
	}

	function interno ($conn, $ID_USUARIO, $INTRANET_CADASTRO_USUARIO, $INTRANET_CADASTRO_SENHA, $KAIROS_CADASTRO_USUARIO, $KAIROS_CADASTRO_SENHA, $EMAIL_GESTOR_APOIO_SEDE, $EMAIL_INICIO_ATIVIDADES, $EMAIL_BOAS_VINDAS, $ACESSOS){
		$query = "UPDATE interno set INTRANET_CADASTRO_USUARIO = '{$INTRANET_CADASTRO_USUARIO}', INTRANET_CADASTRO_SENHA ='{$INTRANET_CADASTRO_SENHA}', KAIROS_CADASTRO_USUARIO = '{$KAIROS_CADASTRO_USUARIO}', KAIROS_CADASTRO_SENHA ='{$KAIROS_CADASTRO_SENHA}', EMAIL_GESTOR_APOIO_SEDE = '{$EMAIL_GESTOR_APOIO_SEDE}', EMAIL_INICIO_ATIVIDADES = '{$EMAIL_INICIO_ATIVIDADES}', EMAIL_BOAS_VINDAS ='{$EMAIL_BOAS_VINDAS}', ACESSOS = '{$ACESSOS}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


		// ################# BUSCA PELA PAGINA VIAS DOCUMENTOS ###########################
	function buscavias ($conn, $id) {
		$query = "SELECT * FROM vias_documentos_funcionarios WHERE ID_USUARIO = '{$id}'";
		$vias = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($vias);
	}

	function viasDocs($conn, $ID_USUARIO, $CRACHA_DATA_PEDIDO, $CRACHA_CONTROLE, $CRACHA_PROTOCOLO, $EMAIL_CADERNO_COMPASSO_SOLICITADO, $EMAIL_CADERNO_COMPASSO_RECEBIDO, $MALOTE_CADERNO_COMPASSO_CTPS, $DOCUMENTOS_RECEBIDOS_ASSINADOS, $SALVAR_PASTA){
		$query = "UPDATE vias_documentos_funcionarios set `CRACHA_DATA_PEDIDO`= '{$CRACHA_DATA_PEDIDO}',`CRACHA_CONTROLE`= '{$CRACHA_CONTROLE}',`CRACHA_PROTOCOLO`= '{$CRACHA_PROTOCOLO}', EMAIL_CADERNO_COMPASSO_SOLICITADO = '{$EMAIL_CADERNO_COMPASSO_SOLICITADO}', EMAIL_CADERNO_COMPASSO_RECEBIDO ='{$EMAIL_CADERNO_COMPASSO_RECEBIDO}', MALOTE_CADERNO_COMPASSO_CTPS = '{$MALOTE_CADERNO_COMPASSO_CTPS}', DOCUMENTOS_RECEBIDOS_ASSINADOS ='{$DOCUMENTOS_RECEBIDOS_ASSINADOS}', SALVAR_PASTA ='{$SALVAR_PASTA}' where ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}

		// ################# BUSCA PELA PAGINA BOAS VINDAS ###########################
	function buscaRecepcao ($conn, $id) {
		$query = "SELECT * FROM boas_vindas WHERE ID_USUARIO = '{$id}'";
		$boasvindas = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($boasvindas);
	}

	function recepcao ($conn, $ID_USUARIO, $BOAS_VINDAS_INGR_AGENDADA, $BOAS_VINDAS_INGR_REALIZADA, $BOAS_VINDAS_SALA, $LAYOUT_BOAS_VINDAS_MENSAL){
		$query = "UPDATE `boas_vindas` SET  `BOAS_VINDAS_INGR_AGENDADA`= '{$BOAS_VINDAS_INGR_AGENDADA}',`BOAS_VINDAS_INGR_REALIZADA`= '{$BOAS_VINDAS_INGR_REALIZADA}',`BOAS_VINDAS_SALA`= '{$BOAS_VINDAS_SALA}', `LAYOUT_BOAS_VINDAS_MENSAL`= '{$LAYOUT_BOAS_VINDAS_MENSAL}' WHERE ID_USUARIO = '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}


	// ########################## BUSCA PELA TELA GESTAO ################ //

	function buscagestao ($conn, $id){
		$query = "SELECT * FROM gestao WHERE ID_USUARIO = '{$id}'";
		$gestao = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($gestao);
	}

	function gestao($conn, $ID_USUARIO, $GESTOR, $GESTOR_SABE, $GESTOR_LOCAL, $GESTOR_LOCAL_sABE, $RECEPTOR_PESSOA){
		$query = "UPDATE `gestao` SET `GESTOR` = '{$GESTOR}', `GESTOR_SABE` = '{$GESTOR_SABE}', `GESTOR_LOCAL` = '{$GESTOR_LOCAL}', `GESTOR_LOCAL_sABE` = '{$GESTOR_LOCAL_sABE}', `RECEPTOR_PESSOA`= '{$RECEPTOR_PESSOA}' where `ID_USUARIO`= {$ID_USUARIO}";
		return mysqli_query($conn, $query);
	}

	// ######################### BUSCA PELA TELA VENCIMENTOS CONTRATOS ########### //

	function buscavencimentos ($conn, $id){
		$query = "SELECT * FROM vencimentos WHERE ID_USUARIO = '{$id}'";
		$vencimentos = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($vencimentos);
	}
	function vencimentos($conn, $ID_USUARIO, $ENVIO_SOLICITANTE_PRI, $DATA_VENCIMENTO_PRI, $RENOVACAO, $ENVIO_SOLICITANTE_SEG, $EFETIVACAO, $DATA_VENCIMENTO_SEG){
		$query = "UPDATE `vencimentos` SET `ENVIO_SOLICITANTE_PRI` = '{$ENVIO_SOLICITANTE_PRI}', `DATA_VENCIMENTO_PRI` = '{$DATA_VENCIMENTO_PRI}', `RENOVACAO` = '{$RENOVACAO}', `ENVIO_SOLICITANTE_SEG`= '{$ENVIO_SOLICITANTE_SEG}', `DATA_VENCIMENTO_SEG`= '{$DATA_VENCIMENTO_SEG}', `EFETIVACAO`= '{$EFETIVACAO}'  where `ID_USUARIO`= '{$ID_USUARIO}'";
		return mysqli_query($conn, $query);
	}

	function calculo($conn, $status, $id) {

		$controleDataAdmissao = date_create($status['DATA_ADMISSAO']);
		date_modify($controleDataAdmissao, '+ 44 day');
		$vencimentoPri = date_format($controleDataAdmissao, 'Y-m-d');
		$vencimentoPriAux = date_create($vencimentoPri);
		date_modify($vencimentoPriAux, '- 10 day');
		$envioSolicitante1 = date_format($vencimentoPriAux, 'Y-m-d');
		$controleDataAdmissao2 = date_create($status['DATA_ADMISSAO']);
		date_modify($controleDataAdmissao2, '+ 89 day');
		$vencimentoSec =  date_format($controleDataAdmissao2, 'Y-m-d');
		$vencimentoSecAux = date_create($vencimentoSec);;
		date_modify($vencimentoSecAux, '- 10 day');
		$envioSolicitante2 = date_format($vencimentoSecAux, 'Y-m-d');
	
		$resultado = mysqli_query($conn, "UPDATE `vencimentos` SET `ENVIO_SOLICITANTE_PRI` = '{$envioSolicitante1}', `DATA_VENCIMENTO_PRI` = '{$vencimentoPri}', `ENVIO_SOLICITANTE_SEG`= '{$envioSolicitante2}', `DATA_VENCIMENTO_SEG`= '{$vencimentoSec}'  where `ID_USUARIO`= '{$id}'");
	
		return $resultado;
	}
	
		// ################# Funções para Deletar ###########################

		function deleteAD($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM admissao_dominio where USUARIO_ID = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deletePC($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deletePC($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM propostas_contratacoes where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteG($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteG($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM gestao where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteVC($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteVC($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM vencimentos where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteD($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteD($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM documentacao where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteA($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteA($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM admissao where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteEA($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteEA($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM exame_admissional where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteDB($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteDB($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM bancarios where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteSI($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteSI($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM suporte_interno where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteI($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteI($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM interno where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteVD($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteVD($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM vias_documentos_funcionarios where ID_USUARIO = '$USUARIO_ID'";
			if($STATUS == "EXCLUIDO"){
				deleteBV($conn, $USUARIO_ID, $STATUS);
			}
			return mysqli_query($conn, $query);
		}
	
		function deleteBV($conn, $USUARIO_ID, $STATUS){
			$query = "DELETE FROM boas_vindas where ID_USUARIO = '$USUARIO_ID'";
			return mysqli_query($conn, $query);
		}
?>