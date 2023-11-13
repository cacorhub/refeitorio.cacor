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
                 <h3>Relação de alunos com pendências</h3>
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
                         $ordem =" order by nome";
                         $data = inverte_data($data_pesquisa);
                         echo "<h5 class='centralizado'>Almoço do dia: $data</h5>";

                     }
                     else {
                         $quando = '';
                         $hoje = Date('Y-m-d');
                         $ordem =" order by nome desc";
                         echo "<div class='chip  teal lighten-5'>TODOS OS REGISTROS</div>";
                    }
                    $sql1 = "select * FROM alunos, ficha WHERE alunos.id=aluno_id AND pendente = 1 AND data_ficha <> '$hoje' order by data_ficha desc";
                    $query_cardapio = $mysqli->query($sql1);
                    $row = $query_cardapio->num_rows;
                    if ($row > 0)   {
                         echo "<div class='chip yellow'>$row registros encontrados</div>";
                         // Escrevendo cabeçalhos da tabela
                         echo "
                         <table class='highlight'>
                         <thead><tr>
                             <th>Matrícula</th>
                             <th>Nome</th>
                             <th>Data do Almoço</th>
                             <th>Hora da solicitação</th>
                             <th>opções</th>
                         </tr> </thead>
                         <tbody>";

                         while ( $linha = $query_cardapio -> fetch_array() ) {
                             $id_ficha = $linha['id_ficha'];
                             $matricula = $linha['matricula'];
                             $nome = $linha['nome'];
                             $data_ficha = inverte_data($linha['data_ficha']);
                             $hora_reserva = $linha['hora_reserva'];
                             //$foto=  "fotos/" .$linha['arquivo_foto'];

                             // escrevendo linhas da tabela
                             echo "<tr>";
                             //<td><img class='circle pequeno materialboxed' src='$foto'></td>  //NÃO MOSTRANDO A FOTO DO ALUNO
                             echo "<td>$matricula</td>
                             <td>$nome</td>
                             <td>$data_ficha</td>
                             <td>$hora_reserva</td>
                             <td>

                            </td>
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
