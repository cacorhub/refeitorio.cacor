<?php
include("headers.php");
?>
<body>
    <?php
    include("menus_adm.php");
    ?>

    <!-- Conteudo da página principal... -->
    <div class="container">
        <div class="row">
            <div class="span s12">
                <h3 class="center">#RefeitórioWeb - Administração</h3>
                <h3 class="center alert">Manual do sistema</h3>
            </div>
            <div class="row">
                <div class="span s12">
                    <img src="img/logo.png" class="logo foto_grande" >

                </div>
            </div>
            <div class="row">
                <div class="span s4">
                    <ol>
                        <a href="#1">  <li>Apresentação</li></a>
                        <a href="#2">  <li>Objetivos</li></a>
                        <a href="#3">  <li>Objetivos Específicos</li></a>
                        <a href="#4">  <li>Suporte Técnico</li></a>
                        <a href="#5">  <li>Sobre</li></a>
                    </ol>
                </div>
                <div class="span s8">
                    <a name="1"><h5>Apresentação</h5></a>
                    <p class='justificado'>A dificuldade que a equipe responsável pelo preparo das refeições tem para determinar o número de bandejas a serem ofertadas. O método tradicional utiliza a entrega de fichas, mas como alguns estudantes solicitam fichas e não comparecem, ocorrem situações de desperdício. Outra falha deste método é a incapacidade de determinar o número de servidores, esses têm acesso à refeição mediante o pagamento na entrada do refeitório, e quando um número maior do que o previsto de servidores comparecem, ocorre a falta de refeições.
                        Identificar estudantes que solicitam a ficha do refeitório e não comparecem ao almoço. Com o método de fichas não é possível verificar quem está ocasionando desperdício de alimento.
                        Restringir o acesso não autorizado ao restaurante estudantil. As fichas podem ser entregues a pessoas que não deveriam ter acesso ao refeitório, além da possibilidade de falsificação dessas fichas.
                        Obter um perfil dos usuários do restaurante estudantil. Através de relatórios gerados pelo sistema será possível obter informações como o turno, sexo, curso e outros dados dos frequentadores, dias de maior movimento e etc.
                        Otimizar o funcionamento do restaurante estudantil ocasionando economia e maior eficiência.
                        A atividade geral do projeto consiste em adaptar a análise previamente elaborada e fazer a reconstrução, implementação e implantação de um sistema de software que automatiza o processo de reservas de refeições do refeitório do IFPI campus Corrente.
                        A nova versão proposta do projeto será utilizada uma leitora biométrica para melhor identificação do aluno/usuário e também o sistema irá permitir a entrada utilizando um código de identificação, como CPF.
                    </p>

                    <a name="2"><h5>Objetivos</h5></a>
                    <p class='justificado'>O projeto tem como produto um conjunto de Softwares em quatro módulos:
                        O primeiro Módulo, usa tecnologia Web para reserva de refeição utilizado pelos estudantes acessados pelo seus próprios smartphones dentro da rede de dados do campus.
                        O segundo módulo é o de administração feito pelo nutricionista e departamento de logística, que controla o cardápio e refeições disponíveis para cada dia, cadastramento de alunos e outras funções como relatório diário de reservas/ desperdício utilizando tecnologia web.
                        O terceiro módulo é o de cadastramento biométrico de alunos e utilizadores do refeitório.
                        O quarto módulo, chamado de “Módulo Porteiro”, identifica e controla a entrada dos utilizadores do refeitório através de identificação biométrica ou CPF usando um módulo desktop.
                    </p>
                    <a name="3"><h5>Objetivos Específicos</h5></a>
                    <p class='justificado'>A utilização de um sistema informatizado para o controle de reservas de refeições irá possibilitar um total controle sobre os discentes que utilizam o refeitório do campus, a eliminação de fila para obtenção de fichas de papel, eliminação do uso de papel e redução no desperdício de alimentos. Traz ainda conforto e comodidade para os alunos que não precisarão enfrentar fila para reservar seu almoço.</p>
                    <a name="4"><h5>Suporte Técnico</h5></a>
                    <p>0800-0000-0000</p>
                    <a name="#sobre"><h5>Sobre</h5></a>
                    <p>Desenvolvido pelos professores de Informática do IFPI Campus Corrente: Felipe Santos, Jonathas Jivago e Robson Borges.</p>
                        <p>Projeto original dos alunos do M-III 2015.2 Arivan Silva sob orientação do prof. José Soares Neto.
                        <p>Sistema construido utilizando software livre - 2017</p>

                </div>

            </div>
        </div>
    </div>


</div> <!--  FIM DO CONTAINER DA PÁGINA: mdl-layout -->


</body>

<?php include("extends.php"); ?>
</html>
