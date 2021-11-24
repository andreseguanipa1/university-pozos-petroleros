<?php
    include_once('config/auth.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Valores</title>
</head>
<body>

    <?php
        include_once('./assets/navbar.php')
    ?>

    <br>

    <div class="container">

        <h2> Listado de valores del Manómetro </h2>
        <br>

        <table border="1">
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Valor marcado</th>
                <th>Nombre del pozo</th>
                <th>Usuario que registró el valor</th>
            </tr>

        <?php

            $QUERY = "SELECT valores.valor, valores.fecha, valores.hora, usuarios.nombre, usuarios.apellido, pozo.nombre AS nombrePozo ";
            $QUERY = $QUERY . "FROM valores ";
            $QUERY = $QUERY . "inner JOIN usuarios ON valores.user_fk = usuarios.id ";
            $QUERY = $QUERY . "inner JOIN pozo ON valores.pozo_fk = pozo.id;";

            $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));

            while($fileQUERY = mysqli_fetch_array($rsQUERY)){
                
        ?>

    <tr>

        <td><?php echo $fileQUERY['fecha']; ?></td>

        <td><?php echo $fileQUERY['hora']; ?></td>

        <td><?php echo $fileQUERY['valor']; ?> psi</td>

        <td><?php echo $fileQUERY['nombrePozo']; ?></td>

        <td><?php echo $fileQUERY['nombre'] . ' ' . $fileQUERY['apellido']; ?></td>

    </tr>

    <?php 

        }

    ?>

    </table>

    <?php

        mysqli_close($con);

    ?>

    <br />

    <a href="agregarValor.php" title="Nuevo Valor">Nuevo Valor <i class="material-icons" style="fontsize:26px">dvr</i></a>

        <script>

            function eliminar(id){
                var id = id;
                confirmar = confirm("Deseas Borrar el Registro");

                if(confirmar == true) {

                    url = 'process/usuarios.php?ID='+id+'&borrar=si';
                    location.href=url;

                    alert("¡Eliminado!, El registro se eliminó completamente");
                    return true;

                }else{

                    alert("Cancelado, El registro No se eliminó");
                    return false;

                }

            window.refresh();

            }

        </script>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>