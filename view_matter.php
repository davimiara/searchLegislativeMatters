<html>
    <body>


        <?php

        function resumeofSearch($searchTerm_year, $searchTerm_prop, $searchTerm_law, $searchTerm_doc, $searchTerm_keywords, $searchTerm_page) {

            global $you_researched, $search_doc_resume, $type_prop, $view_Prop,
            $type_law, $view_Law, $select_keywords, $all_years, $all_docs,
            $search_year_resume, $e_search, $searchTerm_prop, $enter_line,
            $search_type_doc_resume;

            $resumeSearch = $you_researched;

            //matéria legislativa
            $resumeSearch.=$search_doc_resume;
            if (strcmp($searchTerm_doc, $type_prop) == 0) {
                $resumeSearch.=$view_Prop;
            }
            if (strcmp($searchTerm_doc, $type_law) == 0) {
                if (strcmp($searchTerm_doc, $type_prop) == 0) {
                    $resumeSearch.= $e_search;
                }
                $resumeSearch.=$view_Law;
            }

            //ano
            $resumeSearch.=$search_year_resume;
            if (strcmp($searchTerm_year, "") == 0) {
                $resumeSearch.=$all_years;
            } else {
                $resumeSearch.=$searchTerm_year;
            }

            //tipo de matéria
            $resumeSearch.=$search_type_doc_resume;
            if (strcmp($searchTerm_prop, "") == 0 && strcmp($searchTerm_law, "") == 0) {
                $resumeSearch.=$all_docs;
            } else {
                if (strcmp($searchTerm_prop, "") != 0) {
                    $resumeSearch.=$searchTerm_prop;
                }
                if (strcmp($searchTerm_law, "") != 0) {
                    if (strcmp($searchTerm_prop, "") != 0) {
                        $resumeSearch.= $e_search;
                    }
                    $resumeSearch.=$searchTerm_law;
                }
            }


            //palavras-chave
            if (strcmp($searchTerm_keywords, "") != 0) {
                $resumeSearch.=$enter_line . $select_keywords . ": " . $searchTerm_keywords;
            }

            return $resumeSearch;
        }

        //includes
        include_once './controller_search.php';
        include_once './includes/global_functions.inc.php';
        include_once './includes/view_functions.inc.php';
        include_once './includes/global_staticVars.inc.php';
        //JS
        include './javascript/js.js';
        //Global Variables
        $subject = "";
        $selectQuery = "";
        $result = $OK;

        //receiveParameters
        //take POST parameters
        $searchTerm_year = "";
        $searchTerm_prop = "";
        $searchTerm_law = "";
        $searchTerm_doc = "";
        $searchTerm_keywords = "";
        $searchTerm_page = "";

        $searchTerm_year = takePOSTValues($POST_parameter_year);
        $searchTerm_prop = takePOSTValues($POST_parameter_prop);
        $searchTerm_law = takePOSTValues($POST_parameter_law);
        $searchTerm_doc = takePOSTValues($POST_parameter_doc);
        $searchTerm_keywords = takePOSTValues($POST_parameter_keywords);
        $searchTerm_page = takePOSTValues($POST_parameter_page);


        if (strcmp($searchTerm_page, "") == 0) {
            $searchTerm_page = 1;
        }

        //prepareParameters
        //echo "parameters1: " . $searchTerm_year . "<br>" . $searchTerm_prop . "<br>" . $searchTerm_law . "<br>" . $searchTerm_doc . "<br>"  . $searchTerm_keywords . "<br>" . $searchTerm_page . "<br>";
        $result = prepareParameters($searchTerm_year, $searchTerm_prop, $searchTerm_law, $searchTerm_doc, $searchTerm_keywords, $searchTerm_page, &$totalTuples);

        //echo "result1: " . $itemMateria . "<br>";

        if ($result <= $ERROR) {
            echo viewErrorMessage(translateErrors($result));
        } else {
            $itemMateria = $result;
            $searchURL = $url_search;
            $result = mountPanel($totalTuples, $searchTerm_page, $searchTerm_year, $searchTerm_prop, $searchTerm_law, $searchTerm_doc, $searchTerm_keywords);
            if (result != $ERROR) {
                $panel = $result;
            }
        }
        //mostra página de busca
        //echo "URL: " . $searchURL . "<br>";
        include("./view_search.php");
        //include($searchURL);



        if ($totalTuples < 1) {
            echo $msg_noResults;
        } else {
            ?>
            <h2 align="center"><?php echo "Resultados" ?> (p&aacute;gina <?php echo $searchTerm_page; ?>/<?php echo ceil($totalTuples / $num_por_pagina); ?>)</h2>

            <table width="100%"  border="0" id="matTable">

                <?php
                echo resumeofSearch($searchTerm_year, $searchTerm_prop, $searchTerm_law, $searchTerm_doc, $searchTerm_keywords, $searchTerm_page);

                $i = 0;
                while ($materia = fetchObjetcs($itemMateria)) {

                    //monta tabela
                    ?>	
                    <tr id="<? $i ?>">
                        <td>
                            <?
                            print "<br>";
                            print "<br>";
                            echo $materia->data . " - <b>" . $materia->titulo . "</b>";
                            echo "<br>";
                            echo "<b>S&uacute;mula: </b>" . $materia->sumula;
                            ?>
                        </td>
                        <td><INPUT TYPE="button" VALUE="Mostrar detalhes" ONCLICK="showRow(<? echo $i + 1; ?>, 'matTable');"></td>
                        <td><INPUT TYPE="button" VALUE="Esconder detalhes" ONCLICK="hideRow(<? echo $i + 1; ?>, 'matTable');"</td>
                    </tr>
                    <?php
                    $i = $i + 1;
                    ?>
                    <tr id="<?php $i ?>" style="display:none;">
                        <td>
                            <?
                            echo $materia->conteudo;
                            echo "<br>";
                            ?>
                        </td>

                    </tr>
                    <?
                    $i = $i + 1;
                }
            }
            ?>

        </table>


        <?php
//exibir painel na tela
        echo $panel;
        ?>

    </body>
</html>