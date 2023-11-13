    <nav>
        <div class="nav-wrapper green z-depth-3">
          <a href="principal.php" class="brand-logo center">
            <div class="chip"><?php include("validar.php"); ?></div>
            <?php if ($tipo == 'ADM') {
                    header('location:index.php?erro=<div class="alert alert-error">Zona indevida!</div>');
            } ?>
          </a>
          <!-- MENU PRINCIPAL PARA TELAS DESKTOP -->
          <a href="#" data-activates="mobile-demo" class="button-collapse"><img src="img/ic_menu_black_24dp_1x.png" alt="Menu"></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="solicita_ticket.php">Refeição</a></li>
            <li><a href="cadastro.php">Dados Cadastrais</a></li>
            <li ><a href="altera_senha_aluno.php">Alterar Senha</a></li>
            <li><a href="#modal_sobre">Sobre</a></li>
            <li><a href="logout.php">Sair</a></li>
          </ul>
          <!-- MENU LATERAL PARA TELAS PEQUENAS -->
          <ul class="side-nav v_center" id="mobile-demo">
            <li class='userView red '><img src="<?php echo $foto ?>" class="circle pequeno materialboxed"><?php echo "$primeironome"?></li>
            <li><a href="principal.php"><img src="img/ic_home_black_24dp_1x.png"> Inicio</a></li>
            <li class="divider"></li>
            <li><a href="solicita_ticket.php"><img src="img/ic_restaurant_black_24dp_1x.png"> Solicitar Refeição</a></li>
            <li ><a href="cadastro.php"><img src="img/ic_account_circle_black_24dp_1x.png"> Dados Cadastrais</a></li>
            <li ><a href="altera_senha_aluno.php"><img src="img/ic_vpn_key_black_24dp_1x.png"> Alterar Senha</a></li>

            <li ><a href="#modal_sobre"><img src="img/ic_developer_mode_black_24dp_1x.png" alt=""> Sobre</a></li>
            <li class="divider"></li>
            <li ><a href="logout.php"><img src="img/ic_exit_to_app_black_24dp_1x.png" alt=""> Sair</a></li>
          </ul>
        </div>
      </nav>

      <!-- Modal - Estrutra da Janela Sobre... -->
      <div id="modal_sobre" class="modal">
          <div class="modal-content">

              <h5>Sistema de Controle de Reservas de Refeições</h5>
                <hr>
              <p>Desenvolvido pelos professores de Informática do IFPI Campus Corrente:
                <strong>Felipe Santos, Jonathas Jivago e Robson Borges.</strong></p>
                <p>Projeto original dos alunos do M-III 2015.2 Arivan Silva sob orientação do prof. José Soares Neto.</p>
                <hr>
                Sistema construido utilizando software livre - 2017
          </div>
          <div class="modal-footer">
              <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat"  >Fechar</a>
          </div>
      </div> <!-- Finda da janela Modal - Sobre... -->
