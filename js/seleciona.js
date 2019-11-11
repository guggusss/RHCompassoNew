document.querySelector("#foo").onclick = function() {
    document.execCommand('selectAll',false,null);
    document.execCommand("copy")
};