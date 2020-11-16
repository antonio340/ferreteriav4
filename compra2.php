<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';

$pago=$_GET["pago"];
$unidades=$_GET["unidades"];
$nombre=$_GET["nombre"];

$prec = DB::table('productos')->where('nombre', $nombre)->value('precio');

if ($pago==$prec)
{

 $cant = DB::table('productos')->where('nombre', $nombre)->value('cantidad');
 $restacantidad=$cant-$unidades;
 DB::table('productos')->where('nombre', $nombre)->update(['cantidad' => $restacantidad]);
 echo 'cantidad restante: ',$restacantidad;
}
else
echo'no esta cumpliendo el pago requerido';