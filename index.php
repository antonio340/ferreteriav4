<?php
require_once "header.php";
require "vendor/autoload.php";

session_start();
//si no se encuentra una sesión de empleado entonces muestra lo siguiente
if(!isset($_SESSION["empleado"]) and !isset($_SESSION["cliente"]))
{
 echo <<<_LOGIN1

 
 <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
 </nav>

 <section class="section">
     <h4 class="title is-4">- ingresar como empleado -</h4>
 <form name="login" method="post" action="loginempleado.php">
  <strong>nombre</strong>
    <input type="text" name="nombre">
  <strong>contraseña</strong>
    <input type="password" name="pass">
    <button class="button is-link is-light" type="submit" >login</button>
   
 </form>
</section>
 <br>
 <br>

 <section class="section">
 <h4 class="title is-4">- ingresar como cliente -</h4>
 <form name="form1" method="post" action="logincliente.php">
  <strong>nombre</strong>
    <input type="text" name="nombre">
  <strong>contraseña</strong>
    <input type="password" name="pass">
    <button class="button is-link is-light" type="submit" >login</button>

 </form>
 </section>
_LOGIN1;
}
//si encontró una sesión de empleado entonces 
else
{
 
    if(isset($_SESSION["cliente"]))
    {
     
    echo <<<_LOGGED2

    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
            <div class="buttons">
          <a class="button is-dark" href="logout.php">
             <strong>Log out</strong></a>
            
             <a class="button is-dark" href="todos.php">
                <strong>Todos</strong></a>
               
                <a class="button is-dark" href="cat1.php">
                   <strong>Herramientas</strong></a>
             
                   <a class="button is-dark" href="cat2.php">
                      <strong>Electricos</strong></a>
                      
                      <a class="button is-dark" href="cat3.php">
                         <strong>Clavos y tornillos</strong>
                         
          </a>
        </nav>
_LOGGED2;
     }
     else
     {
        $nombre_de_usuario=$_SESSION["empleado"];
 
   echo <<<_LOGGED1

    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
            <div class="buttons">
          <a class="button is-dark" href="logout.php">
             <strong>Log out</strong>
          </a>
          <a class="button is-dark" href="todos.php">
          <strong>Todos</strong></a>
         
          <a class="button is-dark" href="cat1.php">
             <strong>Herramientas</strong></a>
       
             <a class="button is-dark" href="cat2.php">
                <strong>Electricos</strong></a>
                
                <a class="button is-dark" href="cat3.php">
                   <strong>Clavos y tornillos</strong></a>

                   <a class="button is-dark" href="insertar1.php">
                   <strong>Insertar y editar</strong></a>

                   <a class="button is-dark" href="eraseproducto1.php">
                   <strong>eliminar</strong></a>
    </nav>
    
    <section class="hero">
    <div class="hero-head">
      
        <h1 class="title">
        sesion iniciada como: 
        </h1>
        <h2 class="subtitle">
         -$nombre_de_usuario-
        </h2>
      </div>
  </section>



_LOGGED1;




     }
}
