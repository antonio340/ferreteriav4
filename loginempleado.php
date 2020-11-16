<?php
require_once 'index.php';
use Illuminate\Database\Capsule\Manager as DB;
require 'vendor\autoload.php';
require 'config\database.php';

//resultados de lo ingresado en los cuadros
$nombre=$_POST['nombre'];
$pass=$_POST['pass'];

$revision_de_nombre = DB::table('empleados')->where('nombre', $nombre)->value('nombre');

$revision_de_pass=DB::table('empleados')->where('pass', $pass)->value('pass');


echo '<br>';

if ($nombre==null or $pass==null){
    echo 'xool';
}
//si no 
else{

 //si el nombre y la contraseña son iguales a los de una tabla entonces
 if ($nombre==$revision_de_nombre & $pass==$revision_de_pass){
     //se inicia la sesión
    session_start();
    $_SESSION["empleado"]=$nombre;
    echo 'ingresaste como empleados';
    header("location:index.php");
    
 }
 else
 {
    echo 'xool';
 }
}