<?php
if (isset($_GET['erro']))  {
  if ($_GET['erro'] == "fail") {
    echo "<script> document.getElementById('oculto').removeAttribute('hidden'); </script>";    
  } 
}
?>
