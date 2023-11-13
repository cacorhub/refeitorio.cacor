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
              <h3>Alteração de Senha</h3>
              <?php  // Trazendo dados preenchidos no formulário para alteração.
              $sql = "select senha from `alunos` where `id` = '$id'";
              $query = $mysqli->query($sql);
              while ( $linha = $query->fetch_array()) {
                  $senha =  $linha['senha'];
              };
              //echo "<h1>$id</h1>";
              ?>

              <?php // ATUALIZANDO A SENHA NO BANCO DE DADOS APOS CLICAR ALTERAR.
                  if (isset($_POST['senha2'])) {
                      $senha1 = $_POST['senha1'];
                      $senha2 = $_POST['senha2'];
                      if ($senha1 == $senha2) {
                          $sql_update = "UPDATE alunos SET senha = '$senha2' where id = $id";
                          $query = $mysqli->query($sql_update);
                          $erro = "<div class='chip yellow'>$erro</div>";
                          header('Location: index.php?erro=Sua senha foi alterada com sucesso');
                      } else {
                          echo "Senha NÃO alterada!";
                      }
                  } else {
                      //echo "Senha NÃO alterada!";
                  }
              ?>

                <?php  // GERANDO FORMULÁRIO PELO PHP - PREENCHENDO OS CAMPOS...
                echo "
              <form action='altera_senha_aluno.php' method='post'>
                  <div class='input-field col s12'>
                      <input class='validate' type='password' id='senha1' value='$senha' name='senha1' required>
                      <label for='senha1'>Senha</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='password' id='senha2' value='$senha' name='senha2' required onblur='verifica_senhas();'>
                      <label for='senha2'>Confirmação de Senha</label>
                  </div>
                  <p class='centralizado' id='mensagem'><p>
                ";
                ?>
                <div class='col s12'>
                      <a href="#modal_altera_senha" id="link_alt_senha"><button type='button' class='btn' onclick='verifica_senhas();'>Alteração de Senha</button></a>
                </div>

                <!-- Modal - Estrutra da Janela Sobre... -->
                <div id="modal_altera_senha" class="modal">
                    <div class="modal-content">
                        <h4>Alteração de senha</h4>
                        <h5>Confirma alteração da sua senha de acesso?</h5>
                        <p class="alert">Recomendamos que anote em local seguro.</p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn" value="Sim">
                        <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Fechar</a>
                    </div>

                </div> <!-- Finda da janela Modal - -->

              </form>


            </div>

      </div>


    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->
  </body>

    <script type="text/javascript"> // JAVA SCRIPT PARA CONFIRMAR SE AS SENHAS DIGITADAS SÃO IGUAIS
      function verifica_senhas() {
        var S1 = document.getElementById('senha1').value;
        var S2 = document.getElementById('senha2').value;
        if (S1 == S2) {
             document.getElementById("link_alt_senha").href="#modal_altera_senha";
        }
        else {
          document.getElementById("link_alt_senha").href="#";
          alert("Confirmação de senha não confere.");
          document.getElementById('senha1').setfocus;
          //document.getElementById('mensagem').innerHTML = "<div class='chip yellow'>Senhas não são iguais - X</div>";
          // Não excuta nada - Não abre tela modal.
        }

      }
    </script>
    <?php include("extends.php"); ?>

</html>
