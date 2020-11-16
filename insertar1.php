
<?php
require_once 'index.php';


if(!isset($_SESSION["empleado"]))
{
 echo('no puedes estar aqui');
}
else{

echo <<<_INSERTARCAL

<section class="section">
    <p>- insertar y editar calificaciones -</p>
    <br>
<form method="get" action="insertar2.php">

 <p>Nombre del producto</p>
   <input type="text" name="nombre">
 <p>categoría</p>
   <input type="text" name="categoria">
 <p>cantidad</p>
   <input type="text" name="cantidad">
   <p>precio</p>
   <input type="text" name="precio">
  <br> 
  <br>
   <button class="button is-danger is-light" type="submit">insertar</button>

</form>
</section>
_INSERTARCAL;
}