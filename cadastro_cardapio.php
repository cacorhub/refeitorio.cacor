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

              <h3>Cadastro de Cardápio</h3>
              <?php
                //  function verifica_cardapio_hoje($data) {
                if (!empty($_POST['qtd'])) {
                    $descricao = $_POST['descricao'];
                    $data = $_POST['data_refeicao'];
                    $qtd = $_POST['qtd'];
					$refeicao = $_POST['refeicao'];
                    $C_hoje = verifica_cardapio_mesmo_dia($conexao, $data, $refeicao);
                    //echo "<h1>$C_hoje</h1>";
                    if ($C_hoje) {
                        echo "<div class='chip  red lighten-3'>Já existe cardápio cadastrado para esta data!</div>";
                    } else {
                        $sql = "insert into cardapio (Data, qtd_limite,reservadas, Descricao, refeicao) VALUES ('$data' , '$qtd',0, '$descricao','$refeicao')";
                        mysqli_query($conexao, $sql);
                        $data_i = inverte_data($data);
                        echo "<div class='chip yellow'>Será servido: $qtd refeições($refeicao) de $descricao em $data_i</div>";
                        echo "<div class='chip yellow'>Cardápio cadastrado com sucesso!</div>";
			//echo  $sql;
                    }
                } else {
                    //echo "<div class='chip  red lighten-3'>Erro! Não dacastrado!</div>";
                }

              ?>
            </div>
           </div>
            <div class="row">
              <form action='cadastro_cardapio.php' method='post'>
                  <div class='input-field col s4'>
					<select name="refeicao">
						<option value="A">Almoço</option>
						<option value="J">Janta</option>
					</select>
				</div>
				  <div class='input-field col s12'>
                      <input class='validate' type='text' name='descricao' required>
                      <label for='descricao'>Descrição do Cardápio</label>
                  </div>
                  <div class='input-field col s4'>
                      <input class='validate' type='number' value='250' name='qtd' min=0 max=1000>
                      <label  for='cpf'>Quantidade de refeições</label>
                  </div>
                  <div class='input-field col s4'>
                      Data da refeição
                      <input class='' type='date' name='data_refeicao' required>
                  </div>
                <div class='col s12'>
                      <a href="#modal_cadastro_cardapio"><button type='button' class='btn'>Cadastrar Cardápio</button></a>
                </div>

                <!-- Modal - Estrutra da Janela Sobre... -->
                <div id="modal_cadastro_cardapio" class="modal">
                    <div class="modal-content">
                        <h4>Confirma cadastramento do cardápio?</h4>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn" value="Sim">
                        <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                    </div>
                </div> <!-- Finda da janela Modal - -->
              </form>



            <script src="js/base.js"></script>
            </div>

      </div>


    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->



  </body>

    <?php
        include("extends.php");
    ?>

</html>
