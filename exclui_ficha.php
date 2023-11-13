    <?php
        include("conexao.php");
        include "validar.php";

    //  function verifica_cardapio_hoje($data) {
    if (!empty($_GET['getficha'])) {
        $id_ficha = $_GET['getficha'];
        $data_cardapio = $_GET['data_cardapio'];
        //$ids = $_POST['cod_cardapio'];
        $sql = "DELETE FROM `ficha` WHERE `id_ficha` = $id_ficha";
        mysqli_query($conexao, $sql);
        //echo "Lista de exclusão! - $ids";
        //echo "$ids";
        header("location:lista_alunos_adm_fichas.php?data_cardapio=$data_cardapio");
        //echo "Excluido";
    }
    else {
        //echo "Não funcionou";
        header('location:lista_alunos_adm_ficha.php?erro=Ficha NÃO pode ser exluida!');

    }
?>
