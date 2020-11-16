<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';


//resultados de lo ingresado en los cuadros
$nombre=$_GET['nombre'];


echo '<br>',$nombre,'<br>';

//se busca si ya se encuentra el nombre en la tabla
$revisionNOMBRE= DB::table('productos')->where('nombre', $nombre)->value('nombre');


//se busca el id de la tabla
$tablaID = DB::table('productos')->where('nombre', $nombre)->value('idproductos');

if ($nombre==null)
{
echo 'no todos los campos fueron llenados';
}
else
{
    if ($revisionNOMBRE == $nombre)
    {
        //se insertan los datos en la tabla
        DB::table('productos')->where('nombre', $nombre)->delete();
    }
    else
    {
      //se insertan los datos en la tabla
      echo 'no existe este producto';
    }
    
}