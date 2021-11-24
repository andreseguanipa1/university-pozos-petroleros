<?php
include_once('../config/cnx/conexion.php');
session_start();

if(isset($_SESSION['id'])){
    $ID = $_SESSION['id'];
    $QUERY = "Select * from usuarios Where id='$ID'";
    $rsQUERY = mysqli_query($con, $QUERY) or die('Error: ' . mysqli_error($con));
    $countQUERY = mysqli_num_rows($rsQUERY);

    if($countQUERY<=0){
        header('Location: index.html');
    }

}else{
    header('Location: index.html');
}

if(isset($_POST['nuevo'])){

    if($_POST['nuevo'] == 'Registrar'){

        $valor = $_POST['valor'];
        $pozo = $_POST['pozo'];
        $fecha = $_POST['fecha'];
        $time = $_POST['time'];

        $QUERYInt = "Insert Into valores (valor, fecha, hora, pozo_fk, user_fk)";

        $QUERYInt .= "values ('$valor', '$fecha', '$time', '$pozo', '$ID');";

        $rsQUERYInt = mysqli_query($con, $QUERYInt) or die('Error: ' . mysqli_error($con));

        if($rsQUERYInt == true){
            header('Location: ../valoresPorPozo.php');
        }

        if($rsQUERYInt == false){
            echo 'Error no se pudo registrar el usuario';
        }

    }
}