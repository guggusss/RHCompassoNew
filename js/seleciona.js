document.querySelector("#foo").onclick = function() {
    var divACopiar = document.querySelector("#selecionaPagina");

    var range = document.createRange();
    range.selectNode(divACopiar);
    window.getSelection().addRange(range);
    document.execCommand("copy");
};
