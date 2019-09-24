// passe o numeros dos stepWizards q você quer desabilitar
//OBs: Não funciona no menuPrincipal, pois não tem os ID especificos
function desbilitaStepWizard(){
    let tam = arguments.length;
    for(let i = 0; i < tam; i++){
       $("#botao"+ arguments[i]).prop("disabled", true);
       $("#botao"+ arguments[i]).attr("disabled", true);
       $("#botao"+ arguments[i]).attr("href", "#");
    }
}