<?php
include 'global/conexion.php';
include 'global/config.php';
include 'global/carrito.php';
include 'templates/cabecera.php';

?>
<!-- Aqui en el medio ira una tabla con el contenido del carrito-->
<?php if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-hover table-bordered">
    <tbody>
        <tr>
            <th width="40%">Producto Agregado</th>
            <th width="15%">Cantidad</th>
            <th width="20%">Precio</th>
            <th width="20%">Total</th>
            <th width="5"></th>

        </tr>

        <?php
        $total = 0;

        foreach($_SESSION['CARRITO'] as $producto) { ?>
        <tr>

               <td width="40%"><?php echo $producto['NOMBRE'];?></td>
               <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'];?></td>
               <td width="20%" class="text-center"><?php echo $producto['PRECIO'];?></td>
               <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>
            
           

            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY); ?>'">
                <td width="5%"><button class="btn btn-danger" name="btnAccion" value="eliminar" type="submit">Eliminar</button></td>
            </form>
        </tr>
        <?php
        $total = $total + ($producto['PRECIO']*$producto['CANTIDAD']);
        }?>
        <tr>
            <td colspan="3" align="right"><h3>total</h3></td>
            <td align="right"><h3><?php echo number_format($total,2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
            <form action="pagar.php" method="post">
                <div class="alert alert-primary" role="alert">
                    <div class="form-group">
                        <label for="email">Correo de contacto</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="digita tu correo" required>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                        Los productos se enviaran a este correo
                    </small>
                    <div class="">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder"
                        name="btnAccion">Proceder a pagar</button>
                    </div>
                </div>
             </form>
            </td>
        </tr>
    </tbody>
</table>
<?php } else{ ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito
    </div>

<?php } ?>

<?php include 'templates/pie.php'; ?>