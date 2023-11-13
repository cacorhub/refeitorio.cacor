<?php
    include('headers.php');
 ?>
 <body>
    <?php
        include('menus_adm.php');
        include('conexao.php');
     ?>
     <!-- Conteudo da página principal... -->
     <div class='container'>
         <div class='row'>
             <div class='col s12'>
                 <h3>Relação de Cardápios</h3>
             </div>
         </div>
         <div class='row'>
            <div class='col12'>
                <?php  // Exibir mensagem de erro caso ocorra.
                if (isset($_GET["erro"]))  {
                    $erro = $_GET["erro"];
                    echo  "<div class='chip yellow'>$erro</div>";
                }
                ?>
             <form action='lista_cardapios_adm.php' method='post'>
                 <div class='input-field col s4'>
                     Data da inicial
                     <input class='validate' type='date' name='data_incio'>
                 </div>
                 <div class='input-field col s4'>
                     Data da Final
                     <input class='validate' type='date' name='data_final'>
                 </div>
                 <div class='input-field col s4'>
                     <input type='submit' class='btn' value='Listar'>
                 </div>
             </form>
            </div>
         </div>
         <div class='row'>
             <div class='col s12'>
                 <?php
                     if ( !empty($_POST['data_final']) ) {
                         $data_inicio = $_POST['data_incio'];
                         $data_final = $_POST['data_final'];
                         $quando = " where data >= '$data_inicio' and data <= '$data_final'";
                         $ordem =' order by data';
                         $data_inicio = inverte_data($data_inicio);
                         $data_final = inverte_data($data_final);
                         echo "<div class='chip yellow'>Período de $data_inicio até  $data_final</div>";
                     }
                     else {
                         $quando = '';
                         $ordem =' order by data desc';
                         echo "<div class='chip  teal lighten-5'>TODOS OS REGISTROS</div>";
                    }
                     $sql = "select * from cardapio $quando $ordem LIMIT 10";
                     $query = $mysqli->query($sql);
                     $row = $query->num_rows;
                     echo "<div class='chip yellow'>$row registros encontrados</div>";
                     // Escrevendo cabeçalhos da tabela
                     echo "
                    <table class='highlight centered'>
                     <thead><tr>
                     ";
                    //<input type='checkbox' class='filled-in' id='todos' onclick='selecionar_tudo();'>

                    echo "
                     <th>Data</th>
                     <th>Quant. Solicitada e limite</th>
                     <th>Quant. usados</th>
                     <th>Quant. pendetes</th>
                     <th>Taxa disperd.</th>
                     <th class='left'>Descrição</th>
                     <th>Refeição</th>
					 <th>Lista</th>
                     <th>Modifica</th>
                     <th>Excluir</th>
                     </tr>
                     </thead><tbody>"; // Renderizando a linha de cabeçalhos das tabelas.

                    //echo "<form name='f1'>"; // Cria um GRANDE FORMULÁRIO para todos os itens da tabela.

                     while ( $linha = $query -> fetch_array()) {
                         $id = $linha['id'];
                         $descricao = $linha['Descricao'];
                         $data =  $linha['Data'];
                         $data_i =  inverte_data($data);
                         $qtd_l=  $linha['qtd_limite'];
                         $qtd_r=  $linha['reservadas'];
                         $slide=  $linha['slide'];
						 $refeicao=  $linha['refeicao'];

                         $hoje = Date('Y-m-d'); // DESTACANDO DE AMARELO O CARDÁPIO DO DIA
                         if ($data == $hoje) {
                            $cor_hoje = 'lighten-4 yellow';
                         } else {
                            $cor_hoje = '';
                         }

                        // CONTANDO FICHAS NA DATA RESERVADAS
                        $query_reservadas="SELECT count(0) as almocaram FROM ficha WHERE data_ficha = '$data' and refeicao='$refeicao'";
            			$fichas_reservadas = mysqli_query($conexao, $query_reservadas);
            			$result = mysqli_fetch_assoc($fichas_reservadas);
            			$fichas_reservadas = $result['almocaram'];

                        // CONTANDO FICHAS PENDENTES
                        $query_pendentes_hist="SELECT count(0) as pendente FROM ficha WHERE data_ficha = '$data' and (pendente = 1 or pendente = 2) and refeicao='$refeicao'";
            			$fichas_pendentes = mysqli_query($conexao, $query_pendentes_hist);
            			$result_pen = mysqli_fetch_assoc($fichas_pendentes);
            			$fichas_pendentes = $result_pen['pendente'];

                        // CONTANDO FICHAS USADAS
                        $query_pendentes="SELECT count(0) as pendente FROM ficha WHERE data_ficha = '$data' and pendente = 0 and refeicao='$refeicao'";
            			$fichas_usadas = mysqli_query($conexao, $query_pendentes);
            			$result_ficha = mysqli_fetch_assoc($fichas_usadas);
            			$fichas_usadas = $result_ficha['pendente'];
                        
						if(!$fichas_reservadas==0){
                            $TX_disperdicio = ($fichas_pendentes / $fichas_reservadas)*100;
                            $TX_disperdicio = number_format($TX_disperdicio,2);                    
						} else{
							$TX_disperdicio = 0;
						}
                         // escrevendo linhas da tabela - com link para edição do cardápio.
                         echo "<tr class='$cor_hoje'>
                         ";
                         //<input type='checkbox' class='filled-in' id='$id' name='selecionado' value='$id'/>
                         echo "

                         <td>$data_i</td>
                         <td>$fichas_reservadas de $qtd_l</td>
                         <td> $fichas_usadas</td>
                         <td class='alert'> $fichas_pendentes </td>
                         <td> $TX_disperdicio% </td>    ";
                         //echo "<td>$qtd_r</td>
                         echo "
                         <td class='texto-esquerda left'>$descricao</td>
						 <td> $refeicao </td>
                         <td><a href='lista_alunos_adm_fichas.php?data_cardapio=$data&tipo=H&ordem=nome'><img src='img/list.png' alt='Listar alunos que reservaram.'></a></td>
                         <td><a href='#modal_$id'><img src='img/edit.png' alt='Editar'></a></td>
                         <td><a href='#modal_$id'><img src='img/delete.png' alt='Excluir'></a></td>
                         </tr>";

                        echo "<input type='hidden' name='ids_$id' value='$id'>";
                        // criando uma modal para cada linha de cardápio para alteração de dados.
                        echo "
                        <div id='modal_$id' class='modal'>
                            <div class='modal-content'>
                                <h4>Alteração de cardápio</h4>
                                <h5>Data: $data_i - ID: $id</h5>
                                <form action='editar_cardapio.php' method=post>
                                    <input type='hidden' name='id_c' value='$id'>
                                    Descrição <input type='text' value='$descricao' name='descr'><br>
                                    Quantidade Limite <input type='number' min='0' value='$qtd_l' name='qtd_ll'><br>
                            </div>
                            <div class='modal-footer'>
                                <a href='#' class='modal-action modal-close waves-effect waves-red btn-flat'  >Fechar</a>
                                <input type='submit' class='btn green' value='Salvar alterações'>
                                </form>
                                <form action='exclui_cardapio.php' method=post>
                                    <input type='hidden' name='cod_cardapio' value='$id'>
                                    <input type='submit' class='btn red' value='Excluir'>
                                </form>
                            </div>
                        </div>
                        ";
                     } // Final do While - Gerando linhas da tabela.

                     //echo "</form>"; // Fechando GRANDE FORMULÁRIO f1 que contem todos os check-boxes


                 ?>

             </div>
         </div> <!--  Final da Linha  -->

        <div class='row'>
             <div class='col s12'>
                 <!-- <a href='#modal_exclui_cardapio' onclick='pega_checkboxes_marcados();'><button type='button' class='btn'>Excluir selecionados</button></a> -->
             </div>
         </div>


     </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->


  </body>
    <?php
        include('extends.php');
    ?>

     <!-- Modal - Estrutra da Janela Sobre... -->
      <div id='modal_exclui_cardapio' class='modal'>
          <div class='modal-content'>
              <h4>Confirma exclusão do(s) cardápio(s)?</h4>
          </div>
          <div class='modal-footer'>
              <p>Cardápios: </p><p id="codigos">Deveriam aparecer os codigos de cardápios</p>
              <form method='post' action='exclui_cardapios.php'>
                  <input type='hidden' name='ids' value='' id="itens">
                  <input type='submit' class='btn red' value='Excluir Selecionados'>
              </form>
              <a href='#' class='modal-action modal-close waves-effect waves-red btn-flat'  >Fechar</a>
          </div>
      </div>    <!-- Finda da janela Modal - -->

</html>
