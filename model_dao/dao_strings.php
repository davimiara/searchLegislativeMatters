<?

//paginaчуo de conteudo
$num_por_pagina = 10;

//Strings a serem substituidas
$defaultAno="2015";
$subst_year="'#year#'";
$subst_type="'#type#'";
$inicioRegistro="#primeiroRegistro#";

//parтmetros SQL
$sql_select="SELECT * FROM ";
$sql_where=" WHERE ";
$sql_and=" AND ";
$sql_or=" OR ";
$sql_like=" LIKE ";
$sql_term_separator= "'";
$sql_term_generical_term= "%";
$sql_term_select_count= "SELECT COUNT(*) FROM ";
$sql_term_init_parenthesis= " ( ";
$sql_term_final_parenthesis= " ) ";
$sql_term_comma= ",";
$sql_term_join= " UNION ";

$sql_matter_prop="proposicoes";
$sql_matter_law="legislacao";
$sql_type="tipo = '#type#'";
$sql_year="ano = '#year#'";


$sql_prop_proj="'Projetos'";
$sql_prop_req="'Requerimentos'";
$sql_prop_ind="'Indicaчѕes'";
$sql_prop_moc="'Moчуo'";

$sql_law_port="'portaria'";
$sql_law_dec="'decreto'";
$sql_law_res="'resolucao'";
$sql_law_edital="'edital'";
$sql_law_organica="'organica'";
$sql_law_complementar="'complementar'";
$sql_law_remuneracao="'remuneracao'";
$sql_law_regimento="'regimento'";

$sql_prop_titulo="titulo";
$sql_prop_sumula="sumula";
$sql_prop_conteudo="conteudo";

$sql_order = " ORDER BY id DESC LIMIT #primeiroRegistro#, $num_por_pagina";

//errors
$error_query = "Ocorreu um erro ao executar a consulta.";
$error_db = "Ocorreu um erro ao selecionar o Banco de Dados.";
$error_connection = "Ocorreu um erro na conex$atilde;o com o Banco de Dados.";

//consulta legislaчѕes


//consultas PESQUISA

?>