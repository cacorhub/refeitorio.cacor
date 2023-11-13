    <?php
        include("conexao.php");
    //  function verifica_cardapio_hoje($data) {
    if (!empty($_POST['id_aluno'])) {
		$id_aluno = mysqli_real_escape_string($conexao, $_POST['id_aluno']);
        $id_aluno = $_POST['id_aluno'];
        $sql = "UPDATE `alunos` set senha = matricula WHERE `id` = $id_aluno";
        mysqli_query($conexao, $sql);
        //echo "Lista de exclusão! - $ids";
        //echo "$id_aluno";
        header('location:lista_alunos_adm.php?erro=Senha resetada!');
    }

?>
