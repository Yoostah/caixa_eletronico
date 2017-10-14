<script>
function campo_vazio() {

    var x = document.getElementById("vlr_saque").value;
    
    if (x == "") {
        alert("Informe o valor do saque!");
        return false;
    }else{
    	return true;
    }
}	
</script>