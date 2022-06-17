
<script>
        function changedOption(el) {
            //alert (el.value);
            var table = document.all ? document.all.aTable :
                    document.getElementById('aTable');
            if (el.value == "proposicao") {
                //alert ("true");
                table.rows[4].style.display = 'none';
                table.rows[3].style.display = '';
                return true;
            } else {
                //alert ("false");
                table.rows[3].style.display = 'none';
                table.rows[4].style.display = '';
                return false;
            }
        }

function hideRow(rowIndex, tableName) {
    var table = document.all ? document.all.aTable : document.getElementById(tableName);
    table.rows[rowIndex].style.display = 'none';
}
function showRow(rowIndex, tableName) {
    var table = document.all ? document.all.aTable : document.getElementById(tableName);
    table.rows[rowIndex].style.display = '';
}

function toogleRowMatter(matter,table) {

        var e = document.getElementById(matter);
        var itemSelecionado = e.options[e.selectedIndex].value;
        var table = document.getElementById(table);
        
        if (itemSelecionado == "proposicao"){
            //alert("1");
            table.rows[2].style.display = '';
            table.rows[3].style.display = 'none';
        }else{
            if (itemSelecionado == "lei"){
            table.rows[2].style.display = 'none';    
            table.rows[3].style.display = '';
                
            }else{
                table.rows[2].style.display = '';
                table.rows[3].style.display = '';
            }
                
        }
        //var table = document.all ? document.all.aTable :
        //document.getElementById(tableName);
        //table.rows[rowIndex].style.display = '';
        }

</script>
