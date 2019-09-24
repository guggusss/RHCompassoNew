<div id="BoxForm">
    <form action="../enviaEmails.php" method="post" enctype="multipart/form-data" id="formulario">
      <ul>
        <input type="hidden" name="id" value="<?=$id; ?>">
        <input type="hidden" name="nome" class="campos01" value="<?=$nome['NOME']; ?>">
        
        <input type="hidden" name="id" value="<?=$id; ?>">
        <input type="hidden" name="nome" class="campos01" value="<?=$nome['NOME']; ?>">
        <li>
          <label for="de">De:</label>
          <input type="text" name="de" class="campos01" value="<?=$InfoUser[0]['mail'][0];?>"><br>
        </li>
        <li>
          <label for="como">Como:</label>
          <select type="text" name="como" class="campos01" value="">
            <option value="" selected="selected" class="campos01"></option>
            <option value="contratacoes@compasso.com.br" class="campos01">contratacoes@compasso.com.br</option>
            <option value="rh@compasso.com.br" class="campos01">rh@compasso.com.br</option>
          </select><br>
          <span style="color:red"><b>Selecione caso queira enviar como Alias</b></span><br>
        </li>
        <li class="senha">
          <label for="de">Senha:</label>
          <p>
            <input type="password" id="senha" name="senha" class="campos01" value="">
            <span id="olho"/><img src='../img/olho.png' class="show">
          </p>
        </li>
        <li>
          <label for="email">Para:</label>
          <input type="email" name="email" class="campos01" value="<?=$nome['EMAIL']; ?>"><br>
        </li>
        <li>
          <label for="assunto">Assunto:</label>
          <input type="text" name="assunto" class="campos01 form-control" value=""><br>
        </li>
        <li>
          <label for="">Anexos:</label>
          <input type="file" multiple="multiple" class="campos01 formControl" name="arquivo[]"/>
        </li>
        <li>
          <button type="submit" id="enviar" class="button3">Enviar</button>
        </li>
      </ul>
      <input type="hidden" name="body" id="inputBody" value="">
    </form>
  </div>