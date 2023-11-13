<?php
    include("headers.php");
 ?>
 <body>
    <?php
        $Ghora = date("H:i");
		include("menus.php");
        include("conexao.php");
     ?>

     <!-- Conteudo da página principal... -->
      <div class='container'>
          <div class='row'>
            <div class='col s12'>
              <h4>Reservar Refeição</h4>
			  
<!--			  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	window.onload = function() {
		swal({
			title: "Aviso!",
			text: "CARAS ALUNAS, prendam o cabelo no momento em que estiverem sendo servidas no refeitório, pois prezamos pela manutenção da higiene e assim evitaremos possíveis futuros mal entendidos caso haja incidentes relativos a presença de fios de cabelo nos pratos/refeição de vocês e dos colegas.",
			icon: "info",
			});
	};	
</script>
-->
	
              <?php

              // Exibir mensagem de erro caso ocorra.
              if (isset($_GET["erro"]))  {
                  $erro = $_GET["erro"];
                  echo  "<div class='super_alerta centralizado'>$erro</div>";
              }

                $hoje = date('Y/m/d'); // Para comparação do dia atual no sistema.
	
                //chamando a funcao que verificarReserva a tabela ficha e mostrando se o aluno já faz a reserva do almoço
				echo $turno;
                if($Ghora >= "06:00" && $Ghora < "09:00" && ($turno=="Manha" || $turno=="Integral")){
					//verificarQuantidadeFichas($conexao, $hoje, 'A');
					$mostrarCardapio = mostrarCardapio($conexao, $hoje, 'A');
					if (verificarReserva($conexao, $id, $hoje, 'A')) {
						echo "<p class='centralizado blue lighten-4'>Seu almoço de hoje está reservado</p>";
					} else {
						echo "<p class='centralizado alert yellow lighten-3'>Você não reservou almoço para hoje</p>";
					}
				}else if($Ghora >= "09:00" && $Ghora < "10:00" && ($turno=="Manha" || $turno=="Integral" || $turno=="Tarde" || $turno=="Noite")){
					//verificarQuantidadeFichas($conexao, $hoje, 'A');
					$mostrarCardapio = mostrarCardapio($conexao, $hoje, 'A');
					if (verificarReserva($conexao, $id, $hoje, 'A')) {
						echo "<p class='centralizado blue lighten-4'>Seu almoço de hoje está reservado</p>";
					} else {
						echo "<p class='centralizado alert yellow lighten-3'>Você não reservou almoço para hoje</p>";
					}
				}else if($Ghora >= "12:00" && $Ghora < "15:00" && ($turno=="Tarde" || $turno=="Noite")){
					//verificarQuantidadeFichas($conexao, $hoje, 'J');
					$mostrarCardapio = mostrarCardapio($conexao, $hoje, 'J');
					if (verificarReserva($conexao, $id, $hoje, 'J')) {
						echo "<p class='centralizado blue lighten-4'>Seu jantar de hoje está reservado</p>";
					} else {
						echo "<p class='centralizado alert yellow lighten-3'>Você não reservou janta para hoje</p>";
					}
				}else if($Ghora >= "15:00" && $Ghora < "16:00"){
					//verificarQuantidadeFichas($conexao, $hoje, 'J');
					$mostrarCardapio = mostrarCardapio($conexao, $hoje, 'J');
					if (verificarReserva($conexao, $id, $hoje, 'J')) {
						echo "<p class='centralizado blue lighten-4'>Seu jantar de hoje está reservado</p>";
					} else {
						echo "<p class='centralizado alert yellow lighten-3'>Você não reservou janta para hoje</p>";
					}
				}
                //    echo "<br>";
                //    echo "Id do aluno: " . $id . "<br>";
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
              $gmhora = date("H:i");

              //Habilita botões para reserva de ficha de 7hs até as 10hs.
              //As reservas so podem ser feita no próprio dia.
              //recebendo a funcao verificarQtdPendencias que verifica
              // a quantidade de pendencias do aluno
              $qtdpendencias = verificarQtdPendencias($conexao, $id);
              $biometria = verificarBiometria($conexao, $id);
              //echo $mostrarCardapio;
              if ($biometria){
                  if($qtdpendencias){
                    if($gmhora < "09:00" && $gmhora >= "06:00" && ($turno=="Manha" || $turno=="Integral")) {
                          $habilitarBotaoSolicitar = habilitarBotaoSolicitar($conexao, $id, $hoje, 'A');
                          if ($habilitarBotaoSolicitar) {
                            echo '<form action="solicita.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" value='. $id .' name="id_aluno" >
                                      <input type="hidden" value='. $hoje .' name="data_hora" >
									  <input type="hidden" value='. 'A' .' name="refeicao" >
                                      <a href="#modal_confirma_solicitacao"><button type="button" class="btn centro">Solicitar Refeição</button></a>
                                      <!-- Modal - Estrutra da Janela Sobre... -->
                                      <div id="modal_confirma_solicitacao" class="modal">
                                          <div class="modal-content">
                                              <h4>Confirmação</h4>
                                              <h5>Confirma solicitação de almoço para hoje?</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <input class="btn " type="submit" id="enviar informações" value="Solicitar Almoço">
                                              <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                          </div>
                                      </div> <!-- Finda da janela Modal - -->
                                  </form>';

                          }//Fim da habilitarBotaoSolicitar
								
                          $habilitarBotaoCancelar = habilitarBotaoCancelar($conexao, $id, $hoje, 'A');
                          if ($habilitarBotaoCancelar) {
                            echo '<form action="cancelarficha.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" value='. $id .' name="id_aluno" >
                              <input type="hidden" value='. $hoje .' name="data_hora" >
							  <input type="hidden" value='. 'A' .' name="refeicao" >

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
                          }//fim da habilitarBotaoCancelar Almoco //Fim da habilita botões Almoco
                        }else if($gmhora < "10:00" && $gmhora >= "09:00") {
                          $habilitarBotaoSolicitar = habilitarBotaoSolicitar($conexao, $id, $hoje, 'A');
                          if ($habilitarBotaoSolicitar) {
                            echo '<form action="solicita.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" value='. $id .' name="id_aluno" >
                                      <input type="hidden" value='. $hoje .' name="data_hora" >
									  <input type="hidden" value='. 'A' .' name="refeicao" >
                                      <a href="#modal_confirma_solicitacao"><button type="button" class="btn centro">Solicitar Refeição</button></a>
                                      <!-- Modal - Estrutra da Janela Sobre... -->
                                      <div id="modal_confirma_solicitacao" class="modal">
                                          <div class="modal-content">
                                              <h4>Confirmação</h4>
                                              <h5>Confirma solicitação de almoço para hoje?</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <input class="btn " type="submit" id="enviar informações" value="Solicitar Almoço">
                                              <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                          </div>
                                      </div> <!-- Finda da janela Modal - -->
                                  </form>';

                          }//Fim da habilitarBotaoSolicitar
								
                          $habilitarBotaoCancelar = habilitarBotaoCancelar($conexao, $id, $hoje, 'A');
                          if ($habilitarBotaoCancelar) {
                            echo '<form action="cancelarficha.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" value='. $id .' name="id_aluno" >
                              <input type="hidden" value='. $hoje .' name="data_hora" >
							  <input type="hidden" value='. 'A' .' name="refeicao" >

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
                          }//fim da habilitarBotaoCancelar Almoco //Fim da habilita botões Almoco
                        } else if($gmhora < "15:00" && $gmhora >= "12:00" && ($turno=="Tarde" || $turno=="Noite")) {
                          $habilitarBotaoSolicitar = habilitarBotaoSolicitar($conexao, $id, $hoje, 'J');
                          if ($habilitarBotaoSolicitar) {
                            echo '<form action="solicita.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" value='. $id .' name="id_aluno" >
                                      <input type="hidden" value='. $hoje .' name="data_hora" >
									  <input type="hidden" value='. 'J' .' name="refeicao" >
                                      <a href="#modal_confirma_solicitacao"><button type="button" class="btn centro">Solicitar Refeição</button></a>
                                      <!-- Modal - Estrutra da Janela Sobre... -->
                                      <div id="modal_confirma_solicitacao" class="modal">
                                          <div class="modal-content">
                                              <h4>Confirmação</h4>
                                              <h5>Confirma solicitação da janta para hoje?</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <input class="btn " type="submit" id="enviar informações" value="Solicitar janta">
                                              <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                          </div>
                                      </div> <!-- Finda da janela Modal - -->
                                  </form>';

                          }//Fim da habilitarBotaoSolicitar
								
                          $habilitarBotaoCancelar = habilitarBotaoCancelar($conexao, $id, $hoje, 'J');
                          if ($habilitarBotaoCancelar) {
                            echo '<form action="cancelarficha.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" value='. $id .' name="id_aluno" >
                              <input type="hidden" value='. $hoje .' name="data_hora" >
							  <input type="hidden" value='. 'J' .' name="refeicao" >

                              <a href="#modal_confirma_cancelamento"><button type="button" class="btn red centro">Cancelar Refeição</button></a>
                              <!-- Modal - Estrutra da Janela Sobre... -->
                              <div id="modal_confirma_cancelamento" class="modal">
                                  <div class="modal-content">
                                      <h4>Cancelar almoço</h4>
                                      <h5>Confirma cancelamento da reserva da janta de hoje?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <input class="btn red" type="submit" id="enviar informações" value="Cancelar refeição">
                                      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                  </div>
                              </div> <!-- Finda da janela Modal - -->

                            </form>';
                            echo '<br>';
                          }//fim da habilitarBotaoCancelar janta //Fim da habilita botões janta
                        } else if($gmhora < "16:00" && $gmhora >= "15:00") {
                          $habilitarBotaoSolicitar = habilitarBotaoSolicitar($conexao, $id, $hoje, 'J');
                          if ($habilitarBotaoSolicitar) {
                            echo '<form action="solicita.php" method="post" enctype="multipart/form-data">
                                      <input type="hidden" value='. $id .' name="id_aluno" >
                                      <input type="hidden" value='. $hoje .' name="data_hora" >
									  <input type="hidden" value='. 'J' .' name="refeicao" >
                                      <a href="#modal_confirma_solicitacao"><button type="button" class="btn centro">Solicitar Refeição</button></a>
                                      <!-- Modal - Estrutra da Janela Sobre... -->
                                      <div id="modal_confirma_solicitacao" class="modal">
                                          <div class="modal-content">
                                              <h4>Confirmação</h4>
                                              <h5>Confirma solicitação da janta para hoje?</h5>
                                          </div>
                                          <div class="modal-footer">
                                              <input class="btn " type="submit" id="enviar informações" value="Solicitar janta">
                                              <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                          </div>
                                      </div> <!-- Finda da janela Modal - -->
                                  </form>';

                          }//Fim da habilitarBotaoSolicitar
								
                          $habilitarBotaoCancelar = habilitarBotaoCancelar($conexao, $id, $hoje, 'J');
                          if ($habilitarBotaoCancelar) {
                            echo '<form action="cancelarficha.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" value='. $id .' name="id_aluno" >
                              <input type="hidden" value='. $hoje .' name="data_hora" >
							  <input type="hidden" value='. 'J' .' name="refeicao" >

                              <a href="#modal_confirma_cancelamento"><button type="button" class="btn red centro">Cancelar Refeição</button></a>
                              <!-- Modal - Estrutra da Janela Sobre... -->
                              <div id="modal_confirma_cancelamento" class="modal">
                                  <div class="modal-content">
                                      <h4>Cancelar almoço</h4>
                                      <h5>Confirma cancelamento da reserva da janta de hoje?</h5>
                                  </div>
                                  <div class="modal-footer">
                                      <input class="btn red" type="submit" id="enviar informações" value="Cancelar refeição">
                                      <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                                  </div>
                              </div> <!-- Finda da janela Modal - -->

                            </form>';
                            echo '<br>';
                          }//fim da habilitarBotaoCancelar janta //Fim da habilita botões janta
                        }else { // Mostrar mensagem de que está em um horário inválido.
                          echo  "<div class='centralizado yellow'>Atenção! Fora do horário de reserva/cancelamento.</div>";
						  echo  "<div class='centralizado teal lighten-5'><div class='texto-esquerda'>";
						  echo  "<b>HORÁRIOS DE SOLICITAÇÃO:</b><br>";
						  echo  "ALMOÇO: 06:00h às 09:00h - Apenas alunos do turno da Manhã;<br>";
						  echo  "ALMOÇO: 09:00h às 10:00h - Todos os alunos de qualquer turno;<br>";
						  echo  "JANTA : 12:00h às 15:00h - Apenas Alunos do turno Tarde ou Noite;<br>";
						  echo  "JANTA : 15:00h às 16:00h - Todos os alunos de qualquer turno.";
						  echo  "</div></div>";
						  
                      }
                    } //fim verifica pendencia true
                    else { //para condicao false
                      echo "
                      <h6 class='centralizado red lighten-3'>Você já tem 3 pendencias no refeitório</h6>
                      <p class='centralizado red lighten-3'>Entre em contato com o setor de logística do campus para liberação</p>";
                    }
                }else { //fim biometria
                    echo "<p class='centralizado red lighten-3'>
                    Você deve fazer o cadastro BIOMÉTRICO ou CPF.
                    </p>";
                }
              ?>
            </div>
			
			
	
      </div> <!-- Final do container -->
    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->
  </body>
    <?php
        include("extends.php");
    ?>
</html>
