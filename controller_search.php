<html>
    <body>
        <?php
        //includes
        include_once './model_dao/dao_query.php';
        include_once './includes/global_staticVars.inc.php';
        include_once './includes/global_functions.inc.php';
        //JS
        include './javascript/js.js';

        function takeProp($prop) {

            global $prop_indicacao, $prop_requerimento, $prop_mocao, $prop_projeto;
            global $sql_prop_proj, $sql_prop_req, $sql_prop_ind, $sql_prop_moc;

            switch ($prop) {
                case $prop_indicacao:
                    return $sql_prop_ind;
                case $prop_requerimento:
                    return $sql_prop_req;
                case $prop_mocao:
                    return $sql_prop_moc;
                case $prop_projeto:
                    return $sql_prop_proj;
                default:
                    return -1;
            }
        }

        function takeLaw($law) {
            global $law_decreto, $law_resolucao, $law_portaria, $law_edital,
            $law_organica, $law_complementar, $law_remuneracao, $law_regimento;
            global $sql_law_port, $sql_law_dec, $sql_law_res, $sql_law_edital,
            $sql_law_organica, $sql_law_complementar, $sql_law_remuneracao, $sql_law_regimento;

            switch ($law) {
                case $law_decreto:
                    return $sql_law_dec;
                case $law_resolucao:
                    return $sql_law_res;
                case $law_portaria:
                    return $sql_law_port;
                case $law_edital:
                    return $sql_law_edital;
                case $law_organica:
                    return $sql_law_organica;
                case $law_complementar:
                    return $sql_law_complementar;
                case $law_remuneracao:
                    return $sql_law_remuneracao;
                case $law_regimento:
                    return $sql_law_regimento;
                default:
                    return -1;
            }
        }

        function validatedMatter($termSearch) {
            global $type_prop, $type_law, $ERROR_blankDoc, $OK;

            if (strcmp($termSearch, $type_prop) == 0 ||
                    strcmp($termSearch, $type_law) == 0) {
                return $OK;
            } else {
                return $ERROR_blankDoc;
            }
        }

        function wordKeysInAVector($keywords) {
            //esta funÁ„o recebe uma string inteira com as palavras 
            //chaves e deve ser desmembrada de acordo com o caracter separador
            global $separator_keywords, $ERROR_problemsKeyWords;
            //echo "Palavras: " . $keywords . "<br>";
            $vectorKeyWords = explode($separator_keywords, $keywords);
            //echo "Palavras[0]: " . $vectorKeyWords[0] . " Palavras[1]: " . $vectorKeyWords[1] . "<br>";
            if ($vectorKeyWords[0] != NULL) {
                return $vectorKeyWords;
            } else {
                return $ERROR_problemsKeyWords;
            }
        }

        function mountSearchURL() {
            //recebe o tipo de documento, o ano da pesquisa e o tipo da materia (dentre todos os tipos de leis e proposi√ß√µes)
            //echo $doc . "&nbsp" . $year . "&nbsp"  . $prop . "&nbsp"  . $law . "&nbsp" . "<br>";
            // Retorna o dom√≠nio do servidor
            //$url = $_SERVER['SERVER_NAME'];
            //            if (strcmp($law, "") == 0) {
//                //se for lei
//                switch ($prop) {
//                    case $prop_indicacao:
//                        $url.=$prop_indicacao;
//                        break;
//                    case $prop_projeto:
//                        $url.=$prop_projeto;
//                        break;
//                    case $prop_mocao:
//                        $url.=$prop_mocao;
//                        break;
//                    case $prop_requerimento:
//                        $url.=$prop_requerimento;
//                        break;
//                    default:
//                        return $ERROR_wrongDoc;
//                }
//            } else {
//                if (strcmp($prop, "") == 0) {
//                    switch ($law) {
//                        case $law_decreto:
//                            $url.=$url_law_dec;
//                            break;
//                        case $law_resolucao:
//                            $url.=$url_law_res;
//                            break;
//                        case $law_portaria:
//                            $url.=$url_law_por;
//                            break;
//                        case $law_edital:
//                            $url.=$url_law_edi;
//                            break;
//                        default:
//                            return $ERROR_wrongDoc;
//                    }
//                } else {
//                    return $ERROR_wrongDoc;
//                }
//            }
//            $url.=$separator;
//            //append year
//            $url = $url . $POST_parameter_year . $equal . $year;
            //echo "<br> URL: " . $url . "<br>";
            //append keyswords
            //$url=

            return $url;
        }

        function mountSearchSQL($doc, $year, $prop, $law, $keyWords) {

            //variaveis
            global $subst_type, $subst_year;
            global $type_prop, $type_law;
            global $ERROR_wrongDoc, $ERROR_wrongDoc;
            global $sql_select, $sql_matter_law, $sql_matter_prop, $sql_and, $sql_or,
            $sql_where, $sql_type, $sql_year, $sql_term_separator;
            global $sql_prop_titulo, $sql_prop_sumula, $sql_prop_conteudo, 
                    $sql_like, $sql_order, $sql_term_generical_term, $sql_term_comma,
                    $sql_term_init_parenthesis, $sql_term_final_parenthesis, $sql_term_join;

            $sql = $sql_select;

            $previous = false;
            $moreThanOneTable=false;

            if (strcmp($doc, $type_prop) == 0) {
                //proposiÁ„o
                $sql.= $sql_matter_prop;
            } else {
                if (strcmp($doc, $type_law) == 0) {
                    //lei
                    $sql.= $sql_matter_law;
                } else {
                    $sql.= $sql_matter_law . $sql_term_comma . $sql_matter_prop;
                    $moreThanOneTable=true;
                }
            }

            //se tudo menos materia n„o for vazio
            if (strcmp($prop, "") != 0 || strcmp($law, "") != 0 ||
                    strcmp($year, "") != 0 || strcmp($keyWords, "") != 0) {
                $sql.=$sql_where;
            }

            if (strcmp($prop, "") != 0) {
                //considera proposiÁ„o
                $sql.=$sql_type; //select * from XX where type='#type"'
                //substitui type pela proposiÁ„o

                $sql = replaceString($sql, $subst_type, takeProp($prop));
                $previous = true;
            }
            if (strcmp($law, "") != 0) {
                //considera proposiÁ„o
                if ($previous) {
                    $sql.=$sql_and;
                }
                $sql.=$sql_type; //select * from XX where type='#type"'
                //substitui type pela proposiÁ„o
                $sql = replaceString($sql, $subst_type, takeLaw($law));
                $previous = true;
            }

            if (strcmp($year, "") != 0) {
                if ($previous) {
                    $sql.=$sql_and;
                }
                $sql.=$sql_year;
                $sql = replaceString($sql, $subst_year, $year);
                $previous = true;
            }

            if (strcmp($keyWords, "") != 0) {
                //insere vetores de palavras chave na query  
                if ($previous) {
                        $sql.=$sql_and;
                        $previous=true;
                    }
                $moreThanOneWord=false;
                for ($i = 0; $i < count($keyWords); $i++) {
                    if ($moreThanOneWord) {
                        $sql.=$sql_and;
                    }
                    $sql.=$sql_term_init_parenthesis;
                    $sql.=$sql_prop_titulo . $sql_like . $sql_term_separator . $sql_term_generical_term . $keyWords[$i] . $sql_term_generical_term . $sql_term_separator;
                    $sql.=$sql_or;
                    $sql.=$sql_prop_sumula . $sql_like . $sql_term_separator . $sql_term_generical_term . $keyWords[$i] . $sql_term_generical_term . $sql_term_separator;
                    $sql.=$sql_or;
                    $sql.=$sql_prop_conteudo . $sql_like . $sql_term_separator . $sql_term_generical_term . $keyWords[$i] . $sql_term_generical_term . $sql_term_separator;
                    $sql.=$sql_term_final_parenthesis;
                    $moreThanOneWord=true;
                }
            }

            //echo "Teste SQL3: " . $sql . "<br>";

            return $sql;
        }

        function mountPanel($totalTuples, $searchTerm_page, $year, $prop, $law, $doc, $keywords) {

            global $num_por_pagina;
            global $POST_parameter_page, $POST_parameter_year,
            $POST_parameter_prop, $POST_parameter_law,
            $POST_parameter_doc, $POST_parameter_keywords;

            $totalPages = $totalTuples / $num_por_pagina;
            //echo $total_paginas;
            $prev = $searchTerm_page - 1;
            $next = $searchTerm_page + 1;

            if ($searchTerm_page > 1) {
                $prev_link = "<a href=\"$PHP_SELF?"
                        . "$POST_parameter_page=$prev"
                        . "&$POST_parameter_year=$year"
                        . "&$POST_parameter_law=$law"
                        . "&$POST_parameter_doc=$doc"
                        . "&$POST_parameter_keywords=$keywords"
                        . "&$POST_parameter_prop=$prop\">Anterior</a>";
            } else { // sen√£o n√£o h√° link para a p√°gina anterior
                $prev_link = "Anterior";
            }
            if ($totalPages > $searchTerm_page) {
                $next_link = "<a href=\"$PHP_SELF?"
                        . "$POST_parameter_page=$next"
                        . "&$POST_parameter_year=$year"
                        . "&$POST_parameter_law=$law"
                        . "&$POST_parameter_doc=$doc"
                        . "&$POST_parameter_keywords=$keywords"
                        . "&$POST_parameter_prop=$prop\">Pr&oacute;xima";
            } else {
                // sen√£o n√£o h√° link para a pr√≥xima p√°gina
                $next_link = "Pr&oacute;xima";
            }

            $totalPages = ceil($totalPages);
            //echo $total_paginas;
            $painel = "";
            for ($x = 1; $x <= $totalPages; $x++) {
                if ($x == $searchTerm_page) {
                    // se estivermos na p√°gina corrente, n√£o exibir o link para visualiza√ß√£o desta p√°gina 
                    $painel .= " [$x] ";
                } else {
                    $painel .= " <a href=\"$PHP_SELF?"
                            . "$POST_parameter_page=$x"
                            . "&$POST_parameter_year=$year"
                            . "&$POST_parameter_law=$law"
                            . "&$POST_parameter_doc=$doc"
                            . "&$POST_parameter_keywords=$keywords"
                            . "&$POST_parameter_prop=$prop\">[$x]</a>";
                }
            }
            $panel = "<br><br>" . $prev_link . " | " . $painel . " | " . $next_link . "<br><br>";
            return $panel;
        }

        function prepareParameters($year, $prop, $law, $doc, $keywords, $page, &$totalTuples) {

            global $defaultAno, $num_por_pagina;
            global $ERROR_blankDoc, $ERROR, $ERROR_blankProp, $ERROR_blankLaw;

            $error = false;

            //ERROS
            //1- se tudo estiver em branco, deve existir palavras chave
            if (strcmp($doc, "") == 0 &&
                    strcmp($year, "") == 0 &&
                    strcmp($prop, "") == 0 &&
                    strcmp($law, "") == 0 &&
                    strcmp($keywords, "") == 0) {
                $result = $ERROR_blankDoc;
                $error = true;
            }

            //separa palavras chave
            if (!$error && strcmp($keywords, "") != 0) {
                $result = wordKeysInAVector($keywords);
                if ($result != $ERROR) {
                    $workKeysVector = $result;
                }
            }

            if (!$error && validatedMatter($prop) == $ERROR) {
                $result = $ERROR_blankDoc;
                $error = true;
            }
            if (!$error && validatedPropositions($prop) == $ERROR) {
                $result = $ERROR_blankProp;
                $error = true;
            }
            if (!$error && validatedPropositions($law) == $ERROR) {
                $result = $ERROR_blankLaw;
                $error = true;
            }
            if (!$error) {
                //mount SQL
                $result = mountSearchSQL($doc, $year, $prop, $law, $workKeysVector);
                //conta quantidade de p·ginas
                $totalTuples = countTuples($result);
                //echo "Total de tuplas: " . $totalTuples . "<br>";

                if ($totalTuples <= $ERROR) {
                    $error = true;
                } else {
                    $firstRecord = ($page * $num_por_pagina) - $num_por_pagina;
                    $itemMateria = prepareQuery($result, $firstRecord);
                    //itemMateria s„o as tuplas da consulta, este valor ser· passado como par‚metro para ser mostrado em tela
                    //echo "Materias: " . $itemMateria . "<br>";
                }
            }

            //analisa resultado da montagem da URL
            if (!$error) {
                $result = $itemMateria;
                //redirectToPage($result);
            }
            return $result;
        }
        ?>

    </body>
</html>