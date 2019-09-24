$('document').ready(function() {
    $(".selectUser").each((index,value)=>{
        let originalDestination = $(value).attr("href");
        let finalDestination = originalDestination.replace("funcionario.php", "gestao.php"); 
        $(value).attr("href", finalDestination);
    });       
});