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
    <title>Valores por pozo</title>
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <?php
        include_once('./assets/navbar.php')
    ?>

    <br>

    <div class="container">

        <div class="child">

        <h2> Listado de valores del Manómetro por pozo </h2>

            <br>

            <h4> Selecciona el pozo </h4>

            <br>

            <form action="" method="post">

            <select id="selector" name='selector' onchange="this.form.submit()">
            <option value="0">--Selecciona</option> 


            <?php

                $QUERY = "Select * from pozo";
                $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));

                while($fileQUERY = mysqli_fetch_array($rsQUERY)){

            ?>

                <option value="<?php echo  $fileQUERY['id']; ?>"><?php echo  $fileQUERY['nombre']; ?></option> 

            <?php 

                }           
            ?>

            </select>

            </form>

            <br>

            <?php

                if(isset( $_POST['selector'])){

                    $QUERY = "SELECT nombre ";
                    $QUERY = $QUERY . "FROM pozo ";
                    $QUERY = $QUERY . "WHERE id='" . $_POST['selector'] . "'";

                    $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));
                    $fileQUERY = mysqli_fetch_array($rsQUERY)

            ?>
                    <h4><?php echo $fileQUERY['nombre'] ?></h4>

                    <table border="1">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Valor marcado</th>
                            <th>Usuario que registró el valor</th>
                        </tr>

                    <?php

                    $QUERY = "SELECT valores.valor, valores.fecha, valores.hora, usuarios.nombre, usuarios.apellido ";
                    $QUERY = $QUERY . "FROM valores ";
                    $QUERY = $QUERY . "inner JOIN usuarios ON valores.user_fk = usuarios.id ";
                    $QUERY = $QUERY . "WHERE pozo_fk='" . $_POST['selector'] . "' ";
                    $QUERY = $QUERY . "order by fecha";
                    $arreglo = [];
                    $arreglo2 = [];


                    $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));

                    while($fileQUERY = mysqli_fetch_array($rsQUERY)){
                    
                        ?>

                            <tr>
                                <td><?php echo $fileQUERY['fecha']; ?></td>
                                <td><?php echo $fileQUERY['hora']; ?></td>
                                <td><?php echo $fileQUERY['valor']; ?> psi</td>
                                <td><?php echo $fileQUERY['nombre'] . ' ' . $fileQUERY['apellido']; ?></td>
                            </tr>

                    <?php 

                        array_push($arreglo, $fileQUERY['valor']);
                        array_push($arreglo2, $fileQUERY['fecha']);

                    }
                   
                   ?>

                </table>

                <br>
                <hr />
                <br>


                <canvas id="myChart" width="400" height="100"></canvas>
                <script>

                    let arregloJS = []
                    let arreglo2JS = []

                    <?php

                        $arrlength = count($arreglo);

                        for($x = 0; $x < $arrlength; $x++) {

                    ?>

                        arregloJS.push('<?php echo $arreglo[$x]; ?>')
                        arreglo2JS.push('<?php echo $arreglo2[$x]; ?>')

                    <?php

                        }


                    ?>

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: arreglo2JS,
                        datasets: [{
                            label: 'Valores en psi',
                            data: arregloJS,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                </script>

                    

                <?php 

                }

                ?>

                <br>
                <br>
        
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>