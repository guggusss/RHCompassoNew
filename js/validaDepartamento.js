window.onload = function verifica() 
{
let grupo = "<?= $grupo; ?>";
/*/console.log(grupo);/*/
let isDepartamentoRH = false;
if (grupo == "Departamento de Recursos Humanos") 
{
desbilitaStepWizard(3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
$("#proximo").attr("disabled", true);
$("#botao12").prop("disabled", true);
$("#botao12").css("pointer-events", "none");
} 
else 
{
if (!document.getElementById("campo").value == "" && !document.getElementById("campo2").value == "" && !document.getElementById("campo3").value == "" && !document.getElementById("campo4").value == "" && !document.getElementById("campo5").value == "" && !document.getElementById("campo6").value == "" && !document.getElementById("campo8").value == "") 
{
$("#gestao, #proximo, #botao, #botao5, #botao6, #botao7, #botao8, #botao9, #botao10, #botao11").removeClass("disabled").attr("disabled", false);
}
}
}
