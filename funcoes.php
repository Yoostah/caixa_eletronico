<?php
/* Recebe uma mensagem como parâmetro e abre um alert com essa mensagem */
function _JS_Alerta($js){
echo '<script language="JavaScript" type="text/javascript">alert("'.$js.'"); </script>';

}

/* Recebe o id de um campo de text e um valor. Insere o valor no campo com o id informado */
function _PreencherCampos($id_campo, $valor){
echo '<script language="JavaScript" type="text/javascript">document.getElementById("'.$id_campo.'").value = "'.$valor.'";</script>';

}
?>