<?php
    function conectar(){
        $conexion = mysqli_connect("localhost", "root", "","proyecto5") or die ("No se pudo conectar". mysql_error());
        return $conexion;
    }
    
?>