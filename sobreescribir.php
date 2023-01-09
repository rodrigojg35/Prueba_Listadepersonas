<?php
    include("conexion.php");
    $conexion = conectar();
    $query = "SELECT * FROM persona;";
    $ejecutar = mysqli_query($conexion, $query);

    while($row = mysqli_fetch_array($ejecutar)){
        $curp = $row['curp'];
        $nom = $row['nombre'];
        $apep = $row['apellidop'];
        $apem = $row['apellidom'];
        $sexo = $row['sexo'];
        $edad = $row['edad'];

        if($sexo == 'M'){$sexo = 'Masculino';} else {$sexo = 'Femenino';}

        echo "<tr>
                <td>$curp</td>
                <td>$nom</td>
                <td>$apep</td>
                <td>$apem</td>
                <td>$edad</td>
                <td>$sexo</td>

                </tr>";
    }
?>
