<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';

$products = DB::table('productos')->where('categorias_idcategorias', 3)->get();
 
foreach ($products as $fila) {
    echo <<<_ROW
    <table>
    <tr>
        <td>
            $fila->nombre
        </td>
        <td>
               <a class='button' href='compra.php?id={$fila->nombre}'>COMPRAR</a>
        </td>
    </tr>
    <br>
    </table>
_ROW;
}
