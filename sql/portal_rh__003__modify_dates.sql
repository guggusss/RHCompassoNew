ALTER TABLE `admissao` CHANGE `QUALIFIC_CADASTRAL_CEP` `QUALIFIC_CADASTRAL_CEP` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `admissao` CHANGE `CAD_ADM_PLATAFORMA_ADM_DIMIN` `CAD_ADM_PLATAFORMA_ADM_DIMIN` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `admissao` CHANGE `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO` `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `admissao` CHANGE `TERMO_PSI` `TERMO_PSI` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `admissao` CHANGE `INCLUI_ADM_PROV` `INCLUI_ADM_PROV` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `bancarios` CHANGE `ENVIO` `ENVIO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `bancarios` CHANGE `RECEBIDO` `RECEBIDO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `bancarios` CHANGE `PLANILHA_CONTAS` `PLANILHA_CONTAS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `bancarios` CHANGE `FORM_COMPR_BANCARIO` `FORM_COMPR_BANCARIO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `boas_vindas` CHANGE `BOAS_VINDAS_INGR_AGENDADA` `BOAS_VINDAS_INGR_AGENDADA` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `boas_vindas` CHANGE `BOAS_VINDAS_INGR_REALIZADA` `BOAS_VINDAS_INGR_REALIZADA` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `boas_vindas` CHANGE `LAYOUT_BOAS_VINDAS_MENSAL` `LAYOUT_BOAS_VINDAS_MENSAL` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `documentacao` CHANGE `FORMULARIOS_ENVIADOS` `FORMULARIOS_ENVIADOS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `documentacao` CHANGE `FORMULARIOS_RECEBIDOS` `FORMULARIOS_RECEBIDOS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `documentacao` CHANGE `DOCUMENTOS_FISICOS` `DOCUMENTOS_FISICOS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `documentacao` CHANGE `CTPS_RECEBIDA` `CTPS_RECEBIDA` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `exame_admissional` CHANGE `AGENDAMENTO_EXAM_ADM` `AGENDAMENTO_EXAM_ADM` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `exame_admissional` CHANGE `ENVIO_FUNC_EXAME` `ENVIO_FUNC_EXAME` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `exame_admissional` CHANGE `EMAIL_RECEBIDO_EXAM` `EMAIL_RECEBIDO_EXAM` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `interno` CHANGE `INTRANET_CADASTRO_USUARIO` `INTRANET_CADASTRO_USUARIO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `interno` CHANGE `KAIROS_CADASTRO_USUARIO` `KAIROS_CADASTRO_USUARIO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `interno` CHANGE `EMAIL_INICIO_ATIVIDADES` `EMAIL_INICIO_ATIVIDADES` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `interno` CHANGE `EMAIL_BOAS_VINDAS` `EMAIL_BOAS_VINDAS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `interno` CHANGE `ACESSOS` `ACESSOS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `ENQUADRAMENTO_REMUNERACAO_ENVIO` `ENQUADRAMENTO_REMUNERACAO_ENVIO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `ENQUADRAMENTO_REMUNERACAO_RETORNO` `ENQUADRAMENTO_REMUNERACAO_RETORNO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `ENVIO_PROPOSTA` `ENVIO_PROPOSTA` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `COMUNICAR_PROPOSTA_ENVIADA` `COMUNICAR_PROPOSTA_ENVIADA` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `ACEITE_RECUSA_CANDIDATO` `ACEITE_RECUSA_CANDIDATO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `propostas_contratacoes` CHANGE `COMUNICAR_STATUS` `COMUNICAR_STATUS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `CRACHA_DATA_PEDIDO` `CRACHA_DATA_PEDIDO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `CRACHA_CONTROLE` `CRACHA_CONTROLE` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `CRACHA_PROTOCOLO` `CRACHA_PROTOCOLO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `EMAIL_CADERNO_COMPASSO_SOLICITADO` `EMAIL_CADERNO_COMPASSO_SOLICITADO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `EMAIL_CADERNO_COMPASSO_RECEBIDO` `EMAIL_CADERNO_COMPASSO_RECEBIDO` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `MALOTE_CADERNO_COMPASSO_CTPS` `MALOTE_CADERNO_COMPASSO_CTPS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `DOCUMENTOS_RECEBIDOS_ASSINADOS` `DOCUMENTOS_RECEBIDOS_ASSINADOS` VARCHAR(10) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` CHANGE `SALVAR_PASTA` `SALVAR_PASTA` VARCHAR(10) DEFAULT NULL;