Create DATABASE `bancorh`;

CREATE TABLE if not EXISTS `parametros_captacao` (
 `CAPTACAO_ID` int(11),
 `NOME_PARAMETRO` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 PRIMARY KEY (`CAPTACAO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `parametros_captacao`(`CAPTACAO_ID`, `NOME_PARAMETRO`) VALUES ('1' ,'Ex-Funcionario'), ('2', 'Ex-Bolsista'), ('3', 'Ex-Estagiario'), ('4', 'NOVO');


CREATE TABLE if not EXISTS `sede` (
 `SEDE_ID` int(11),
 `NOME_SEDE` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 PRIMARY KEY (`SEDE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sede`(`SEDE_ID`, `NOME_SEDE`) VALUES ('1', 'CWB'), ('2', 'ERE'), ('3', 'PF'), ('4', 'POA'), ('5', 'RG'), ('6', 'SP'), ('7', 'FLN'), ('8', 'XAP'), ('9', 'REC');


CREATE TABLE if not EXISTS `tipo` (
 `TIPO_ID` int(11),
 `NOME_TIPO` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 PRIMARY KEY (`TIPO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tipo`(`TIPO_ID`, `NOME_TIPO`) VALUES ('1', 'CLT'), ('2', 'CC'), ('3', 'HO'), ('4', 'TEMP'), ('5', 'APDZ');

CREATE TABLE if not EXISTS `usuario_atv` (
 `USUARIO_ATIVO` int(11),
 `USUARIO_ATV` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 PRIMARY KEY (`USUARIO_ATIVO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario_atv`(`USUARIO_ATIVO`, `USUARIO_ATV`) VALUES ('1' ,'Ex-Funcionario'), ('2', 'Ex-Bolsista'), ('3', 'Ex-Estagiario'), ('4', 'NOVO');

CREATE TABLE If not EXISTS`admissao_dominio` (
`USUARIO_ID` int(11) NOT NULL AUTO_INCREMENT,
`ID_CAPTACAO` int DEFAULT NULL,
`STATUS` varchar(45) NOT NULL,
`ID_SEDE` int DEFAULT NULL,
`ID_TIPO` int DEFAULT NULL,
`SEXO` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
`CARGA_HORARIA` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
`HORARIO` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
`NOME` varchar(40) DEFAULT NULL,
`FONE_CONTATO` varchar(45) DEFAULT NULL,
 `CARGO` varchar(45) DEFAULT NULL,
`LOG_REGISTRO_DIA_RH_ENVIA_DP` text DEFAULT NULL,
`REMUNERACAO_BASE` decimal(7,2) DEFAULT NULL,
 `GRATIFICACAO` decimal(7,2) DEFAULT NULL,
`SOLICITANTE` varchar(45) DEFAULT NULL,
`PROJETO` varchar(100) DEFAULT NULL,
`CLIENTE` varchar(45) DEFAULT NULL,
`EMAIL` varchar(45) DEFAULT NULL,
`DATA_ADMISSAO` date DEFAULT NULL,
`POSICAO_DATA` date  DEFAULT NULL,
`POSICAO_COMENTARIO` VARCHAR(45)  DEFAULT NULL,
`ADMINISTRATIVO` varchar(100) DEFAULT NULL,
`COMENTARIOS` varchar(200) DEFAULT NULL,
 PRIMARY KEY (`USUARIO_ID`),
  CONSTRAINT `fk_ID_CAPTACAO_ADMISSAO_DOMINIO_CAP`
  FOREIGN KEY (`ID_CAPTACAO`)
  REFERENCES `parametros_captacao` (`CAPTACAO_ID`),
  FOREIGN KEY (`ID_SEDE`)
  REFERENCES `sede` (`SEDE_ID`),
  FOREIGN KEY (`ID_TIPO`)
  REFERENCES `tipo` (`TIPO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE if not exists `propostas_contratacoes` (
  `PROPOSTA_ID` int(10) not null auto_increment,
  `ID_USUARIO` int(11) not null,
  `PROPOSTA_RECEBIDA` date DEFAULT NULL,
  `DE_ACORDO_DIRECAO` date DEFAULT NULL,
  `ENQUADRAMENTO` varchar(110) DEFAULT NULL,
  `ENVIO_PROPOSTA` date DEFAULT NULL,
  `COMUNICAR_PROPOSTA_ENVIADA` date DEFAULT NULL,
  `ACEITE_RECUSA_CANDIDATO` date DEFAULT NULL,
  `COMENTARIO` varchar(200) DEFAULT NULL,
  `COMUNICAR_STATUS` date DEFAULT NULL,
  PRIMARY KEY (`PROPOSTA_ID`),
  CONSTRAINT `fk_PROPOSTAS_CONTRATACOES_ID_USUARIO`
  FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `admissao_dominio` (`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `bancorh`.`gestao`
 ( `ID_GESTOR` INT auto_increment,
`ID_USUARIO` INT NOT NULL,
`GESTOR` VARCHAR(45) DEFAULT NULL,
`GESTOR_SABE` VARCHAR(4) DEFAULT NULL,
`GESTOR_LOCAL` VARCHAR(45) DEFAULT NULL,
`GESTOR_LOCAL_sABE` VARCHAR(4) DEFAULT NULL,
`RECEPTOR_PESSOA` VARCHAR(45) DEFAULT NULL,
 PRIMARY KEY (`ID_GESTOR`),
  INDEX `fk_USUARIO_ID` (`ID_USUARIO` ASC),
  CONSTRAINT `fk-USUARIO_ID_GESTAO`
  FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `bancorh`.`vencimentos`
 ( `ID_VENCIMENTO` INT auto_increment,
`ID_USUARIO` INT DEFAULT NULL,
`ENVIO_SOLICITANTE_PRI` DATE DEFAULT NULL,
`DATA_VENCIMENTO_PRI` DATE DEFAULT NULL,
`RENOVACAO` VARCHAR(4) DEFAULT NULL,
`ENVIO_SOLICITANTE_SEG` DATE DEFAULT NULL,
`DATA_VENCIMENTO_SEG` DATE DEFAULT NULL,
`EFETIVACAO` VARCHAR(4) DEFAULT NULL,
 PRIMARY KEY (`ID_VENCIMENTO`),
  INDEX `fk_USUARIO_ID` (`ID_USUARIO` ASC),
  CONSTRAINT `fk-USUARIO_ID_VENCIMENTOS`
  FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE if not exists `documentacao` (
  `DOCUMENTACAO_ID` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) not null,
  `FORMULARIOS_ENVIADOS` date DEFAULT NULL,
  `FORMULARIOS_RECEBIDOS` date DEFAULT NULL,
  `DOCUMENTOS_FISICOS` date DEFAULT NULL,
  `CTPS_RECEBIDA` date DEFAULT NULL,
  `COD_RASTREIO` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`DOCUMENTACAO_ID`),
  CONSTRAINT `fk_DOCUMENTACAO_ID_USUARIO`
    FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `admissao_dominio`(`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE if not exists `admissao` (
  `ID_PLATAFORMA_ADM_DOMIN` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) not null,
  `QUALIFIC_CADASTRAL_CEP` date DEFAULT NULL,
  `CAD_ADM_PLATAFORMA_ADM_DIMIN` date DEFAULT NULL,
  `DOC_RECEBIDO_PLATAFORMA_DOMIN_CBO` date DEFAULT NULL,
  `TERMO_PSI` date DEFAULT NULL,
  `INCLUI_ADM_PROV` date DEFAULT NULL,
  PRIMARY KEY (`ID_PLATAFORMA_ADM_DOMIN`),
  CONSTRAINT `fk_PLATAFORMA_ADMISSAO_DOMINIO_ID_USUARIO`
    FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `admissao_dominio`(`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE if not exists `exame_admissional` (
  `ID_EXAME_ADMISSIONAL` int(11) NOT NULL auto_increment,
  `ID_USUARIO` int(11) not null,
  `AGENDAMENTO_EXAM_ADM` date DEFAULT NULL,
  `ENVIO_FUNC_EXAME` date DEFAULT NULL,
  `EMAIL_RECEBIDO_EXAM` date DEFAULT NULL,
  `ANEXAR_ASO` date DEFAULT NULL,
  PRIMARY KEY (`ID_EXAME_ADMISSIONAL`),
  CONSTRAINT `fk_EXAME_ADMISSIONAL_ID_USUARIO`
    FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `admissao_dominio`(`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `bancorh`.`suporte_interno` (
  `ID_SUPORTE_INTERNO` INT(11) NOT NULL auto_increment,
  `ID_USUARIO` INT NOT NULL,
  `EMAIL_SUP` VARCHAR(45)  DEFAULT NULL,
  `USUARIO` VARCHAR(45)  DEFAULT NULL,
  `USUARIO_ATIVO` INT(45)  DEFAULT NULL,
  `SENHA` VARCHAR(45)  DEFAULT NULL,
  `EQUIPAMENTO` VARCHAR(45)  DEFAULT NULL,
  `TRANSLADO` VARCHAR(45)  DEFAULT NULL,
  `EQUIPE` VARCHAR(100) DEFAULT NULL,
  `USUARIO_ATV` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`ID_SUPORTE_INTERNO`),
  INDEX `fk_ID_USUARIO` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_ID_USUARIO`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `bancorh`.`interno` (
  `ID_INTERNO` INT(11) auto_increment,
  `ID_USUARIO` INT NOT NULL,
  `INTRANET_CADASTRO_USUARIO` date  DEFAULT NULL,
  `INTRANET_CADASTRO_SENHA` VARCHAR(30)  DEFAULT NULL,
  `KAIROS_CADASTRO_USUARIO` date  DEFAULT NULL,
  `KAIROS_CADASTRO_SENHA` VARCHAR(30)  DEFAULT NULL,
  `EMAIL_GESTOR_APOIO_SEDE` VARCHAR(45)  DEFAULT NULL,
  `EMAIL_INICIO_ATIVIDADES` date  DEFAULT NULL,
  `EMAIL_BOAS_VINDAS` date  DEFAULT NULL,
  `ACESSOS` date default null,
  PRIMARY KEY (`ID_INTERNO`),
  INDEX `fk_USUARIO_ID` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_USUARIO_ID`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `bancorh`.`bancarios`
 ( `ID_DADOS_BANCARIOS` INT auto_increment,
`ID_USUARIO` INT DEFAULT NULL,
`ENVIO` DATE DEFAULT NULL,
`RECEBIDO` DATE DEFAULT NULL,
`ANEXAR_COMPR_DOMIN` DATE DEFAULT NULL,
`PLANILHA_CONTAS` DATE DEFAULT NULL,
`FORM_COMPR_BANCARIO` DATE DEFAULT NULL,
`AGENCIA` VARCHAR(5),
`NUMERO_CONTA` VARCHAR(10),
`TIPO_CONTA` VARCHAR(1),
 PRIMARY KEY (`ID_DADOS_BANCARIOS`),
  INDEX `fk_USUARIO_ID` (`ID_USUARIO` ASC),
  CONSTRAINT `fk-USUARIO_ID`
  FOREIGN KEY (`ID_USUARIO`)
  REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `bancorh`.`vias_documentos_funcionarios` (
  `VIAS_DOCUMENTOS_FUNCIONARIO_ID` INT NOT NULL auto_increment,
  `ID_USUARIO` INT NOT NULL ,
  `CRACHA_DATA_PEDIDO` DATE  DEFAULT NULL,
  `CRACHA_CONTROLE` DATE  DEFAULT NULL,
  `CRACHA_PROTOCOLO` DATE  DEFAULT NULL,
  `EMAIL_CADERNO_COMPASSO_SOLICITADO` DATE  DEFAULT NULL,
  `EMAIL_CADERNO_COMPASSO_RECEBIDO` DATE  DEFAULT NULL,
  `MALOTE_CADERNO_COMPASSO_CTPS` DATE  DEFAULT NULL,
  `DOCUMENTOS_RECEBIDOS_ASSINADOS` DATE  DEFAULT NULL,
  PRIMARY KEY (`VIAS_DOCUMENTOS_FUNCIONARIO_ID`),
  INDEX `fk_ID_USUARIO` (`ID_USUARIO` ASC),
  CONSTRAINT `fk_ID_USUARIO_DOCS`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `bancorh`.`boas_vindas` (
  `ID_BOAS_VINDAS` INT NOT NULL auto_increment,
  `ID_USUARIO` INT NOT NULL,
  `BOAS_VINDAS_INGR_AGENDADA` DATE  DEFAULT NULL,
  `BOAS_VINDAS_INGR_REALIZADA` DATE  DEFAULT NULL,
  `BOAS_VINDAS_SALA` VARCHAR(45)  DEFAULT NULL,
  `LAYOUT_BOAS_VINDAS_MENSAL` DATE  DEFAULT NULL,
  PRIMARY KEY (`ID_BOAS_VINDAS`),
  INDEX `fk_USUARIO_ID` (`ID_USUARIO` ASC),
  CONSTRAINT `fk-USUARIO_ID_BOAS_VINDAS`
    FOREIGN KEY (`ID_USUARIO`)
    REFERENCES `bancorh`.`admissao_dominio` (`USUARIO_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
