<div class="alert alert-secondary text-center" role="alert">
<h1>Control de acceso</h1>
</div>


<?php
if (isset($data["error"])) {
    echo "<div style='color: red'>".$data["error"]."</div>";
}
if (isset($data["info"])) {
    echo "<div style='color: blue'>".$data["info"]."</div>";
}
?>
<!-- Login antiguo sin CSS
<form action="index.php" method="get">
    Usuario: <input class="form-control" type='text' name='usuario'><br/>
    Contraseña: <input type='password' name='contraseña'><br/>
    <input type='hidden' name='action' value='procesarFormLogin'>
    <input type='hidden' name='controller' value='UsuariosController'>
    <button type='submit'>Enviar</button>
</form> -->


<!-- Aqui esta el nuevo login con estilos CSS-->


<div  class='d-grid gap-3 col-3 mx-auto '>
<form action="index.php" method="get">
  <div class="mb-3">
    <label class="form-label">Usuario</label>
    <input class="form-control" type='text' name='usuario'>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
    <input class="form-control" type='password' name='contraseña'>
  </div>

  <input type='hidden' name='action' value='procesarFormLogin'>
  <input type='hidden' name='controller' value='UsuariosController'>
  <button type="submit" class="btn btn-outline-primary">Entrar</button>
</form>
</div>

