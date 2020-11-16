<?php
require_once 'index.php';


if(!isset($_SESSION["empleado"]))
{
 echo('no puedes estar aqui');
}
else{

echo <<<_ELIMINARCAL

<br>
<br>

    <p>- Eliminar producto -</p>
<form method="get" action="eraseproducto2.php">

 <p>nombre del alumno</p>
   <input type="text" name="nombre">
   <br>
   <br>
   <button class="button is-danger is-light" type="submit" >Eliminar</button>

</form>

_ELIMINARCAL;
}
