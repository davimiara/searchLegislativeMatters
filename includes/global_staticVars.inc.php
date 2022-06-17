

<?php

//returns
static $ERROR = -1;
static $OK = 0;

static $ERROR_search = -1;
static $ERROR_blankDoc = -2;
static $ERROR_blankProp = -3;
static $ERROR_blankLaw = -4;
static $ERROR_wrongDoc = -5;
static $ERROR_problemsKeyWords = -6;

//strings

static $url_prop = "/novoSite/view_prop.php?";
static $url_law = "/novoSite/view_law.php?";

static $url_search = "./view_search.php";

static $separator = "&";
static $equal = "=";
static $post = "?";

static $page = "page=";
static $POST_parameter_matter = "matter";
static $POST_parameter_year = "selectYear";
static $POST_parameter_prop = "typeOfProp";
static $POST_parameter_law = "typeOfLaw";
static $POST_parameter_doc = "typeDoc";
static $POST_parameter_errorCode = "errorCode";
static $POST_parameter_page = "page";
static $POST_parameter_keywords = "keywords";
static $POST_parameter_totalPage = "totalPage";
static $POST_parameter_currentPage = "currentPage";

//materias
static $type_prop = "proposicao";
static $type_law = "lei";

static $prop_indicacao = "indicacao";
static $prop_requerimento = "requerimento";
static $prop_mocao = "mocao";
static $prop_projeto = "projeto";

static $law_decreto = "decreto";
static $law_resolucao = "resolucao";
static $law_portaria = "portaria";
static $law_edital = "edital";
static $law_organica="organica";
static $law_complementar="complementar";
static $law_remuneracao="remuneracao";
static $law_regimento="regimento";

static $view_Prop = "Proposi&ccedil;&otilde;es";
static $view_Law = "Leis";

static $view_Ind = "Indica&ccedil;&otilde;es";
static $view_Moc = "Mo&ccedil;&otilde;es";
static $view_Req = "Requerimentos";
static $view_Proj = "Projetos";

static $view_Port = "Portarias";
static $view_Dec = "Decretos";
static $view_Res = "Resolu&ccedil;&otilde;es";
static $view_Edi = "Editais";
static $view_complementar = "Leis Complementares";
static $view_organica = "Leis Org&acirc;nicas";
static $view_remuneracao = "Remunera&ccedil;&atilde;o";
static $view_regimento = "Regimento";

//REQUEST parameters
static $separator_keywords = ";";

?>