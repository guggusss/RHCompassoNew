INSERT INTO `sede`(`SEDE_ID`, `NOME_SEDE`) VALUES  ('10', 'CAX'), ('11', 'RJ'), ('12', 'JAG'), ('13', 'BH'), ('14', 'PET');
ALTER TABLE `exame_admissional` ADD `EXAME_OBS` VARCHAR(200) DEFAULT NULL;
ALTER TABLE `bancarios` ADD `BANCARIOS_OBS` VARCHAR(200) DEFAULT NULL;
ALTER TABLE `interno` ADD `INTERNO_OBS` VARCHAR(200) DEFAULT NULL;
ALTER TABLE `vias_documentos_funcionarios` ADD `VIAS_DOCUMENTOS_OBS` VARCHAR(200) DEFAULT NULL;