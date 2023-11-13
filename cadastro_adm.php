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
              <h3>Alteração de Senha</h3>
              <?php
                  // Exibir mensagem de erro caso ocorra.
                  if (isset($_GET["erro"]))  {
                      $erro = $_GET["erro"];
                      echo  "<div class='chip yellow'>$erro</div>";
                  }
              ?>

              <?php  // Trazendo dados preenchidos no formulário para alteração.

              $sql = "select * from `administradores` where `id_admin` = '$id'";
              $query = $mysqli->query($sql);
              while ( $linha = $query->fetch_array()) {
                  $id = $linha['id_admin'];
                  $nome = $linha['nome'];
                  $login=  $linha['login'];
                  $senha=  $linha['senha'];
              }
              ?>

                <?php  // GERANDO FORMULÁRIO PELO PHP - PREENCHENDO OS CAMPOS...
                echo "

              <form action='atualiza_adm.php' method='post' enctype='multipart/form-data'>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' id='nome' value='$nome' name='nome'>
                      <label for='nome'>Nome completo</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' id='login' value='$login' name='login'>
                      <label for='nome'>Login</label>
                  </div>

                  <div class='input-field col s12'>
                      <input class='validate' type='password' id='senha1' value='$senha' name='senha1'>
                      <label for='senha1'>Senha</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='password' id='senha1' value='$senha' name='senha2'>
                      <label for='senha2'>Confirmação de Senha</label>
                  </div>

";
                ?>
                <div class='col s12'>
                      <a href="#altera_senha_adm"><button type='button' class='btn'>Alteração de Senha</button></a>
                </div>

                <!-- Modal - Estrutra da Janela Sobre... -->
                <div id="altera_senha_adm" class="modal">
                    <div class="modal-content">
                        <h4>Confirma atualização dos dados?</h4>
                        <p>Alteração de Nome de usuário ou senha</p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn" value="Sim">
                        <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
                    </div>
                </div> <!-- Finda da janela Modal - -->

              </form>


            </div>

      </div>


    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->
  </body>
    <?php include("extends.php"); ?>

</html>
