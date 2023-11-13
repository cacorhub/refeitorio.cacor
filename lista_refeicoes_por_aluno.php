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
                 <h4>Histórico de Refeições</h4>

             </div>
         </div>
         <div class="row">
             <div class="col s12">
                 <?php
                     if ( !empty($_GET['id_aluno']) ) {
                         $id_aluno = $_GET['id_aluno'];
                         $matricula = $_GET['matricula'];
                         $nome = $_GET['nome'];
                         $tipo = $_GET['tipo'];
                         $foto = $_GET['foto'];
                         //$hora_entrega = $_GET['hora_entrega'];
                         $ordem =" order by data_ficha desc";
                     }
                     else {
                         $quando = '';
                         $ordem =" order by data_ficha desc";
                         echo "<div class='chip  teal lighten-5'>TODOS OS REGISTROS</div>";
                    }
                    // Escrevendo quadro com dados do aluno
                    echo "<div class='card-panel  yellow lighten-5'>
                        <img src='$foto' class='foto_media materialboxed'>
                        <p>Matrícula: <strong>$matricula</strong></p>
                        <p>Aluno: <strong>$nome </strong></p>
                    </div>";

                    // Consulta de acordo com a variável Tipo: P para histórico de pendencias e H para todo o histórico
                    if ($tipo == 'H') {
                        $sql1 = "select * FROM historico_ficha WHERE aluno_id= $id_aluno order by data_ficha desc";
                    } else {
                        $sql1 = "select * FROM ficha WHERE aluno_id=$id_aluno and pendente = 1 order by data_ficha desc";
                    }

                    $query_cardapio = $mysqli->query($sql1);
                    $row = $query_cardapio->num_rows;
                    if ($row > 0)   {
                         echo "<div class='chip yellow'>$row registros encontrados</div>";
                         // Escrevendo cabeçalhos da tabela
                         echo "
                         <table class='highlight'>
                         <thead><tr>
                             <th>Data da Refeição</th>
                             <th>Situação</th>
                             <th>Hora reserva / Entrada</th>
							 <th>Tipo de Refeição</th>
                         </tr> </thead>
                         <tbody>";
                        $i = 0;
                         while ( $linha = $query_cardapio -> fetch_array() ) {
                             $id_ficha = $linha['id_ficha'];
                             $aluno_id = $linha['aluno_id'];
                             $data_ficha = $linha['data_ficha'];
                             $data = inverte_data($linha['data_ficha']);
                             $hora_reserva = $linha['hora_reserva'];
                             $pendente = $linha['pendente'];
							 $refeicao = $linha['refeicao'];
                             if (isset($linha['hora_entrega'])) {
                                 $hora_reserva = $hora_reserva ."  /  "  .$linha['hora_entrega'];
                             }
                             if ($pendente == 0) {
                                $situacao = 'Alimentou-se';
                             }else {
                                $situacao = "<span class='alert'>Pendente</span>";
                             }

                             echo "<tr>"; // MOSTRANDO A TABELA NA TELA...
                             //<td><img class='circle pequeno materialboxed' src='$foto'></td>  //NÃO MOSTRANDO A FOTO DO ALUNO
                             echo "
                             <td>$data</td>
                             <td>$situacao</td>
                             <td>$hora_reserva</td>
							 <td>$refeicao</td>
                             </tr>";
                            // Armazenando valores em um vetor de dados...
                            $vetor[$i] = "$id_ficha, $aluno_id, '$data_ficha', '$hora_reserva', $pendente";						
                            $i = $i + 1;
                         }
                        echo "</tbody></table>";
                    } else {
                        if ($tipo == 'P') {
                            echo "<div class='centralizado red lighten-4'>Não há pendências a serem retiradas.</div>";
                        }
                        else {
                             echo "<div class='centralizado yellow'>Não há registros de uso do refeitório.</div>";
                        }
                    }
                 ?>
             </div>
             <?php
             if (($tipo == 'P') && ($row >= 3) ) { // MOSTRARÁ O BOTÃO LIBERAR PENDENCIAS SOMENTE SE A CONSULTA FOR "P" DE PENDENCIAS.
                 echo "<div class='col s12'>
                       <a href='#modal_confirma'><button type='button' class='btn red'>Retirar pendências</button></a>
                 </div>";
             }

             ?>
         </div> <!--  Final da Linha  -->
     </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->



     <!-- Modal -Confirmação de DESCBLOQUEI DE CADASTRO -->
     <div id="modal_confirma" class="modal">
         <div class="modal-content">
             <h4>Desbloqueio de Cadastro</h4>
             <h5>Confirma o desbloqueio do cadastro do aluno?</h5>
             <p>Obs: As informações de pendências continuarão no histórico do aluno, sendo que o cadastro estará liberado e será bloqueado novamente quando ocorrerem 3 pendências.</p>
         </div>
         <div class="modal-footer">
            <form action="exclui_pendencias.php" method="post">
                <!-- <input type="hidden" name="id_aluno" value=" "> -->
            <?php
                    //$consulta = "select `id_ficha`, `aluno_id`, `data_ficha`, `hora_reserva`, `pendente` FROM ficha WHERE aluno_id=$id_aluno and pendente = 1";
                foreach ($vetor as $key => $value) {
                    //echo "tuplas_$key -  $value<br>"; // Mostrando na tela as tubplas do vetor...
                    echo "<input type='hidden' name='tuplas_$key'" . 'value="'.$value .'">';
                }
            ?>
            <input type="submit" value="Sim" class="btn">
            <a href='#' class='modal-action modal-close waves-effect waves-red btn-flat'>Fechar</a>
            </form>
         </div>
     </div> <!-- Finda da janela Modal - -->



  </body>
    <?php
        include("extends.php");
    ?>



</html>
