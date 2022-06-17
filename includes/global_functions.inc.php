<?php

include_once './includes/global_staticVars.inc.php';

function takePOSTValues($parameter) {
    return $_REQUEST[$parameter];
}

function redirectToPage($page) {
    echo '<script type="text/javascript"> window.location="' . $page . '";</script>';
    exit();
}

function replaceString($originalString, $stringToReplate, $newString) {

    return str_replace($stringToReplate, $newString, $originalString);
}

function prepareErrorURL($errorCode) {
    global $url_search, $POST_parameter_errorCode, $equal, $post;

    $_REQUEST[$POST_parameter_errorCode] = $errorCode;

    $errorUrl = $url_search . $post . $POST_parameter_errorCode . $equal . $errorCode;

    //echo "Erro: " . $errorUrl . "<br>";

    return $errorUrl;
}

function validatedPropositions($termSearch) {
    global $prop_indicacao, $prop_projeto, $prop_mocao,
    $prop_requerimento, $ERROR_blankProp, $OK;

    if (strcmp($termSearch, $prop_indicacao) == 0 ||
            strcmp($termSearch, $prop_projeto) == 0 ||
            strcmp($termSearch, $prop_mocao) == 0 ||
            strcmp($termSearch, $prop_requerimento) == 0) {
        return $OK;
    } else {
        return $ERROR_blankProp;
    }
}

function validatedLaws($termSearch) {
    global $law_edital, $law_portaria, $law_resolucao, $law_decreto,
    $ERROR_blankLaw, $OK;

    if (strcmp($termSearch, $law_edital) == 0 ||
            strcmp($termSearch, $law_portaria) == 0 ||
            strcmp($termSearch, $law_resolucao) == 0 ||
            strcmp($termSearch, $law_regimento) == 0 ||
            strcmp($termSearch, $law_complementar) == 0 ||
            strcmp($termSearch, $law_remuneracao) == 0 ||
            strcmp($termSearch, $law_organica) == 0 ||
            strcmp($termSearch, $law_decreto) == 0) {
        return $OK;
    } else {
        return $ERROR_blankLaw;
    }
}

?>