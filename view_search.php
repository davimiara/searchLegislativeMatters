<html>
    <body>
        <?
        //includes
        include_once './includes/view_messages.inc.php';
        include_once './includes/global_functions.inc.php';
        include_once './includes/view_functions.inc.php';
        //include './includes/global_staticVars.inc.php';
        
        //JS
        include './javascript/js.js';
                  
        ?>
        
        <h3 align="center"><font face='verdana'>Busca por mat&eacute;rias legislativas anteriores &agrave; 2015<br></font></h3>
        
        <?
        //take URL parameters
        $searchTerm_error = takePOSTValues($POST_parameter_errorCode);
        //show error
        if ($searchTerm_error < 0) {
            viewErrorMessage(translateErrors($searchTerm_error));
        }
        ?>

        
        <FORM action="./view_matter.php" method="GET">

            <P>
            <table width="100%"  border="0" id="aTable">
                <tr id="1">
                    <td>
                        <h4><? echo $search_doc; ?></h4>
                    </td>
                    <td>
                        <SELECT id="matter" name="<? echo $POST_parameter_doc; ?>" onchange="toogleRowMatter('matter','aTable');">
                            <option value="" selected="selected"></option>
                            <option value="proposicao">Proposi&ccedil;&atilde;o</option>
                            <option value="lei">Lei</option>
                        </SELECT>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr id="2">
                    <td>
                        <h4><? echo $select_year; ?></h4>
                    </td>
                    <td>
                        <SELECT name="<? echo $POST_parameter_year; ?>">
                            <option value="" selected="selected"></option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                        </SELECT>
                    </td>
                </tr>
                <tr id="3">
                    <td>
                        <h4><? echo $select_prop; ?></h4>
                    </td>
                    <td>
                        <SELECT name="<? echo $POST_parameter_prop; ?>">
                            <option value="" selected="selected"></option>
                            <option value="indicacao">Indica&ccedil;&atilde;o</option>
                            <option value="mocao">Mo&ccedil;&atilde;o</option>
                            <option value="requerimento">Requerimento</option>
                            <option value="projeto">Projetos</option>
                        </SELECT>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr id="4">
                    <td>
                        <h4><? echo $select_law; ?></h4>
                    </td>
                    <td>
                        <SELECT name="<? echo $POST_parameter_law; ?>">
                            <option value="" selected="selected"></option>
                            <option value="decreto">Decreto</option>
                            <option value="resolucao">Resolu&ccedil;&otilde;es</option>
                            <option value="edital">Editais</option>
                            <option value="portaria">Portarias</option>
                            <option value="<?php echo $law_organica;?>">Leis Org&acirc;nicas</option>
                            <option value="<?php echo $law_complementar;?>">Leis Complementares</option>
                            <option value="<?php echo $law_remuneracao;?>"><?php echo $view_remuneracao; ?></option>
                            <option value="<?php echo $law_regimento;?>"><?php echo $view_regimento; ?></option>
                        </SELECT>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr id="5">
                    <td>
                        <h4><? echo $select_keywords; ?></h4>
                    </td>
                    <td>
                        <div>
                            <textarea name="<? echo $POST_parameter_keywords; ?>" cols="30" rows="4"></textarea>
                        </div>
                    </td>
                    <td>
                        <p> (separados por ' <b><?php echo $separator_keywords;?> </b>')</p>
                    </td>
                </tr>
            </table>

            <INPUT type="submit" value="Pesquisar">
            </P>
        </FORM>


    </body>
</html>