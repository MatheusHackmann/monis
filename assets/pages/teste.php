<form action="teste1.php" method="POST">
<?php

$secretarias = array('Administração e Recursos Humanos', 'Cultura, Esportes e Lazer', 'Controle Interno E Transparência', 'Comunicação Social', 'Defesa, Proteção e Preservação do Meio Ambiente', 'Educação', 'Financas e Orçamento', 'Gabinete / Vice-Gabinete', 'Governo E Participação Cidadã', 'Habitação', 'Inclusão, Assistência e Desenvolvimento Social', 'Mobilidade Urbana E Rural', 'Obras', 'Planejamento E Gestão Estratégica', 'Procuradoria Geral do Município', 'Saúde', 'Segurança E Defesa Civil', 'Serviços Públicos', 'Trabalho, Emprego E Desenvolvimento Econômico');

for ($i=0; $i < count($secretarias); $i++) { 
	echo "

	<input type='checkbox' name='secs[]' value='".$secretarias[$i]."' style='padding: 5px;' />
	".$secretarias[$i]."<br>
	";
}

?>	

<button type="submit">Enviar</button>
</form>
	
