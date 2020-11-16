<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';

$Id=$_GET["id"];

$idcate = DB::table('productos')->where('nombre', $Id)->value('categorias_idcategorias');

$cate = DB::table('categorias')->where('idcategorias', $idcate)->value('categoria');

$cant = DB::table('productos')->where('nombre', $Id)->value('cantidad');

$prec = DB::table('productos')->where('nombre', $Id)->value('precio');

echo 'nombre: ',$Id, '<br>';
echo 'categoria: ', $cate, '<br>';
echo 'cantidad: ', $cant, '<br>';
echo 'precio: $', $prec, '<br>';

echo <<<_FORMCOMPRA
</br>
</br>
<form name="form1" method="get" action="compra2.php">
<p>Cantidad a pagar</p>
  <input type="text" name="pago">
<p>unidades que llevara</p>
  <input type="text" name="unidades">
<p>confirmación del nombre del producto</p>
  <input type="text" value=$Id name="nombre">
  
  </br>
  </br>
  <button class="button is-link is-light"  type="submit" >comprar</button>
</form>
_FORMCOMPRA;