var envioSolicitantePri = $('input[name="ENVIO_SOLICITANTE_PRI"]');
var envioSolicitanteSeg = $('input[name="ENVIO_SOLICITANTE_SEG"]')

function somaDia(data, somar){
  let dataLista = data.split('-');
  let dataD = new Date(dataLista[0], dataLista[1], dataLista[2]);
  dataD.setDate(dataD.getDate() + somar);
  let ano = dataD.getFullYear();
  let mes = dataD.getMonth();
  if(mes < 10){
    mes = "0"+mes;
  }
  let dia = dataD.getDate();
  if(dia < 10){
    dia = "0"+dia;
  }
  let mostrar = ano + '-' + mes + '-' + dia;

  return mostrar;
}


