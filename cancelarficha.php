<?php
  include("headers.php");
  //menu e verificacao de usuario
  include("menus.php");
  //conexao com o banco de dados
  include("conexao.php");

  $aluno_id = $_POST['id_aluno'];
  $data_ficha = $_POST['data_hora'];
  $refeicao = $_POST['refeicao'];

  cancelarficha($conexao, $aluno_id, $data_ficha, $refeicao);
  session_destroy();
  header("Location: index.php?erro=Sua refeição de hoje foi Cancelada.");

?>
