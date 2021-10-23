<?php

session_start();

$id = $_POST['id']; //recepcionamos la variable id
$ID = openssl_decrypt($id, COD, KEY); //desencripta la variable

$nombre = $_POST['nombre'];
$NOMBRE = openssl_decrypt($nombre, COD, KEY); //desencripta la variable


$precio = $_POST['precio'];
$PRECIO = openssl_decrypt($precio, COD, KEY); //desencripta la variable


$cantidad = $_POST['cantidad'];
$CANTIDAD = openssl_decrypt($cantidad, COD, KEY); //desencripta la variable



if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':

            if (is_numeric($ID)) {
                $mensaje1 = "ID correcto......" . $ID;
            } else {
                $mensaje1 = "ID incorrecto......";
            }

            if (is_string($NOMBRE)) {
                $mensaje2 = "El nombre es correcto....."  . $NOMBRE;
            } else {
                $mensaje2 = "El nombre en incorrecto....";
            }

            if (is_numeric($PRECIO)) {
                $mensaje3 = "El precio es correcto...."  . $PRECIO;
            } else {
                $mensaje3 = "El precio es incorrecto....";
            }

            if (is_numeric($CANTIDAD)) {
                $mensaje4 = "La cantidad es correcta...."  . $CANTIDAD;
            } else {
                $mensaje4 = "La cantidad es incorrecta....";
            }

            //lo siguiente aun forma parte del case 'Agregar', ya que se deben crear arrats que permitan
            //almacenar la informacion que se va procesando

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje = "producto agregado al carrito";
            } else { //si ya el arreglo contiene algun producto

                $idProductos = array_column($_SESSION['CARRITO'], "ID");
                if (in_array($ID, $idProductos)) {
                    echo "<script>alert('El producto ya ha sido seleccionado')</script>";
                } else {
                    $numeroProductos = count($_SESSION['CARRITO']); //cuenta cuantos elementos hay en el array

                    $producto = array(
                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' => $CANTIDAD,
                        'PRECIO' => $PRECIO

                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                    $mensaje = "producto agregado al carrito";
                }
            } //cierro el primer else

            //$mensaje = print_r($_SESSION, true);


            break;

        case "eliminar":
            $id = $_POST['id'];
            $mild = openssl_decrypt($id, COD, KEY);
            if (is_numeric($mild)) {
                $ID = $mild;
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['ID'] == $ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento Borrado');</script>";
                    }
                }
            } else {
                $mensaje = "Upss... ID Incorrecto" . $ID . "<br/>";
            }
            break;
    }
}
