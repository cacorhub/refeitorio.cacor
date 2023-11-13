<!DOCTYPE html>
<html>
  <head>
    <!-- Efeito Piscar Pesquisa -->
	<script type="text/javascript">
	function pisca() {
		var f = document.getElementById('led_pisca');
		setInterval(function(){
			f.style.visibility = (f.style.visibility == 'hidden' ? '' : 'hidden');
			},500);
	}
	</script>
    <!-- Metadados sobre o site -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade para dispositivos móveis -->
    <meta name="Sistema de Controle do Restaurante Institucional" content="Desenvolvido pelos professores de informática do IFPI Campus Corrente: Felipe Santos, Jonathas Jivago e Robson Borges">

    <title>#RefeitórioWeb 🍽️</title>
    <link rel="shortcut icon" href="img/users.ico">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="estilo.css" type="text/css">
    <script type="text/javascript" src="js/materialize.js">
    </script>
  </head>
