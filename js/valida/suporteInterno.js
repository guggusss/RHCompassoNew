$('document').ready(function() {
    $(".selectUser").each((index,value)=>{
        let originalDestination = $(value).attr("href");
        let finalDestination = originalDestination.replace("funcionario.php", "suporteinterno.php"); 
        $(value).attr("href", finalDestination);
        
    });  
});