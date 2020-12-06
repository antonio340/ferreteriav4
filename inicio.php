<?php
use Illuminate\Database\Capsule\Manager as DB;
require_once "header.php";
require "vendor/autoload.php";
require 'config/database.php';

//productos
$prod = DB::table('productos')->select(  
   'idproductos',
  'nombreproductos',
)->get();


//categoria
$cate = DB::table('categorias')->select(
   'idcategorias',
  'nombrecategorias',  
)->get();

//id del usuario en la url
$prueba=$_GET['idusuario'];

//user buscara al usuario por medio de su id
$user = DB::table('usuarios')
->leftJoin('perfiles', 'usuarios.perfiles_idperfiles', '=', 'perfiles.idperfiles')
->where('usuarios.idusuarios', $prueba)
->first();



if ($user->nombreperfiles == 'empleado'){
    $perfil=true;
}
   
else{
     $perfil=false;
}


if ($perfil == true){
?>
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
<div class="buttons">
          <a class="button is-dark" href="index.php">
             <strong>Log out</strong>
          </a>
         </div>
    </nav>
<!-- INSERTAR PRODUCTO FORMULARIO -->
<section class="section">
  <div class="box">
        <h4 class="title is-4">- Agregar productos -</h4>
        <form name="form2" method="POST" action="">

        <div class="field">
          <label class="label">categoria: </label>
          <div class="control">          
            <div class="select">
              <select id='selectCategorias' name='categorias' form='form2'>
                <?php             
                  foreach ($cate as $row) {
                    echo "<option value='$row->idcategorias'> 
                    {$row->nombrecategorias} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>               
          
        <div class="field">
            <label class="label">Nombre</label>
            <div class="control">
              <input class="input" type="text" name="nombre" placeholder="escriba un nombre">
            </div>
          </div>      

          <div class="field">
            <label class="label">Precio</label>
            <div class="control">
              <input class="input" type="text" name="precio" placeholder="escribe un precio">
            </div>
          </div>      

          <div class="field">
            <label class="label">Cantidad</label>
            <div class="control">
              <input class="input" type="text" name="cantidad" placeholder="escribe una cantidad">
            </div>
          </div>      

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link is-light" onclick="insertar()">Insertar</button>
            </div> 
          </div>    

         </form>
  </div>
</section>


        
<!-- ELIMINAR PRODUCTO FORMULARIO -->
<section class="section">
  <div class="box">
        <h4 class="title is-4">- Eliminar productos-</h4>
        <form name="form3" method="POST" action="">

        <div class="field">
          <label class="label">Categoria: </label>
          <div class="control">          
            <div class="select">
              <select id='selectCategorias2' name='categorias' form='form3'>
                <?php             
                 foreach ($cate as $row) {
                  echo "<option value='$row->idcategorias'> 
                  {$row->nombrecategorias} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>   

        <div class="field">
          <label class="label">Nombre: </label>
          <div class="control">          
            <div class="select">
              <select id='selectNombre' name='nombres' form='form3'>
                <?php             
                  foreach ($prod as $row) {
                    echo "<option value='$row->idproductos'> 
                    {$row->nombreproductos} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>             
          
        <div class="field is-grouped">
            <div class="control">
              <button class="button is-link is-light" onclick="eliminar()">Borrar</button>
            </div> 
          </div> 

         </form>
  </div>
</section>


<!-- INSERTAR CATEGORIA FORMULARIO -->
<section class="section">
  <div class="box">
    <h4 class="title is-4">- Nueva categoría -</h4>
      <form name="newcate" method="POST" action="">

        <div class="field">
          <label class="label">Nombre</label>
            <div class="control">
              <input class="input" type="text" name="nombre" placeholder="escribe un nombre">
            </div> 
        </div>  

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link is-light" onclick="insertar2()">Crear</button>
            </div> 
          </div> 

      </form>
  </div>
</section>


<!-- ELIMNIAR CATEGORIA FORMULARIO -->
<section class="section">
  <div class="box">
    <h4 class="title is-4">- Eliminar categoría -</h4>
      <form name="deletecate" method="POST" action="">

      <div class="field">
          <label class="label">selecciona una categoria: </label>
          <div class="control">          
            <div class="select">
              <select id='selectCategorias3' name='categorias' form='deletecate'>
                <?php             
                foreach ($cate as $row) {
                  echo "<option value='$row->idcategorias'> 
                  {$row->nombrecategorias} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>  

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link is-light" onclick="eliminar2()">Borrar</button>
            </div> 
          </div> 

      </form>
  </div>
</section>
<!-- EDITAR PRODUCTOS FORMULARIO -->

<section class="section">
  <div class="box">
        <h4 class="title is-4">- editar productos -</h4>
        <form name="edit" method="POST" action="">

        <div class="field">
          <label class="label">categoria: </label>
          <div class="control">          
            <div class="select">
              <select id='selectCategorias4' name='categorias' form='edit'>
                <?php             
                  foreach ($cate as $row) {
                    echo "<option value='$row->idcategorias'> 
                    {$row->nombrecategorias} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>               
          
        <div class="field">
          <label class="label">Nombre: </label>
          <div class="control">          
            <div class="select">
              <select id='selectNombre4' name='nombres' form='edit'>
                <?php             
                  foreach ($prod as $row) {
                    echo "<option value='$row->idproductos'> 
                    {$row->nombreproductos} </option>";
                  }          
                ?>
              </select>          
            </div>
          </div>
        </div>             

          <div class="field">
            <label class="label">Precio</label>
            <div class="control">
              <input class="input" type="text" name="precio" placeholder="escribe un precio">
            </div>
          </div>      

          <div class="field">
            <label class="label">Cantidad</label>
            <div class="control">
              <input class="input" type="text" name="cantidad" placeholder="escribe una cantidad">
            </div>
          </div>      

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link is-light" onclick="editar()">Actualizar</button>
            </div> 
          </div>    

         </form>
  </div>
</section>



<!--MOSTRAR PRODUCTOS -->
<section class="section">

  <div class="box">
  <h4 class="title is-4">- Lista de productos-</h4>
 
  <table class="table">
  <thead>
    <tr>
      <th><abbr title="Position">#</abbr></th>
      <th>Nombre del producto</th>
      <th>categoria</th>
      <th>precio</th> 
      <th>cantidad</th>     
     <th> <button class="button is-link is-light" onclick="consultar()">actualizar</button></th>        
    </tr>
  </thead>  
  <tbody  id='contenido'> </tbody>
</table>
  </div>
</section>

<?php
}
else{
  echo<<<_USUARIO
  <section class="section">

  <div class="box">
  <h4 class="title is-4">- Lista de productos-</h4>
 
  <table class="table">
  <thead>
    <tr>
      <th><abbr title="Position">#</abbr></th>
      <th>Nombre del producto</th>
      <th>categoria</th>
      <th>precio</th> 
      <th>cantidad</th>     
     <th> <button class="button is-link is-light" onclick="consultar()">actualizar</button></th>        
    </tr>
  </thead>  
  <tbody  id='contenido'> </tbody>
</table>
  </div>
</section>

_USUARIO;
}
?>
<!-- FUNCIONES JAVASCRIPT -->
<script>


//MOSTRAR PRODUCTOS
     function consultar(){       
       axios.post(`api/funcion.php/consultar`)
       .then(resp => {
         if (resp.data.productos) {
          var filas

          resp.data.productos.forEach( function (row, index) {
            n = index + 1
            filas += `<tr>
            <th> ${n} </th>
            <td> ${row['nombreproductos']} </td>
            <td> ${row['nombrecategorias']} </td>
            <td> ${row['precio']} </td>
            <td> ${row['cantidad']} </td>
            <td>  <a class='button' href='compra.php?id=${row['idproductos']}'>COMPRAR</a> </td>
            </tr>`
          })         

          document.getElementById('contenido').innerHTML = filas
         } else {
             alert(`sin productos`)
         }
       }).catch(error => {
         console.log(error)
       })

     } 

   //INSERTAR FUNCION
    function insertar(){
    
      
      var selectCate = document.getElementById("selectCategorias")
      var CateSelect = selectCate.options[selectCate.selectedIndex].value
      

        axios.post(`api/funcion.php/insertar`, {
          categoria: CateSelect,
          nombre: document.forms['form2'].nombre.value,
          precio: document.forms['form2'].precio.value,
          cantidad: document.forms['form2'].cantidad.value,

       }).then(resp => {
         if (resp.data.aceptado){
             alert('se inserto el producto')
         } else {
             alert('se produjo un error')
         }

       }).catch(error => {
         console.log(error)
       })
    }
    
 //INSERTAR CATEGOOORIAA FUNCION
 function insertar2(){
    
      axios.post(`api/funcion.php/insertar2`, {
        nombre: document.forms['newcate'].nombre.value,
     }).then(resp => {
       if (resp.data.aceptado){
           alert('se inserto la categoria')
       } else {
           alert('se produjo un error')
       }

     }).catch(error => {
       console.log(error)
     })
  }
  
  //ELIMINAR FUNCION
  function eliminar(){

      
      var selectCate = document.getElementById("selectCategorias2")
      var CateSelect = selectCate.options[selectCate.selectedIndex].value
      
      var selectNom = document.getElementById("selectNombre")
      var NomSelect = selectNom.options[selectNom.selectedIndex].value

        axios.post(`api/funcion.php/eliminar`, {
          categoria: CateSelect,
          nombre: NomSelect,
        
       }).then(resp => {
         if (resp.data.aceptado){
             alert('se elimino el producto')
         } else {
             alert('se produjo un error')
         }

       }).catch(error => {
         console.log(error)
       })
    }

//ELIMINAR CATEGORIA FUNCION
function eliminar2(){

      
var selectCate = document.getElementById("selectCategorias3")
var CateSelect = selectCate.options[selectCate.selectedIndex].value



  axios.post(`api/funcion.php/eliminar2`, {
    categoria: CateSelect,

 }).then(resp => {
   if (resp.data.aceptado){
       alert('se elimino la categoria')
   } else {
       alert('se produjo un error')
   }

 }).catch(error => {
   console.log(error)
 })
}



      //EDITAR FUNCION
      function editar(){
        var selectCate = document.getElementById("selectCategorias4")
      var CateSelect = selectCate.options[selectCate.selectedIndex].value
      
      var selectNom = document.getElementById("selectNombre4")
      var NomSelect = selectNom.options[selectNom.selectedIndex].value

        axios.post(`api/funcion.php/editar`, {
          categoria: CateSelect,
          nombre: NomSelect,
          precio: document.forms['edit'].precio.value,
          cantidad: document.forms['edit'].cantidad.value,
       }).then(resp => {
         if (resp.data.aceptado){
             alert('se edito el producto correctamente')
         } else {
             alert('se produjo un error')
         }

       }).catch(error => {
         console.log(error)
       })
    }

    window.onload=consultar
    
    </script>
    </body>
    </html>