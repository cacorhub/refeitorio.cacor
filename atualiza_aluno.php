<?php
    include("conexao.php");
    include("validar.php");
	
	
  // ENVIANDO ARQUIVO ANEXADO PARA SERVIDOR
  // Repassa a variável do upload
  $foto = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
  // Caso a variável $arquivo contenha o valor FALSE, esse script foi acessado
  // diretamente, então mostra um alerta para o usuário
  if(!$foto) {
	echo '<div class="alert alert-error">Não Envie o arquivo diretamente!</div>';
    }
    // Imagem foi enviada, então a move para o diretório desejado
    else {
        // Diretório para onde o arquivo será movido
        $diretorio = "fotos/";
        // Move o arquivo
        // Lembrando que se $arquivo não fosse declarado no começo do script,
        // você estaria usando $_FILES["arquivo"]["tmp_name"] e $_FILES["arquivo"]["name"]
        if (move_uploaded_file($foto["tmp_name"], $diretorio . iconv("ISO-8859-1", "UTF-8", $foto["name"]))) {
            $arq = utf8_decode($foto['name']);
            //echo '<div class="alert alert-success">Foto Cadastrada com Sucesso!</div>';
            $mudou_foto = true;
        }
        else  {
            //echo '<div class="alert alert-error">Erro ao enviar seu arquivo!s</div>';
            $mudou_foto = false;
        }
    }
// FIM ----- ENVIANDO ARQUIVO ANEXADO PARA SERVIDOR




      $ativo = $_POST['ativo'];
      $id_aluno = $_POST['id_aluno'];
      $nome = strtoupper($_POST['nome']); //Deixa o texto sempre em MAIUSCULO
      $sexo = $_POST['sexo'];
      $data_nascimento =  $_POST['data_nascimento'];
      $cpf=  $_POST['cpf'];
      $rg=  $_POST['rg'];
      $telefone=  $_POST['telefone'];
      $email=  strtolower($_POST['email']); //Deixa o texto sempre em minusculo
      if ($mudou_foto)  { // Nâo trocar a foto caso não tenha sido selecionada.
          $foto = $_FILES["foto"]["name"];
      }
      else {
          $foto = $_POST['foto_anterior'];
      }
        $sql = "UPDATE alunos SET
            ativo = $ativo,
            nome = '$nome',
            sexo = '$sexo',
            data_nascimento = '$data_nascimento',
            cpf = '$cpf',
            rg ='$rg',
            telefone = '$telefone',
            email = '$email',
            arquivo_foto = '$foto'
            where id = '$id_aluno'";
    //$query = $mysqli->query($sql);
    mysqli_query($conexao, $sql);
		
    /* commit transaction */
    //$mysqli->commit();

    //echo "<h1>$id - $nome - $sexo - $data_nascimento - $cpf - $rg -$telefone - $email - $foto</h1>";

    if ($tipo == 'ADM') {
        header("location:lista_alunos_adm.php?erro=<div class='alert'>Dados de $nome Atualizados</div>");
    } else {
        header("location:cadastro.php?erro=<div class='alert'>$nome, seus dados foram atualizados</div>");
    }



 ?>
