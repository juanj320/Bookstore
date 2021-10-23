<?php

class conectar{

    private $servidor ="localhost";
    private $usuario ="root";
    private $clave ="";
    private $bd ="tienda";
    
    public function conexion(){   
        $conexion = mysqli_connect($this->servidor,$this->usuario,$this->clave,$this->bd);
        return $conexion;
    }  //cierro el método
}    //cierro la clase

//hacemos una prueba para verificar conexion
/*
$obj = new conectar;
if ($obj->conexion()){  
echo "<script>alert('Conexión exitosa')</script>";

}
else{
    echo "<script>alert('Error de conexión')</script>";
}
*/

?>