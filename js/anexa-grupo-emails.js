function anexaGrupo() {
      var results =
        [{ id: "Equipe CWB", text: "Equipe CWB" },
          { id: "Equipe ERM", text: "Equipe ERM" },
          { id: "Equipe FLN", text: "Equipe FLN" },
          { id: "Equipe FOR", text: "Equipe FOR" },
          { id: "Equipe PF", text: "Equipe PF" },
          { id: "Equipe POA", text: "Equipe POA" },
          { id: "Equipe REC", text: "Equipe REC" },
          { id: "Equipe RG", text: "Equipe RG" },
          { id: "Equipe SP", text: "Equipe SP" },
          { id: "Equipe OUL DIVEO", text: "Equipe OUL DIVEO" },
          { id: "Equipe US", text: "Equipe US" },
          { id: "Equipe XAP", text: "Equipe XAP"}];
            $("#books").select2({
                data: results,
                multiple: true
                //pagination: true
                //allowClear: true
            });
    }
$('#books').click();
