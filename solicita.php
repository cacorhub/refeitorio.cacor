<?php
  include("headers.php");
  //menu e verificacao de usuario
  include("menus.php");
  //conexao com o banco de dados
  include("conexao.php");
  //recebendo do form solicita ticket
  $aluno_id = $_POST['id_aluno'];
  $data_hora = $_POST['data_hora'];
  $refeicao = $_POST['refeicao'];
  //exibindo as informacoes do usuario
  echo $data_hora;
  echo "$aluno_id";
  echo "$refeicao";
  //Verificando a quantidade de fichas disponíveis no dia
    if (cadastrarFicha($conexao, $aluno_id, $data_hora, $refeicao)) {
        header("Location: index.php?erro=Sua refeição de hoje foi reservada 🍽️.");
        session_destroy();
    }
    else {
        header("Location:solicita_ticket.php?erro=Limite máximo de refeições atingido.<br>SUA REFEIÇÃO NÃO FOI RESERVADA $aluno_id $data_hora $refeicao");
    }



?>
