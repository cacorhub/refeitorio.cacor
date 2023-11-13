<?php
    include("headers.php");
 ?>
 <body>
    <?php
        include("menus.php");
        include("conexao.php");
     ?>

     <!-- Conteudo da página principal... -->
      <div class='container'>
          <div class='row'>
            <div class='col s12'>
              <h4>Reservar Refeição</h4>

              <?php

              // Exibir mensagem de erro caso ocorra.
              if (isset($_GET["erro"]))  {
                  $erro = $_GET["erro"];
                  echo  "<div class='super_alerta centralizado'>$erro</div>";
              }


                $hoje = date('Y/m/d'); // Para comparação do dia atual no sistema.

                //chamando a funcao que verificarReserva a tabela ficha e mostrando se o aluno já faz a reserva do almoço
                if (!verificarReserva($conexao, $id, $hoje)) {
                  
                            echo '<form action="cancelarficha.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" value='. $id .' name="id_aluno" >
                              <input type="hidden" value='. $hoje .' name="data_hora" >

                              <a href="#modal_confirma_cancelamento"><button type="button" class="btn red centro">Cancelar Refeição</button></a>
                              <!-- Modal - Estrutra da Janela Sobre... -->
                              <div id="modal_confirma_cancelamento" class="modal">
                                  <div class="modal-content">
                                      <h4>Cancelar almoço</h4>
                                      <h5>Confirma cancelamento da reserva de almoço de hoje?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <input class="btn red" type="submit" id="enviar informações" value="Cancelar refeição">
                                      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                  </div>
                              </div> <!-- Finda da janela Modal - -->

                            </form>';
                            echo '<br>';
                          //fim da habilitarBotaoCancelar
                } else {
                    echo "<p class='centralizado alert yellow lighten-3'>Você não reservou almoço para hoje</p>";

                }
                //    echo "<br>";
                //    echo "Id do aluno: " . $id . "<br>";
                verificarQuantidadeFichas($conexao, $hoje);
              ?>

              <?php
              $hora = date("H");
              //echo $hora;
              $data_hora =  date('d/m/Y H:i:s');
              echo "<p class='center'>Data de hoje: " . $data_hora . "</p>";
              $h = "5"; //HORAS DO FUSO ((BRASÍLIA = -5) COLOCA-SE SEM O SINAL -).
              $hm = $h * 60;
              $ms = $hm * 60;

              //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -5) SINAL -) ANTES DO ($ms). HORA
              $gmhora = date("H");

              //Habilita botões para reserva de ficha de 7hs até as 10hs.
              //As reservas so podem ser feita no próprio dia.
              //recebendo a funcao verificarQtdPendencias que verifica
              // a quantidade de pendencias do aluno
              $qtdpendencias = verificarQtdPendencias($conexao, $id);
             

              
              ?>
            </div>

      </div> <!-- Final do container -->
    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->
  </body>
    <?php
        include("extends.php");
    ?>
</html>
