    <?php
        include("conexao.php");
            foreach ($_POST as $key => $values) {
				$ficha= explode (",", $values);
                $sql = "UPDATE ficha SET pendente=2 WHERE id_ficha=$ficha[0]";
                mysqli_query($conexao, $sql);
                //sleep(0.2); // Dando uma pausa para não ir tão rápido no SGBD MySQL.
            }
           	header('location:lista_alunos_adm.php?erro=Pendências Excluidas!');
?>
