

<?

// Abaixo chamaremos através do include a classe que conecta ao banco de dados MySQL.
include_once './model_dao/dao_con.php';
include './includes/global_staticVars.inc.php';

//06/04/15 - Função não utilizada ainda
function prepareMatter($matter, $isCount) {

    global $selectIndicacoes, $selectProjetos, $selectMocoes,
    $selectRequerimentos;
    global $countIndicacoes, $countProjetos, $countMocoes,
    $countRequerimentos;
    global $ERROR_wrongProp, $OK;
    global $prop_indicacao, $prop_projeto, $prop_mocao,
    $prop_requerimento;
    $selectQuery = "";

    switch ($matter) {
        case $prop_indicacao:
            if (!$isCount)
                $selectQuery = $selectIndicacoes;
            else
                $selectQuery = $countIndicacoes;
            break;
        case $prop_projeto:
            if (!$isCount)
                $selectQuery = $selectProjetos;
            else
                $selectQuery = $countProjetos;
            break;
        case $prop_mocao:
            if (!$isCount)
                $selectQuery = $selectMocoes;
            else
                $selectQuery = $countMocoes;
            break;
        case $prop_requerimento:
            if (!$isCount)
                $selectQuery = $selectRequerimentos;
            else
                $selectQuery = $countRequerimentos;
            break;
        default:
            return $ERROR_wrongProp;
    }

    return $selectQuery;
}

function prepareQuery($matter, $firstRecord) {

    global $inicioRegistro, $sql_order;
    //prepare SELECT query without COUNT
    //$result = prepareMatter($matter, false);
    //termina de preparar a SQL para executar a query
    $matter.=$sql_order;

    //substitui valores estáticos que ficaram na SQL
    $result = replaceString($matter, $inicioRegistro, $firstRecord);

    //echo "query1: " . $result . "<BR>";

    $itemMateria = executeQuery($result);

    return $itemMateria;
}

function countTuples($sql) {

    global $sql_select, $sql_term_select_count;
    //substitui * por COUNT(*)
    $result = replaceString($sql, $sql_select, $sql_term_select_count);
    //echo "SQL Count: " . $result . "<br>";
    $qttde = executeQuery_fetch($result);
    return $qttde;
}

//function testQuery() {
//    $thereAreResults = true;
//    if ($qtdde == 0) {
//        $thereAreResults = false;
//    }
//}

function fetchObjetcs($object) {
    return mysql_fetch_object($object);
}

function executeQuery($query) {

    // Instanciamos o Objeto "conexao".
    $mysql = new conexao;
    // Executamos abaixo uma query (nela estamos selecionando a tabela tbl_usuarios.
    $result = $mysql->sql_query($query);

    // Desconecta do Banco de Dados
    $mysql->desconecta;
    // Abaixo vamos executar um while com os resultados obtidos na query acima.
    //destruindo objeto
    $mysql = null;
    unset($mysql);

    return $result;
}

function executeQuery_fetch($query) {

    // Instanciamos o Objeto "conexao".
    $mysql = new conexao;
    // Executamos abaixo uma query (nela estamos selecionando a tabela tbl_usuarios.
    $result = $mysql->sql_query_fetch($query);
    // Desconecta do Banco de Dados
    $mysql->desconecta;
    // Abaixo vamos executar um while com os resultados obtidos na query acima.
    //destruindo objeto
    $mysql = null;
    unset($mysql);

    return $result;
}
?>