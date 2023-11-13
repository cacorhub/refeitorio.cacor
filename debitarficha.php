<?php

    include("headers.php");
    include("menus.php");
    include("conexao.php");

    //Formulario de verificação envia o id do aluno.
	echo '<center> <form action="test.php" method="post" enctype="multipart/form-data">
		<label>Matricula do Aluno</label> <br>
	  	<input type="text" value="" name="aluno_id" > <br>
	  	<input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect 
	  	mdl-button--accent" type="submit" id="enviar informações" value="Verificar">    
	</form> <center>';


?>

