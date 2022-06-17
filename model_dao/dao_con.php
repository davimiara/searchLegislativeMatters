
<?php

include_once './model_dao/dao_strings.php';

class conexao {

    // Nas linhas abaixo você poderá colocar as informações do Banco de Dados.
    var $host = "localhost"; // Nome ou IP do Servidor
    var $user = "camaraca_backup"; // Usuário do Servidor MySQL
    var $senha = "@backup917"; // Senha do Usuário MySQL
    var $dbase = "camaraca_backupCamara150309"; // Nome do seu Banco de Dados
    // Criaremos as variáveis que Utilizaremos no script
    var $query;
    var $link;
    var $resultado;
    var $ERROR = -1;

    // Instancia o Objeto para podermos usar
    function MySQL() {
        
    }

    // Cria a função para efetuar conexão ao Banco MySQL (não é muito diferente da conexão padrão).
    // Veja que abaixo, além de criarmos a conexão, geramos condições personalizadas para mensagens de erro.

    function conecta() {

        global $error_db;

        $this->link = @mysql_connect($this->host, $this->user, $this->senha);
        // Conecta ao Banco de Dados
        if (!$this->link) {
            // Caso ocorra um erro, exibe uma mensagem com o erro
            //echo $error_connection;
            //print "<b>" . mysql_error() . "</b>";
            //die();
            return $this->ERROR;
        } elseif (!mysql_select_db($this->dbase, $this->link)) {
            // Seleciona o banco após a conexão
            // Caso ocorra um erro, exibe uma mensagem com o erro
            //echo $error_db;
            //print "<b>" . mysql_error() . "</b>";
            //die();
            return $this->ERROR;
        }
    }

    // Cria a função para "query" no Banco de Dados

    function sql_query($query) {

        $this->conecta();
        $this->query = $query;
        // Conecta e faz a query no MySQL
        if ($this->resultado = mysql_query($this->query)) {
            $this->desconecta();
            return $this->resultado;
        } else {

            // Caso ocorra um erro, exibe uma mensagem com o Erro
            //print $error_query;
            //print "<br><br>";
            //print "Erro: <b>" . mysql_error() . "</b>";
            //die();
            $this->desconecta();
            return $this->ERROR;
        }
    }

    // Cria a função para "query_fetch" no Banco de Dados

    function sql_query_fetch($query) {
        $this->conecta();
        $this->query = $query;
        // Conecta e faz a query no MySQL
        if ($this->resultado = mysql_query($this->query)) {
            $row = mysql_fetch_row($this->resultado);
            if ($row)
                $this->resultado = $row[0];
            $this->desconecta();
            return $this->resultado;
        } else {

            // Caso ocorra um erro, exibe uma mensagem com o Erro
            //print $error_query;
            //print "<br><br>";
            //print "Erro: <b>" . mysql_error() . "</b>";
            //die();
            $this->desconecta();
            return $this->ERROR;
        }
    }

    // Cria a função para Desconectar do Banco MySQL
    function desconecta() {
        return mysql_close($this->link);
    }

}

?>
