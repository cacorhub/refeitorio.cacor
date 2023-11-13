    <?php
        include("conexao.php");

    //  function verifica_cardapio_hoje($data) {
    if (!empty($_POST['id_c'])) {
        $id_c = $_POST['id_c'];
        $descricao = $_POST['descr'];
        $qtd_l = $_POST['qtd_ll'];
        $sql = "UPDATE `cardapio` SET `qtd_limite` = '$qtd_l', `Descricao` = '$descricao' WHERE `id` = $id_c";
        mysqli_query($conexao, $sql);
        //echo "Atualizado! ";
        header('location:lista_cardapios_adm.php?erro=Alterado com sucesso!');
    }
    else {
        //echo "<div class='chip  red lighten-3'>Erro! Não Atualizado!</div>";
    }
?>
