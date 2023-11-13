<?php
	session_start();
	$_SESSION['login'] = null;
	$_SESSION['senha'] = null;

	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	session_destroy();
	header('Location: index.php?erro=Obrigad@! Até Breve! 🥰🍽️');
?>
