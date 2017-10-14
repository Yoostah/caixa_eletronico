<script>
function campo_vazio() {

    var x = document.getElementById("vlr_deposito").value;

    if (x == "") {
        alert("Informe o valor do depósito!");
        return false;
    }else{
    	return true;
    }
}	
</script>