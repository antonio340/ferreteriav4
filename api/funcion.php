<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

// Instantiate app
$app = AppFactory::create();
$app->setBasePath('/ferreteriav4/api/funcion.php');

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});

//login de usuarios
$app->post('/login/{usuario}', function (Request $request, Response $response, array $args) {
    
    $data = json_decode($request->getBody()->getContents(), false);
  

    $user = DB::table('usuarios')
    ->leftjoin('perfiles','usuarios.perfiles_idperfiles', '=', 'perfiles.idperfiles')
    ->where('usuarios.nombreusuarios',$data->usuario)
    ->first();

    $msg = new stdClass();
    
    if ($user->password == $data->password){
        
        $msg->aceptado = true;
        $msg->nombreperfiles = $user->nombreperfiles;
        $msg->idusuario = $user->idusuarios;
    
    }
    else {
        $msg->aceptado = false;
    }
    $response->getBody()->write(json_encode($msg));
    return $response;
    
});

//insertar producto
$app->post('/insertar', function (Request $request, Response $response, array $args){

    $data = json_decode($request->getBody()->getContents(), false);

    

    $id = DB::table('productos')->insertGetId([
         'nombreproductos' => $data->nombre,
         'categorias_idcategorias' => $data->categoria,
         'precio' => $data->precio,
         'cantidad' => $data->cantidad,
    ]);
    $msg = new stdClass();
    $msg->aceptado = !empty($id);
    $response->getBody()->write(json_encode($msg));
    return $response;
});

//insertar categoria  calificaciones
$app->post('/insertar2', function (Request $request, Response $response, array $args){

    $data = json_decode($request->getBody()->getContents(), false);

    

    $id = DB::table('categorias')->insertGetId([
         'nombrecategorias' => $data->nombre,
       
    ]);
    $msg = new stdClass();
    $msg->aceptado = !empty($id);
    $response->getBody()->write(json_encode($msg));
    return $response;
});

//borrar productos
$app->post('/eliminar', function (Request $request, Response $response, array $args){

    $data = json_decode($request->getBody()->getContents(), false);

 
    $id = DB::table('productos')->where(
        'idproductos',$data->nombre)->where(
        'categorias_idcategorias',$data->categoria
    )->delete();
    $msg = new stdClass();
    $msg->aceptado = true;
    $response->getBody()->write(json_encode($msg));
    return $response;
});

//borrar categorias
$app->post('/eliminar2', function (Request $request, Response $response, array $args){

    $data = json_decode($request->getBody()->getContents(), false);

 
    $id = DB::table('categorias')->where(
        'idcategorias',$data->categoria
    )->delete();

    $borrar = DB::table('productos')->where(
        'categorias_idcategorias',$data->categoria
    )->delete();

    $msg = new stdClass();
    $msg->aceptado = true;
    $response->getBody()->write(json_encode($msg));
    return $response;
});


//editar productos
$app->post('/editar', function (Request $request, Response $response, array $args){

    $data = json_decode($request->getBody()->getContents(), false);

    

    $id = DB::table('productos')->where(
        'idproductos',$data->nombre)->where(
        'categorias_idcategorias',$data->categoria
    )->update([
        'precio' => $data->precio,
        'cantidad' => $data->cantidad,
    ]);
    $msg = new stdClass();
    $msg->aceptado = !empty($id);
    $response->getBody()->write(json_encode($msg));
    return $response;
});

//Mostrar los productos
$app->post('/consultar', function (Request $request, Response $response, array $args){    
    
    $data = new stdClass();
    //$perfil = $user->nombreperfiles= 'empleado' ? true : false;

        //mostrar todos los productos
        $produc = DB::table('productos')
        ->leftJoin('categorias', 'productos.categorias_idcategorias', '=', 'categorias.idcategorias' )        
        ->get();

       
 
    
    $data->productos = $produc;
   
   
    
    $response->getBody()->write(json_encode($data));
    return $response;
});

//compra
$app->post('/comprar', function (Request $request, Response $response, array $args){  
    $data = json_decode($request->getBody()->getContents(), false);

 $msg = new stdClass();
 


 $prec = DB::table('productos')->where('idproductos', $data->Id)->value('precio');

 $cant = DB::table('productos')->where('idproductos', $data->Id)->value('cantidad');
 

 



 if ($data->pago==$prec)
 {
    $msg->aceptado = true;
   $restacantidad=$cant-$data->unidades;
   DB::table('productos')->where('idproductos', $data->Id)->update(['cantidad' => $restacantidad]);
   
 }
 else{$msg->aceptado = false;}

 $response->getBody()->write(json_encode($msg));
 return $response;
});

// Run application
$app->run();
