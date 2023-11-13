<?php
	include('funcoes.php');
	session_start();
	 if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))	{
		session_destroy();
		header('location:index.php?erro=Faça o login novamente!');
	}
	else {
		$logado = $_SESSION['nome'];
		$foto = "fotos/".$_SESSION['foto'];
		$id = $_SESSION['id'];
		$tipo = $_SESSION['tipo'];
		$primeironome = primeiro_nome($logado);
		$turno = $_SESSION['turno'];
		echo "<strong>$primeironome</strong>";
		echo " <img class='mdl-chip__contact' src='$foto'>";

	}
?>
