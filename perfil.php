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

    <title>Perfil</title>
</head>
<body>

    <?php
        include_once('./assets/navbar.php')
    ?>

    <br>

    <div class="container-profile">

    <div class="card" style="width: 18rem;">
        <img src="<?php echo $_SESSION['fotoUsuario']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <p class="card-text"><b>Usuario: </b><?php echo $_SESSION['fullName']; ?></p>
            <p class="card-text"><b>Telefono: </b><?php echo $_SESSION['telefono']; ?></p>
        </div>
    </div>

        <br />
        <br />

        <a href="process/proceLogout.php">Cerrar Sesion</a>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>