<?

include_once './includes/global_staticVars.inc.php';
include_once './includes/view_messages.inc.php';

function translateErrors($codeError) {

    global $ERROR, $ERROR_search, $ERROR_blankDoc, $ERROR_blankProp, $ERROR_blankLaw,
    $ERROR_wrongDoc, $ERROR_problemsKeyWords;
    global $ERROR_MSG_GENERAL, $ERROR_MSG_search, $ERROR_MSG_blankDoc,
    $ERROR_MSG_blankProp, $ERROR_MSG_blankLaw, $ERROR_MSG_wrongDoc, 
            $ERROR_MSG_problemsKeyWords;

    switch ($codeError) {
        case $ERROR:
            return $ERROR_MSG_GENERAL;
        case $ERROR_search:
            return $ERROR_MSG_search;
        case $ERROR_blankDoc:
            return $ERROR_MSG_blankDoc;
        case $ERROR_blankProp:
            return $ERROR_MSG_blankProp;
        case $ERROR_blankLaw:
            return $ERROR_MSG_blankLaw;
        case $ERROR_wrongDoc:
            return $ERROR_MSG_wrongDoc;
        case $ERROR_problemsKeyWords:
            return $ERROR_MSG_problemsKeyWords;
        default:
            return $ERROR_MSG_GENERAL;
    }
}

function viewErrorMessage($msg) {
    ?>
    <p>
        <strong>ERRO: <strong>
        <font color="#FF0000"><?echo $msg ?></font>
    </p>
    <?
}
?>