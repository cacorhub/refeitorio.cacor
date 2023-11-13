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
                 <?php
                     // Exibir mensagem de erro caso ocorra.
                     if (isset($_GET["erro"]))  {
                         $erro = $_GET["erro"];
                         echo  "<div class='chip yellow'>$erro</div>";
                     }
                 ?>
             </div>
         </div>
         <div class="row">
            <div class="col s12">
                <p>Procure por: trecho do Nome, Matrícula ou CPF</p>
            </div>
            <form action="lista_alunos_adm.php" method="post">
                 <div class='input-field'>
                     <!-- <label for="dado_pesquisado">Procure por: trecho do Nome, Matrícula ou CPF</label> -->
                    <div class="row">
                        <div class="col s4">
                            <input type="text" name="dado_pesquisado" autofocus>
                        </div>
                        <div class="col s4">
                            <select name="filtro2">
                               <option value="">Todos os registros</option>
                               <option value="AND biometria is not null">Apenas com digital cadastrada</option>
                               <option value=" AND biometria is null">Apenas sem digital cadastrada</option>
                               <option value="AND ativo = '1'">Alunos ativos</option>
                               <option value=" AND ativo = '0'">Alunos inativos</option>
                            </select>
                        </div>
                        <div class="col s4">
                            <select name="ordem">
                               <option value=" order by nome asc">Em ordem alfabética</option>
                               <option value=" order by matricula asc">Ordenado por matrícula</option>
                               <option value=" order by cpf asc">ordenado por CPF</option>
                               <option value=" order by biometria desc">ordenado por biometria</option>
                               <option value=" order by arquivo_foto desc">ordenado por Foto</option>
                            </select>
                        </div>
                    </div>
                 </div>
                 <div class='input-field col s4'>
                     <input type="submit" class="btn" value="Buscar">
                 </div>
             </form>

         </div>
         <div class="row">
             <div class="col s12">
                 <?php
                     if (isset($_POST['dado_pesquisado'])) {
                         $pesquisa = $_POST['dado_pesquisado'];
                         $filtro2 = $_POST['filtro2'];
                         $ordem = $_POST['ordem'];
                         $filtro = " where ((nome LIKE '%$pesquisa%') OR (matricula LIKE '%$pesquisa%') OR (cpf LIKE '$pesquisa%' )) $filtro2";
                     }
                     else {
                         $filtro = '';
                         $ordem =" order by nome";
                         echo "<div class='chip  teal lighten-5'>TODOS OS REGISTROS</div>";
                    }
                     $sql = "select * from alunos $filtro $ordem limit 50";
                     $query = $mysqli->query($sql);
                     $row = $query->num_rows;
                     echo "<div class='chip yellow'>$row registros encontrados</div>";
                     // Escrevendo cabeçalhos da tabela
                     echo "
                     <table class='highlight'>
                     <thead><tr>
                         <th>Foto</th>
                         <th>Matrícula</th>
                         <th>Nome</th>
                         <th>CPF</th>
                         <th>Biometria</th>
                         <th>Ações</th>
                     </tr> </thead>
                     <tbody>";

                     while ( $linha = $query -> fetch_array()) {
                         $ativo = $linha['ativo'];
                         $id = $linha['id'];
                         if ($ativo) {
                            $nome = $linha['nome'];
                         } else {
                            $nome = "I N A T I V O : " .$linha['nome'];
                         }

                         $cpf =  $linha['cpf'];
                         $matricula =  $linha['matricula'];
                         $foto=  "fotos/" .$linha['arquivo_foto'];


                         if ($linha['biometria'] == null) {
                                $sit_bio = 'img/biometria_no.png';
                                $cor = 'lighten-5 red';
                        } elseif ($cpf == '') {
                                $cor = 'lighten-5 yellow';
                                $sit_bio = 'img/biometria_ok.png';
                        } else {
                                $sit_bio = 'img/biometria_ok.png';
                                $cor = '';
                        };


                         // escrevendo linhas da tabela
                         echo "<tr class='$cor'>
                         <td><img class='circle pequeno materialboxed' src='$foto'></td>
                         <td>$matricula</td>
                         <td><a href='editar_cadastro_aluno_adm.php?id_aluno=$id'>$nome</a></td>
                         <td>$cpf</td>
                         <td class='center'><img src='$sit_bio'></td>
                         <td>
                            <a href='lista_refeicoes_por_aluno.php?id_aluno=$id&nome=$nome&matricula=$matricula&foto=$foto&tipo=H'>Histórico<br></a>
                            <a href='lista_refeicoes_por_aluno.php?id_aluno=$id&nome=$nome&matricula=$matricula&foto=$foto&tipo=P'>Desbloqueio<br></a>
                            <a href='#modal_reseta_senha_$id'>Resetar Senha</td></a>
                         </tr>";

                        // Criando uma modal par resetar a senha do aluno.
                        echo "<div id='modal_reseta_senha_$id' class='modal'>
                             <div class='modal-content'>
                                 <h4>Resetar senha</h4><hr>
                                 <h5>Confirma RESET de senha do aluno?</h5>
                                 <h6>Nome: $nome</h6>
                                 <h5>Matrícula:<span class='alert'> $matricula<span></h5>
                                 <p class='alert'>Obs: A senha voltará a ser o código de matrícula até que o aluno altere novamente.</p>
                             </div>
                             <div class='modal-footer'>
                                <form action='reset_senha_aluno.php' method='post'>
                                    <input type='hidden' name='id_aluno' value='$id'>
                                 <input type='submit' class='btn' value='Sim'>
                                </form>
                                 <a href='' class='modal-action modal-close waves-effect waves-red btn-flat'  >Fechar</a>
                             </div>
                         </div> <!-- Finda da janela Modal - -->";

                     }
                    echo "</tbody></table>";


                 ?>

             </div>
         </div> <!--  Final da Linha  -->
     </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->
  </body>


    <?php
        include("extends.php");
    ?>



</html>
