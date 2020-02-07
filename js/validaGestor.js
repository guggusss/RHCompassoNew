let grupo = "<?= $grupo ?>";
window.onload = () => {
    if (grupo == "Gestores") {
        desbilitaStepWizard(2, 4, 5, 6, 7, 8, 9, 10, 11);
        $("#proximo").prop("disabled", true);
        $("#proximo").attr("disabled", true);
        $("#proximo").attr("href", "#");
    }

}
