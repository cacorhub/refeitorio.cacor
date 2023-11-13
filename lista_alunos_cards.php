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
                 <h3>Relação de Alunos</h3>
             </div>
         </div>
         <div class="row">
            <div class="col12">
             <form action="lista_alunos_cards.php" method="post">
                 <div class='input-field col s4'>
                     <input type="text" name="nome_pesquisado" autofocus>
                 </div>
                 <div class='input-field col s4'>
                     <input type="submit" class="btn" value="Buscar">
                 </div>
             </form>
            </div>
         </div>
         <div class="row">
             <div class="col s12">
                 <?php
                     if ( !empty($_POST['nome_pesquisado']) ) {
                         $nome_pesquisado = $_POST['nome_pesquisado'];
                         $quando = " where nome LIKE '%$nome_pesquisado%'";
                         $ordem =" order by nome";
                     }
                     else {
                         $quando = '';
                         $ordem =" order by nome desc";
                         echo "<div class='chip  teal lighten-5'>TODOS OS REGISTROS</div>";
                    }
                     $sql = "select * from alunos $quando $ordem";
                     $query = $mysqli->query($sql);
                     $row = $query->num_rows;
                     echo "<div class='chip yellow'>$row registros encontrados</div>";
                     // Escrevendo cabeçalhos da tabela
                    ?>
            </div>


        </div>
        <div class='row'>
            <?php

                     while ( $linha = $query -> fetch_array()) {
                         $id = $linha['id'];
                         $matricula =  $linha['matricula'];
                         $nome = $linha['nome'];
                         $telefone =  $linha['telefone'];
                         $email =  $linha['email'];
                         $cpf =  $linha['cpf'];
                         $rg =  $linha['rg'];
                         $sexo =  $linha['sexo'];
                         $data_nascimento =  date('d/m/Y',strtotime($linha['data_nascimento']));
                         $login =  $linha['login'];
                         $senha =  $linha['senha'];
                         $foto=  "fotos/" .$linha['arquivo_foto'];

                        // Gerando CARDs dos Alunos
                        echo "
                        <div class='col s3'>
                            <div class='card'>
                                <div class='card-image'>
                                  <img class='materialboxed' src='$foto'>
                                </div>
                                <div class='card-content'>
                                  <span >$nome</span>
                                </div>
                                <div class='card-action'>
                                    <a href='#modal_$id'>Ver ficha</a>
                                </div>
                            </div>
                        </div>
                                ";

                       // criando uma modal para cada aluno
                       echo "
                       <div id='modal_$id' class='modal'>
                           <div class='modal-content'>
                              <img class='foto_grande materialboxed' src='$foto'><h5>ID: $id</h5>
                              <h5>Matrícula: <span class='alert'>$matricula</span></h5>
                              <h5>Nome: $nome</h5>
                              <p>Telefone: $telefone - Email: $email </p>
                              <p>Sexo: $sexo - CPF: $cpf - RG: $rg</p>
                              <p>Data de Nascimento: $data_nascimento</p>
                              <p>Login: $login Senha: ****** </p>
                            <hr>
                           </div>
                           <div class='modal-footer'>
                               <a href='#' class='modal-action modal-close waves-effect waves-red btn-flat'  >Fechar</a>
                           </div>
                       </div>
                       ";
                     }
                 ?>
                </div>
             </div>
         </div> <!--  Final da Linha  -->
     </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->


  </body>
    <?php
        include("extends.php");
    ?>



</html>
