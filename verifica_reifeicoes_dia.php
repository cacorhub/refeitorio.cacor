<?php
    include("headers.php");
 ?>
 <body>
    <?php
        include("menus_adm.php");
        include("conexao.php");
        $tempo_reload = 10000; // 10 segundos.
     ?>

     <!-- Conteudo da página principal... -->
      <div class='container'>
          <div class='row'>
            <div class='col s12'>
              <h3>Refeições Solicitadas (Almoço)</h3>
              <h4>
              <div class="card-panel  green accent-1">
              <?php
                //include("conexao.php");
                // Trazendo dados preenchidos no formulário para alteração.
                $hoje = date('Y/m/d');
               //chamando a funcao que verificarReserva a tabela ficha

                $hora_atual = date("H:i");
                if (($hora_atual >= "06:00") and ($hora_atual < "10:00")) {
                    $estado = 'Aberto';
                    $cor = "light-green accent-1";
                } else {
                    $estado = 'Fechado';
                    $cor = "red accent-2";
                }
                echo  "<div class='chip $cor'>$estado</div><br>";

                $mostrarCardapio = mostrarCardapio($conexao, $hoje, "A");
                echo $mostrarCardapio;
                echo "<a class='btn' href='lista_alunos_adm_fichas.php?data_cardapio=$hoje&tipo=D&ordem=nome&refeicao=A'>Ver lista de alunos que reservaram</a>";

                verificarReserva($conexao, $id, $hoje, "A");
                verificarQuantidadeFichas($conexao, $hoje, "A");


              ?>

              <?php
                  $hora = date("H");
                  //echo $hora;
                  $data_hora =  date('d/m/Y H:i:s');
                  echo "<h3 class='center'>Data de hoje: " . $data_hora . "</h3>";
                  $h = "5"; //HORAS DO FUSO ((BRASÍLIA = -5) COLOCA-SE SEM O SINAL -).
                  $hm = $h * 60;
                  $ms = $hm * 60;

                  //COLOCA-SE O SINAL DO FUSO ((BRASÍLIA = -5) SINAL -) ANTES DO ($ms). HORA
                  $gmhora = date("H");

                  //Habilita botões para reserva de ficha de 7hs até as 10hs.
                  //As reservas so podem ser feita no próprio dia.

              ?>
                </div>
                </h4>
            </div>

      </div> <!-- Final do container -->
    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->

    <script language="JavaScript">
        // AUTO RELOAD DA PÁGINA WEB
        setTimeout('delayReload()',<?php echo($tempo_reload);?>);
        function delayReload()
        {
            if(navigator.userAgent.indexOf("MSIE") != -1){
                history.go(0);
            }else{
                window.location.reload();}
            }
    </script>

  </body>
    <?php
        include("extends.php");
    ?>
</html>
