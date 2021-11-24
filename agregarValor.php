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
    <title>Agregar valor</title>
</head>
<body>

    <?php
        include_once('./assets/navbar.php')
    ?>


    <div class="container">
        <br>

        <h2>Agregar valor del manómetro</h2>
        <form method="post" action="process/valores.php" name="form1" enctype="multipart/form-data">
            <table border="0">

                <tr>
                    <th>Valor</th>
                    <td><input type="text" name="valor"></td>
                </tr>

                <tr>
                    <th>Pozo</th>

                    <td><select name="pozo">

                    <?php

                        $QUERY = "Select * from pozo";
                        $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));

                        while($fileQUERY = mysqli_fetch_array($rsQUERY)){

                    ?>

                        <option value="<?php echo  $fileQUERY['id']; ?>"><?php echo  $fileQUERY['nombre']; ?></option> 

                    <?php 

                        }           
                    ?>

                    </select></td>       
                </tr>

                <tr>
                    <th>Fecha</th>
                    <td><input type="date" name="fecha"></td>
                </tr>
                <tr>
                    <th>Hora</th>
                    <td><input type="time" name="time"></td>
                </tr>

            </table>
            <br />

            <input type="submit" name="nuevo" value="Registrar">

        </form>
    <br />


    <?php
        mysqli_close($con);
    ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>