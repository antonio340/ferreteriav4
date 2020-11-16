<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';


//resultados de lo ingresado en los cuadros
$nombre=$_GET['nombre'];
$categoria=$_GET['categoria'];
$cantidad=$_GET['cantidad'];
$precio=$_GET['precio'];

echo '<br>',$nombre,'<br>', $categoria,'<br>', $cantidad,'<br>', $precio;

//se busca si ya se encuentra el nombre en la tabla
$revisionNOMBRE= DB::table('productos')->where('nombre', $nombre)->value('nombre');

//se busca el id de la categoria
$IDcategoria = DB::table('categorias')->where('categoria', $categoria)->value('idcategorias');
echo '<br>',$IDcategoria;

//se busca el id de la tabla
$tablaID = DB::table('productos')->where('nombre', $nombre)->value('idproductos');

if ($nombre==null or $categoria==null or $cantidad==null)
{
echo 'no todos los campos fueron llenados';
}
else
{
    if ($revisionNOMBRE == $nombre)
    {
        //se insertan los datos en la tabla
        DB::table('productos')->where('nombre', $nombre)->update(['categorias_idcategorias' => $IDcategoria,'nombre' => $nombre,'cantidad' => $cantidad,'precio' => $precio]);
    }
    else
    {
      //se insertan los datos en la tabla
      DB::table('productos')->insert(['categorias_idcategorias' => $IDcategoria,'nombre' => $nombre,'cantidad' => $cantidad,'precio' => $precio]);
    }
    
}