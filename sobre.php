<dialog class="mdl-dialog">
    <h4 class="mdl-dialog__title">Sobre...</h4>
    <div class="mdl-dialog__content">
      <h4></h4>
        <p>Equipe de desenvolvimento:</p>
        <p>Professores de T.I. do IFPI Campus Corrente:
        <strong>Felipe Santos, Jonathas Jivago e Robson Borges.</strong></p>
        <p>Projeto original dos alunos do M-III 2015.2: Arivan Lima sob orientação do prof. José Soares Neto.</p>
        <hr>
        Programa registrado - 2017&#174
    </div>
    <div class="mdl-dialog__actions">

      <button type="button" class="mdl-button close">Fechar</button>
    </div>
</dialog>


<script>
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#sobre');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
        dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });
</script>
<script src="js/base.js"></script>
