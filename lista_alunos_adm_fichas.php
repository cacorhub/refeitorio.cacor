<?php
    include("headers.php");
 ?>
 <body>
    <?php
        include("menus_adm.php");
        include("conexao.php");
     ?>
     <!-- Conteudo da página principal... -->
     <div class='container'>
         <div class='row'>
             <div class='col s12'>
                 <h3>Relação de alunos que solicitaram ticket</h3>
             </div>
         </div>
         <div class="row">
            <div class="col12">
             <form action="lista_alunos_adm_fichas.php" method="post">

             </form>
            </div>
         </div>
         <div class="row">
             <div class="col s12">
                 <?php
                     if ( !empty($_GET['data_cardapio']) ) {
                         $data_pesquisa = $_GET['data_cardapio'];
                         $tipo  = $_GET['tipo'];
                         $ordem = $_GET['ordem'];
						 $refeicao = $_GET['refeicao'];
                         $data = inverte_data($data_pesquisa);
                         if($refeicao == 'A'){
						 echo "<h5 class='centralizado'>Almoço do dia: $data</h5>";
						 }else{
							echo "<h5 class='centralizado'>Janta do dia: $data</h5>";
						 }

                     }
                     if ($tipo == 'H') {
                        $sql1 = "select * FROM alunos, historico_ficha WHERE alunos.id=aluno_id AND data_ficha = '$data_pesquisa' AND refeicao = '$refeicao' order by $ordem";
                        $ordem_tipo_Hist = 'hora_entrega';
                     } else {
                        $sql1 = "select * FROM alunos, ficha WHERE alunos.id=aluno_id AND pendente = 1 AND data_ficha = '$data_pesquisa' AND refeicao = '$refeicao' order by $ordem";
                        $ordem_tipo_Hist = 'hora_reserva';
                     }

                    $query_cardapio = $mysqli->query($sql1);
                    $row = $query_cardapio->num_rows;
                    if ($row > 0)   {
                         echo "<div class='chip yellow'>$row registros encontrados</div>";
                         // Escrevendo cabeçalhos da tabela
                         echo "
                         <table class='highlight'>
                         <thead><tr>
                             <th><a href='lista_alunos_adm_fichas.php?data_cardapio=$data_pesquisa&tipo=$tipo&ordem=matricula'>Matrícula</a></th>
                             <th><a href='lista_alunos_adm_fichas.php?data_cardapio=$data_pesquisa&tipo=$tipo&ordem=nome'>Nome</a></th>
                             <th><a href='lista_alunos_adm_fichas.php?data_cardapio=$data_pesquisa&tipo=$tipo&ordem=cpf'>CPF</a></th>
                             <th><a href='lista_alunos_adm_fichas.php?data_cardapio=$data_pesquisa&tipo=$tipo&ordem=hora_reserva'>Hora reserva</a></th>
                             <th><a href='lista_alunos_adm_fichas.php?data_cardapio=$data_pesquisa&tipo=$tipo&ordem=$ordem_tipo_Hist'>Status</a></th>


                         </tr> </thead>
                         <tbody>";
                        //      <th>opções</th>
                         while ( $linha = $query_cardapio -> fetch_array() ) {
                             $id_ficha = $linha['id_ficha'];
                             $id = $linha['id'];
                             $matricula = $linha['matricula'];
                             $nome = $linha['nome'];
                             $cpf = $linha['cpf'];
                             $pendencia = $linha['pendente'];
                             $hora = $linha['hora_reserva'];
                             $foto=  "fotos/" .$linha['arquivo_foto'];
                             if ($tipo == 'H') {
                                $hora_entrega = "às " .$linha['hora_entrega'];
                             } else {
                                 $hora_entrega = "";
                             }
                            if ($pendencia == 0) {
                                $status = 'Almoçou';
                            } elseif ($tipo == 'H') {
                                $status = "<span class='alert'>Pendente</span>";
                                $hora_entrega = '';
                            } else {
                                $status = "Reservado às $hora";

                            }

                             // escrevendo linhas da tabela
                             echo "<tr>";
                             //<td><img class='circle pequeno materialboxed' src='$foto'></td>  //NÃO MOSTRANDO A FOTO DO ALUNO
                             echo "<td>$matricula</td>
                             <td><a href='lista_refeicoes_por_aluno.php?id_aluno=$id&nome=$nome&matricula=$matricula&foto=$foto&tipo=H&hora_entrega=$hora_entrega'>$nome</a></td>
                             <td>$cpf</td>
                             <td>$hora</td>
                             <td>$status $hora_entrega</td>


                             <td>";
                                // <a href='exclui_ficha.php?getficha=$id_ficha&data_cardapio=$data_pesquisa'><img src='img/delete.png' alt='Excluir'></a>
                            echo "</td>
                             </tr>";
                         }
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='centralizado yellow'>Nenhum aluno reservou ficha para esta data.</div>";
                    }


                 ?>

             </div>
         </div> <!--  Final da Linha  -->




     </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->


  </body>
    <?php
        include("extends.php");
    ?>



</html>
