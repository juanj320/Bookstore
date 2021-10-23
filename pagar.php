<?php
include 'global/conexion.php';
include 'global/metodosBd.php';
include 'global/config.php';
include 'global/carrito.php';
include 'templates/cabecera.php';

?>
<br>
<br>
<?php 

if($_POST){
    $total = 0;
    $SID = session_id(); 



    $correo = $_POST['email'];
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total = $total +($producto['PRECIO']*$producto['CANTIDAD']);
    }   //cierro foreach

    $miobjeto = new metodos;
   /* $datos = array(
        '20987654321',
        '',
        'carlos@gmail.com',
        '987',
        'en proceso');*/

    $datos = array(
        $SID,
        '',
        $correo,
        $total,
        'en proceso');




    echo 'a continuacion retorno el resultado del proceso de inserción de la tabla ventas: ';
    echo $miobjeto ->insertarDatos1($datos);

    echo"<br>";
    echo 'a continuacion retorno el ID de la venta: ';
    echo $miobjeto->retornarID();

    $idVenta = $miobjeto->retornarID();
        
    foreach($_SESSION['CARRITO'] as $indice=>$producto){

        $datos2 = array(
            $idVenta,
            $producto['ID'],
            $producto['PRECIO'],
            $producto['CANTIDAD'],
            '0');
        
            echo"<br>";
            echo 'a continuacion retorno el resultado de la insercion  de la tabla detallesventas de cada producto agregado: ';
            echo $miobjeto ->insertarDatos2($datos2);
    }

        echo "<center><h3>" .$total. "</h3></center>";
}
?>

<?php include 'templates/pie.php'; ?>