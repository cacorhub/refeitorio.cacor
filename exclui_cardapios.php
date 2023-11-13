    <?php
        include("conexao.php");

    //  function verifica_cardapio_hoje($data) {
    if (!empty($_POST['ids'])) {

        $ids = $_POST['ids'];
        //$sql = "DELETE FROM `cardapio` WHERE `id` = $ids";

        //mysqli_query($conexao, $sql);
        echo "Lista de exclusão! - $ids";
        //echo "$ids";
        //header('location:lista_cardapios_adm.php?erro=Cardápios Excluidos com sucesso!');
    }
    else {
        header('location:lista_cardapios_adm.php?erro=Cardápios selecionados NÃO puderam ser exluidos!');
    }
?>
