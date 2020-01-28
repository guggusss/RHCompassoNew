<?php
 
/**
 
 * Configurações de log
 
 */
 
 
 
 // Opções de relato de erros
 
 define('ERROR_REPORTIONG', E_ALL | E_STRICT | E_NOTICE | E_WARNING);
 
 // Página template de erro
 
 define('ERROR_TEMPLATE', 'error500.html');
 
 
 
 // Dados de configuração do SEU servidor de banco de dados
 
 define('DB_SERVER', 'localhost');
 
 // username do banco de dados
 
 define('DB_USER', 'root');
 
 // Senha do usuário
 
 define('DB_PASSWORD', 'root');
 
 // Nome do banco de dados
 
 define('DB_NAME', 'logsdb');
 
  
 // Endereço de e-mail do administrador.
 
 define('ADMIN_MAIL', 'admin@meusite.com.br');
 
 // No-reply sender e-mail ou e-mail do remetente,
 // para o administrador saber de onde estão vindo as mensagens
 
 define('NOREPLY_MAIL', 'noreply@meusite.com.br');
 
 
 // Pasta aonde serão salvos os logs
 
 define('LOGS_FOLDER', 'logs');