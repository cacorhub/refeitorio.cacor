<?php
    include("headers.php");
 ?>
 <body>
    <?php
        include("menus_adm.php");
     ?>

      <!-- Conteudo da página principal... -->
      <main class="container">
          <div class="row">
            <div class="span s12">
                <h1 class="center">Opções</h1>
                <h4 class="center">Sistema Refeitório - Perfil do Adminstrador</h4>
            </div>
            <div class="row">
                <div class="span12">
                    <ul class="collapsible" data-collapsible="accordion">
                       <li>
                         <div class="collapsible-header yellow lighten-4 grande">Alunos</div>
                             <div class="collapsible-body"><span>
                                <ul>
                                    <a class="medio" href="cadastro_alunos.php"><li>Cadastrar Alunos</li></a>
                                    <a class="medio" href="#"><li>Inativar cadastro</li></a>
                                    <a class="medio" href="lista_alunos_com_pendencia.php"><li>Lista de alunos com pendência</li></a>
                                    <a class="medio" href="cont_alunos_biometria.php"><li>Quantidade de alunos sem cadastro biometrico</li></a>
                                </ul>
                             </span></div>
                       </li>
                       <li>
                         <div class="collapsible-header yellow lighten-4 grande">Refeitório</div>
                         <div class="collapsible-body"><span>
                             <ul>
                                 <a class="medio" href="cadastro_cardapio.php"><li>Cadastrar Cardápio</li></a>
                                 <a class="medio" href="lista_cardapios_adm.php"><li>Listar cardápios</li></a>
                             </ul>
                         </span></div>
                       </li>
                       <li>
                         <div class="collapsible-header yellow lighten-4 grande">Otras opções</div>
                         <div class="collapsible-body"><span>
                             <ul>
                                 <a class="medio" href="cadastro_adm.php"><li>Alterar senha do administrador</li></a>
                                 <a class="medio" href="manual_adm.php"><li>Manual do sistema</li></a>
                                 <hr><a class="medio" href="#modal_sobre"><li>Sobre o sistema...</li></a>
                             </ul>
                         </span></div>
                       </li>
                    </ul>

                </div>
            </div>
          </div>
      </main>


    </div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->


  </body>

    <?php include("extends.php"); ?>
</html>
