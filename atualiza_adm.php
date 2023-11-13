<?php
    include("conexao.php");
    include("validar.php");
    $nome = strtoupper($_POST['nome']); //Deixa o texto sempre em MAIUSCULO
    $login = $_POST['login'];
    if ($_POST['senha1'] == $_POST['senha2']) {
        $senha = $_POST['senha1'];
        $sql = "UPDATE administradores SET
            nome = '$nome',
            login = '$login',
            senha = '$senha'
            where id_admin = '$id'";
        mysqli_query($conexao, $sql);
        //echo "<h1>$id - $nome - $sexo - $data_nascimento - $cpf - $rg -$telefone - $email - $foto</h1>";
        header('location:index.php?erro=Dados Atualizados - Faça o login novamente.');
    }
    else {
        header('location:cadastro_adm.php?erro=Senhas não conferem!');
    }
 ?>
