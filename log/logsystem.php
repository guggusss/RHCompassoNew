<?php
/**
 
 * Sistema de logging
 
 */
 
 
 
 // Inclui os dados do arquivo de configuração
 
 require_once "logconf.php";
 
  
 
 /**
 
  * Corpo do sistema de logging
 
  */
 
 class LogSystem
 
 {
 
    /**
 
     * Guarda a conexão ao banco de dados
 
     */
 
    private $_db = null;
 
 
 
    /**
 
     * Armazena os erros do logger
 
     */
 
    private $_error = '';
 
 
 
    /**
 
     * Modo de execução
 
     */
 
    private $_mode = 'development';
 
 
 
    /**
 
     * Inicializa o sistema de logging
 
     */
 
    public function __construct($mode = 'development')
 
    {
 
        // Modo de gravação
 
        $this -> _mode = $mode;
 
        // Cria a conexão ao banco de dados
 
        if (DB_SERVER && DB_USER && DB_NAME) {
 
            // Configuração
 
            $dsn = 'mysql:host='.DB_SERVER.';dbname='.DB_NAME;
 
            // Conexão
 
            try {
 
                $this->_db = new PDO(
 
                    $dsn,
 
                    DB_USER,
 
                    DB_PASSWORD ? DB_PASSWORD : ''
 
                );
 
                // Configuração do conjunto de caracteres (characters set)
 
                $this -> _db -> exec("SET NAMES 'utf8'");
 
                // Exibe os erros do MySQL
 
                $this -> _db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
                // Cria as tabelas padrão do sistema, caso ainda não existamCreate default tables, if not existing
 
                $this -> _db -> exec(
 
                    "CREATE TABLE IF NOT EXISTS `logs` (
 
                      `id` int(11) NOT NULL AUTO_INCREMENT,
 
                      `type` smallint(6) NOT NULL DEFAULT '0',
 
                      `title` varchar(128) NOT NULL,
 
                      `message` varchar(256) DEFAULT NULL,
 
                      `details` text,
 
                      `date` datetime NOT NULL,
 
                      PRIMARY KEY (`id`)
 
                    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
 
                    "
 
                );
 
            } catch (PDOException $e) {
 
                // Grava erro do logger
 
                $this -> _exceptionHandler($e);
 
            }
 
        }
 
 
 
        // Registra uma função para ser executada no desligamento
 
        register_shutdown_function(array($this, 'fatalErrorHandler'));
 
        // Configura o manipulador de erros (error handler)
 
        set_error_handler(array($this, 'errorHandler'));
 
        // Configura o manipulador de exceções 
 
        set_exception_handler(array($this, '_exceptionHandler'));
 
        // Exibe os erros dentro do navegador, no modo de desenvolvimento
 
        if ($this -> _mode == 'development') {
 
            ini_set("display_errors", "on");
 
        }
 
        // Relata todos os erros
 
        error_reporting(ERROR_REPORTIONG ? ERROR_REPORTIONG : E_ALL);
 
    }
 
 
 
    /**
 
     * Loga os erros do PHP apropriadamente
 
     *
 
     * @param string $title    Título do ero
 
     * @param string $message  Mensagem descritiva curta
 
     * @param string $details  Detalhes técnicos avançados
 
     * @param bool   $critical O script pára aqui
 
     *
 
     * @return null
 
     */
 
    public function logError($title, $message, $details, $critical = false)
 
    {
 
        // Save log (error or critical error)
 
        $this->_saveLog($title, $message, $details, ($critical ? 3 : 2));
 
        // Se encontrar erro crítico, pára o script
 
        if ($critical) {
 
            // Remove cabeçalho (header) preexistente 
 
            header_remove();
 
            // Cria cabeçalho
 
            header('HTTP/1.0 500 Internal Server Error');
 
            // No modo de desenvolvimento, exibe erros no navegador
 
            if ($this -> _mode == 'development') {
 
                print "<!doctype html><html><head>";
 
                print "<link href='http://fonts.googleapis.com/css?family=Lato' ";
 
                print "rel='stylesheet' type='text/css'>";
 
                print "<style>body{font-family:'Lato',Arial;}";
 
                print "table{width:80%;border-collapse:collapse;padding:10px;}";
 
                print "th {padding:10px;}td{color: #888;padding:10px;}</style>";
 
                print "</head><body>";
 
                // Mostra o erro em uma bela caixa
 
                print "<div style='text-align: center;'>";
 
                print "<h1 style='color: #ff4800;'>".$title."</h1>";
 
                print "<p>".$message.'</p><hr>';
 
                print "<p>".$details.'</p>';
 
                print "</div>";
 
 
 
                // Fecha as tags BODY e HTML
 
                print "</body></html>";
 
            } else {
 
                // Se o template estiver definido e presente, exibe
 
                if (ERROR_TEMPLATE && @file_exists(ERROR_TEMPLATE)) {
 
                    include_once(ERROR_TEMPLATE);
 
                }
 
            }
 
            // Termina
 
            die();
 
        }
 
    }
 
 
 
    /**
 
     * Loga os avisos do PHP
 
     *
 
     * @param string $title    Título do aviso
 
     * @param string $message  Curta mensagem descritiva
 
     * @param string $details  Detalhes técnicos avançados
 
     *
 
     * @return null
 
     */
 
    public function logWarning($title, $message, $details, $db = true, $mail = true)
 
    {
 
        // Grava o log (erro ou erro crítico)
 
        $this -> _saveLog($title, $message, $details, 1, $db, $mail);
 
    }
 
 
 
    /**
 
     * Loga as notificações do PHP
 
     *
 
     * @param string $title    Título da notificação
 
     * @param string $message  Mensagem descritiva curta
 
     * @param string $details  Detalhes técnicos avançados
 
     *
 
     * @return null
 
     */
 
    public function logNotice($title, $message, $details, $db = true, $mail = true)
 
    {
 
        // Grava o log (erro ou erro crítico)
 
        $this -> _saveLog($title, $message, $details, 0, $db, $mail);
 
    }
 
 
 
    /**
 
     * Esta função irá gravar um log sempre que puder
 
     *
 
     * @param string $title   Título de erro
 
     * @param string $message Mensagem descritiva curta
 
     * @param string $details Detalhes técnicos avançados
 
     * @param bool   $nodb    Não armazena no banco de dados
 
     * @param bool   $nomail  Não envia por email
 
     *
 
     * @return null
 
     */
 
    private function _saveLog($title, $message, $details, $type = 0, $db = true, $mail = true)
 
    {
 
        // No modo de desenvolvimento, os erros são exibidos no navegador. Sem necessidade de gravar, portanto
 
        if ($this -> _mode == 'development' && $type > 1) return;
 
        // Permite saber se o log foi gravado em algum lugar
 
        $saved = false;
 
        // Tenta gravar no banco de dados, caso a conexão se concretize
 
        if ($this -> _db && $db) {
 
            try {
 
                // Prepara a declaração SQL
 
                $sth = $this -> _db -> prepare(
 
                    "INSERT INTO logs (type, title, message, details, date) ".
 
                    "VALUES (:type, :title, :message, :details, :date)"
 
                );
 
                // Send the parameters
 
                $sth -> execute(
 
                    array(
 
                        ':type' => $type,
 
                        ':title' => $title,
 
                        ':message' => $message,
 
                        ':details' => $details,
 
                        ':date' => date('Y-m-d H:i:s')
 
                    )
 
                );
 
                // Informa que o log está salvo
 
                $saved = true;
 
            } catch (PDOException $e) {
 
                // Se o log não pode ser salvo, envia erro via email
 
                $this -> _saveLog(
 
                    'O log n&atilde;o p&ocirc;de ser gravado no banco de dados',
 
                    'Um log ('.$title.') n&atilde;o p&ocirc;de ser gravado no banco de dados, como requisitado',
 
                    'Exce&ccedil;&atilde;o: '.$e->getMessage(),
 
                    3,
 
                    true
 
                );
 
            }
 
        }
 
 
 
        // Se não foi gravado no banco de dados, tenta enviar por email
 
        if (!$saved && $mail && ADMIN_MAIL) {
 
            // Compõe a mensagem completa
 
            $fullmessage = $message."rn".$details;
 
            // Cabeçalhos
 
            $headers = array(
 
                'From: LoggingSystem <'.NOREPLY_MAIL.'>',
 
                'To: Administrator <'.ADMIN_MAIL.'>',
 
                'Subject: '.$title,
 
                'X-Mailer: PHP/'.phpversion()
 
            );
 
            // Tenta mandar e-mail
 
            if (mail(ADMIN_MAIL, $title, $fullmessage, implode("\r\n", $headers))) {
 
                // Log enviado
 
                $saved = true;
 
            }
 
        }
 
 
 
        // Como última opção, grava o log em um arquivo texto.
 
        if (!$saved && LOGS_FOLDER) {
 
            // Se certifica de que o arquivo de log existe
 
            if (!file_exists(LOGS_FOLDER)) {
 
                // ... se não existir, cria um
 
                mkdir(LOGS_FOLDER, 0777);
 
            }
 
            // Cria um arquivo HTACCESS para restringir acesso ao público
 
            if (!file_exists(LOGS_FOLDER.'/.htaccess')) {
 
                $htaccess = "Order deny,allowrndeny from all";
 
                file_put_contents(
 
                    LOGS_FOLDER.'/.htaccess',
 
                    $htaccess
 
                );
 
            }
 
            // Agora, grava o arquivo dentro da pasta segura
 
            @file_put_contents(
 
                LOGS_FOLDER.'/log_'.date('d_m_Y_H_i_s').'.txt',
 
                $title."\r\n\r\n".$message."\r\n\r\n".$details
 
            );
 
        }
 
    }
 
 
 
    /**
 
     * Verifica existência de erros fatais e os relata
 
     *
 
     * @return null
 
     */
 
    public function fatalErrorHandler()
 
    {
 
        // Pega o erro
 
        $error = error_get_last();
 
        if ($error) {
 
            // Chama o manipulador de erros
 
            $this -> errorHandler(
 
                $error['type'],
 
                $error['message'],
 
                $error['file'],
 
                $error['line']
 
            );
 
        }
 
    }
 
     
 
    /**
 
     * Manipulador de erros para aqueles gerados pelo compilador
 
     *
 
     * @param int    $errno Error level
 
     * @param string $str   Error message
 
     * @param string $file  Error file
 
     * @param int    $line  Error line
 
     * 
 
     */
 
    public function errorHandler($errno, $str, $file, $line, $context = null)
 
    {
 
        // Cria nova exceção
 
        $this -> _exceptionHandler(new ErrorException($str, 0, $errno, $file, $line));
 
    }
 
 
 
    /**
 
     * Manipulador de exceções para erros gerados pelo compilador
 
     *
 
     * @param Exception $e Exception object
 
     * 
 
     */
 
    private function _exceptionHandler($e)
 
    {
 
        // Título do erro
 
        $error_title = 'C&oacute;digo de erro fatal';
 
        // Mensagem de erro
 
        $error_message = $e -> getMessage();
 
        // Detalhes do erro
 
        $error_details = 
 
            'Type: '.get_class($e).
 
            ', File: '.$e -> getFile().
 
            ', Line: '.$e -> getLine();
 
        // Chama o logger de erro público e pára tudo
 
        $this -> logError(
 
            $error_title,
 
            $error_message,
 
            $error_details,
 
            true
 
        );
 
    }
 
 }