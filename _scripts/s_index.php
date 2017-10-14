<script>
function campo_vazio() {

    var agencia,conta,senha;

    agencia = document.getElementById("agencia").value;
    conta = document.getElementById("conta").value;
    senha = document.getElementById("senha").value;
    
    if (agencia == "") {
        alert("O campo 'Agência' não pode ser vazio!");
        return false;
    }else if (conta == ""){
    	alert("O campo 'Conta' não pode ser vazio!");
        return false;
    }else if (senha == ""){
    	alert("O campo 'Senha' não pode ser vazio!");
        return false;
    }else{
    	return true;
    }
}	
</script>