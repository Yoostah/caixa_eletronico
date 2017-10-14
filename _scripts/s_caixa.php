<script>

function mostra_extrato(){
	var x = document.getElementById("extrato");
	
	if (x.style.display === "none") {
        x.style.display = "block";
        document.getElementById('btn_extrato').innerHTML = "Fechar Extrato"
    } else {
        x.style.display = "none";
        document.getElementById('btn_extrato').innerHTML = "Mostrar Extrato"
    }

}


</script>