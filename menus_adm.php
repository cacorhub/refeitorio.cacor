
<nav>
    <div class="nav-wrapper red z-depth-3">
      <a href="principal_adm.php" class="brand-logo center">
        <div class="chip"><?php include("validar.php"); ?></div>
        <?php if ($tipo == 'ALUNO') {
                header("location:index.php?erro=Zona indevida!");
        } ?>
      </a>
      <!-- Dropdown Structure NUTRICIONISTA -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="cadastro_cardapio.php">Cadastrar Cardápio</a></li>
            <li><a href="verifica_reifeicoes_dia.php">Verificar Quantidade de Refeições solicitadas (Almoço)</a></li>
			<li><a href="verifica_reifeicoes_dia_janta.php">Verificar Quantidade de Refeições solicitadas (Janta)</a></li>
            <li class="divider"></li>
            <li><a href="lista_cardapios_adm.php">Listagem de Cardápios</a></li>
        </ul>
      <!-- Dropdown Structure  ADMINISTRADOR-->
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="cadastro_alunos.php">Cadastrar Alunos</a></li>
            <li><a href="lista_alunos_adm.php">Pesquisar alunos</a></li>
            <!-- <li><a href="lista_alunos_cards.php">Lista Cards de alunos</a></li> -->
            <li class="divider"></li>
            <li><a href="adm_opcoes.php">Outras funções</a></li>
        </ul>
      <!-- Dropdown Structure USUÁRIO -->
        <ul id="dropdown3" class="dropdown-content">
            <li><a href="cadastro_adm.php">Alterar Senha</a></li>
            <li><a href="#modal_sobre">Sobre</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>

      <a href="#" data-activates="mobile-demo" class="button-collapse"><img src="img/ic_menu_black_24dp_1x.png"></a>
      <ul class="right hide-on-med-and-down">
          <!-- Dropdown Trigger 1-->
          <li><a class="dropdown-button" href="#" data-activates="dropdown1">Nutricionista</a></li>
          <!-- Dropdown Trigger 2-->
          <li><a class="dropdown-button" href="#" data-activates="dropdown2">Administrador</a></li>
          <!-- Dropdown Trigger 3-->
          <li><a class="dropdown-button" href="#" data-activates="dropdown3">Usuário</a></li>




      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="principal_adm.php"><img src="img/ic_home_black_24dp_1x.png" alt=""> Inicio</a></li>
        <hr>
        <li><a href="cadastro_cardapio.php">Cadastrar Cardápio</a></li>
        <li><a href="verifica_reifeicoes_dia.php">Verificar Quantidade de Refeições solicitadas</a></li>
                    <li><a href="lista_alunos_adm_fichas.php">Lista de alunos que solicitaram fichas</a></li>
        <li><a href="lista_cardapios_adm.php">Listagem de Cardápios</a></li>
        <hr>
        <li><a href="cadastro_alunos.php">Cadastrar Alunos</a></li>
        <li><a href="lista_alunos_adm.php">Lista de alunos</a></li>
        <li><a href="lista_alunos_cards.php">Ficha de alunos</a></li>
        <li><a href="adm_opcoes.php">Outras funções</a></li>
        <hr>
        <li><a href="#modal_sobre"><img src="img/ic_developer_mode_black_24dp_1x.png"> Sobre</a></li>
        <hr>
        <li><a href="cadastro_adm.php"><img src="img/ic_vpn_key_black_24dp_1x.png"> Alterar Senha</a></li>
        <li><a href="logout.php"><img src="img/ic_exit_to_app_black_24dp_1x.png" > Sair</a></li>
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
