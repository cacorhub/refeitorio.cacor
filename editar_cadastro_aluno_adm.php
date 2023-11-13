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
                <?php
                    // Exibir mensagem de erro caso ocorra.
                    if (isset($_GET["erro"]))  {
                        $erro = $_GET["erro"];
                        echo  "<div class='chip yellow'>$erro<i class='close material-icons'>close</i></div>";
                    }
                ?>
              <h3>Cadastro de Aluno</h3>
            </div>
           </div>
            <div class="row">



              <?php  // Trazendo dados preenchidos no formulário para alteração.
              $id_aluno = $_GET["id_aluno"];
              $sql = "select * from `alunos` where `id` = '$id_aluno'";
              $query = $mysqli->query($sql);
              while ( $linha = $query->fetch_array()) {
                  $id_aluno = $linha['id'];
                  $ativo = $linha['ativo'];
                  $nome = $linha['nome'];
                  $sexo = $linha['sexo'];
                  $data_nascimento =  $linha['data_nascimento'];
                  $cpf=  $linha['cpf'];
                  $rg=  $linha['rg'];
                  $telefone=  $linha['telefone'];
                  $email=  $linha['email'];
                  $senha=  $linha['senha'];
                  $foto = $linha['arquivo_foto'];
                  $foto_anterior = $linha['arquivo_foto'];
              }
                    if ($ativo) {
                        $AT = 'selected'; $DT = '';
                    } else {
                        $DT = 'selected'; $AT = '';
                    }

                    if ($sexo == 'M') {
                        $M = 'selected'; $F = ''; $N ='';
                    }
                    elseif ($sexo == 'F') {
                        $F = 'selected'; $M = ''; $N ='';
                    }
                    else {
                        $N = 'selected'; $M = ''; $F ='';
                    }
              ?>

                <?php  // GERANDO FORMULÁRIO PELO PHP - PREENCHENDO OS CAMPOS...
                echo "

              <form action='atualiza_aluno.php' method='post' enctype='multipart/form-data'>
              <div class='input-field col s12'>
                  <select name='ativo' id='ativo'>
                        <option value='true' $AT>ATIVO</option>
                        <option value='false' $DT>DESATIVADO</option>
                  </select>
                  <label> Situação do aluno na instituição</label>
              </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' id='nome' value='$nome' name='nome'>
                      <label for='nome'>Nome completo</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' id='email' value='$email' name='email'>
                      <label for='email'>E-mail</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' id='telefone' value='$telefone' name='telefone'>
                      <label for='telefone'>Telefone</label>
                  </div>

                  <div class='input-field col s12'>
                      <select name='sexo' id='sexo'>
                            <option value='M' $M>Masculino</option>
                            <option value='F' $F>Feminino</option>
                            <option value=' ' $N>Não informado</option>
                      </select>
                      <label> Sexo</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' value='$rg' name='rg' id='rg'>
                      <label  for='rg'>Número do RG (Números + SPP + UF)</label>
                  </div>
                  <div class='input-field col s12'>
                      <input class='validate' type='text' pattern='\d{3}\\d{3}\\d{3}\d{2}' id='cpf' value='$cpf' name='cpf'>
                      <label  for='cpf'>CPF (somente números - 11 dígitos)</label>
                  </div>
                      <label  for='data_nascimento'>Data de Nascimento</label>
                  <div class='input-field col s12'>
                      <input class='' type='date' id='data_n' value='$data_nascimento' name='data_nascimento'>
                  </div>
                  <div class='file-field input-field col s12'>
                      <p class='centralizado teal lighten-5'>Edite em formato quadrado antes de postar. Use uma foto fechada no rosto, tipo foto 3X4.</p>
                      <div class='btn'>
                          <input class='file-path validate' type='file' id='take-picture' accept='image/*' name='foto'>
                          <span>Arquivo de imagem</span>
                      </div>
                      <img src='fotos/$foto' alt='' id='show-picture' class='preview'>
                      <img src='' alt='' id='show-picture' class='preview'>
                  </div>
                <input value='$foto_anterior' name='foto_anterior' type='hidden'>
                <input value='$id_aluno' name='id_aluno' type='hidden'>

";
                ?>
                <div class='col s12'>
                      <a href="#modal_confirma"><button type='button' class='btn'>Atualizar dados</button></a>
                </div>

                <!-- Modal - Estrutra da Janela Sobre... -->
                <div id="modal_confirma" class="modal">
                    <div class="modal-content">
                        <h4>Confirma atualização dos dados?</h4>
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
